<?php

namespace App\Services\Item;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use App\Services\Item\AbstractItem;
use App\Repositories\ItemRepository as Repository;

class ListItem extends AbstractItem
{
    protected $uuid;

    protected $repository;

    /**
     * List item construct method
     *
     * @param Repository $repository
     *
     * @return AbstractItem
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * List item handle method
     *
     * @return AbstractItem
     */
    public function handle(): AbstractItem
    {
        //Get all items
        $item = $this->repository->all();

        //If no item found, return 404 status
        if( !$item ){
            $this->response = $this->makeResponse(404, 'view.404');
            $this->response->items = null;
        }
        else{
            $this->response = $this->makeResponse(200, 'view.200');
            $this->response->items = $item->toArray();
        }

        return $this;
    }
}