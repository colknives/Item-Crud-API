<?php

namespace App\Services\Item;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use App\Services\Item\AbstractItem;
use App\Repositories\ItemRepository as Repository;

class ViewItem extends AbstractItem
{
    protected $uuid;

    protected $repository;

    /**
     * View item construct method
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
     * View item handle method
     *
     * @return AbstractItem
     */
    public function handle(): AbstractItem
    {
        //Find item via provided uuid
        $item = $this->repository->find('uuid', $this->uuid);

        //If no item found, return 404 status
        if( !$item ){
            $this->response = $this->makeResponse(404, 'view.404');
            $this->response->item = null;
        }
        else{
            $this->response = $this->makeResponse(200, 'view.200');
            $this->response->item = $item->toArray();
        }

        return $this;
    }
}