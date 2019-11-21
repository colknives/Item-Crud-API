<?php

namespace App\Services\Item;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use App\Services\Item\AbstractItem;
use App\Repositories\ItemRepository as Repository;
use App\Repositories\ItemHistoryRepository;

class DeleteItem extends AbstractItem
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
     * Delete item construct method
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
     * Delete item handle method
     *
     * @return AbstractItem
     */
    public function handle(): AbstractItem
    {
        //Find item via provided uuid
        $item = $this->repository->find('uuid', $this->uuid);

        //If no item found, return 404 status
        if( !$item ){
            $this->response = $this->makeResponse(404, 'delete.404');
            return $this;
        }

        //Delete Item
        $deleteItem = $this->repository->delete($item);

        //If item not deleted, return 400 status else return 200
        if( !$deleteItem ){
            $this->response = $this->makeResponse(400, 'delete.400');
        }
        else{
            //Log interaction in database
            $log = $this->itemHistoryRepository->logHistory('DELETE_ITEM', $this->uuid);

            $this->response = $this->makeResponse(200, 'delete.200');
        }

        return $this;
    }
}