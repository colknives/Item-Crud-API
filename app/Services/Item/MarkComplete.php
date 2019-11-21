<?php

namespace App\Services\Item;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use App\Services\Item\AbstractItem;
use App\Repositories\ItemRepository as Repository;
use App\Repositories\ItemHistoryRepository;

class MarkComplete extends AbstractItem
{
    /**
     * Uuid Instance
     */
    protected $uuid;

    /**
     * Item Repository Instance
     */
    protected $repository;

    /**
     * Item History Repository Instance
     */
    protected $itemHistoryRepository;

    /**
     * Mark item as complete construct method
     *
     * @param $uuid
     * @param Repository $repository
     * @param ItemHistoryRepository $itemHistoryRepository
     *
     * @return AbstractItem
     */
    public function __construct(
        $uuid, 
        Repository $repository,
        ItemHistoryRepository $itemHistoryRepository)
    {
        $this->uuid = $uuid;
        $this->repository = $repository;
        $this->itemHistoryRepository = $itemHistoryRepository;
    }

    /**
     * Mark item as complete handle method
     *
     * @return AbstractItem
     */
    public function handle(): AbstractItem
    {
        //Find item via provided uuid
        $item = $this->repository->find('uuid', $this->uuid);

        //If no item found, return 404 status
        if( !$item ){
            $this->response = $this->makeResponse(404, 'mark.404');
            return $this;
        }

        $data = ['is_completed' => true];

        //Update Item
        $updateItem = $this->repository->update($item, $data);

        //If item not updated, return 400 status else return 200
        if( !$updateItem ){
            $this->response = $this->makeResponse(400, 'mark.400');
        }
        else{
            //Log interaction in database
            $log = $this->itemHistoryRepository->logHistory('MARK_COMPLETE_ITEM', $this->uuid);

            $this->response = $this->makeResponse(200, 'mark.200');
        }

        return $this;
    }
}