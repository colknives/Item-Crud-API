<?php

namespace App\Services\Item;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use App\Services\Item\AbstractItem;
use App\Repositories\ItemRepository as Repository;
use App\Repositories\ItemHistoryRepository;

class MarkItem extends AbstractItem
{
    /**
     * Uuid Instance
     */
    protected $uuid;

    /**
     * Request Instance
     */
    protected $request;

    /**
     * Item Repository Instance
     */
    protected $repository;

    /**
     * Item History Repository Instance
     */
    protected $itemHistoryRepository;

    /**
     * Mark item construct method
     *
     * @param $uuid
     * @param Request $request
     * @param Repository $repository
     * @param ItemHistoryRepository $itemHistoryRepository
     *
     * @return AbstractItem
     */
    public function __construct(
        $uuid, 
        Request $request,
        Repository $repository,
        ItemHistoryRepository $itemHistoryRepository)
    {
        $this->uuid = $uuid;
        $this->request = $request;
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

        $data = [
            'is_completed' => ( $this->request->post('mark') == 'complete' )? true : false
        ];

        //Update Item
        $updateItem = $this->repository->update($item, $data);

        //If item not updated, return 400 status else return 200
        if( !$updateItem ){
            $this->response = $this->makeResponse(400, 'mark.400');
        }
        else{

            $logMessage = ( $this->request->post('mark') == 'complete' )? 'MARK_ITEM_COMPLETE' : 'MARK_ITEM_OPEN';

            //Log interaction in database
            $log = $this->itemHistoryRepository->logHistory($logMessage, $this->uuid);

            $this->response = $this->makeResponse(200, 'mark.200');
        }

        return $this;
    }
}