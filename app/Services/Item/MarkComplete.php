<?php

namespace App\Services\Item;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use App\Services\Item\AbstractItem;
use App\Repositories\ItemRepository as Repository;

class MarkComplete extends AbstractItem
{
    protected $uuid;

    protected $repository;

    /**
     * Mark item as complete construct method
     *
     * @param $uuid
     * @param Repository $repository
     *
     * @return AbstractItem
     */
    public function __construct($uuid, ItemRepository $repository)
    {
        $this->uuid = $uuid;
        $this->repository = $repository;
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
            $this->response = $this->makeResponse(200, 'mark.200');
        }

        return $this;
    }
}