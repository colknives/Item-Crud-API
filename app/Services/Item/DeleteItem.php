<?php

namespace App\Services\Item;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use App\Services\Item\AbstractItem;
use App\Repositories\ItemRepository as Repository;

class DeleteItem extends AbstractItem
{
    protected $uuid;

    protected $repository;

    /**
     * Delete item construct method
     *
     * @param $uuid
     * @param Repository $repository
     *
     * @return AbstractItem
     */
    public function __construct($uuid, Repository $repository)
    {
        $this->uuid = $uuid;
        $this->repository = $repository;
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
            $this->response = $this->makeResponse(200, 'delete.200');
        }

        return $this;
    }
}