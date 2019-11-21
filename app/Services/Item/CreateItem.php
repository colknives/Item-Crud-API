<?php

namespace App\Services\Item;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use App\Services\Item\AbstractItem;
use App\Repositories\ItemRepository as Repository;

class CreateItem extends AbstractItem
{
    protected $request;

    protected $repository;

    /**
     * Create item construct method
     *
     * @param Request $request
     * @param Repository $repository
     *
     * @return AbstractItem
     */
    public function __construct(
        Request $request,
        Repository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    /**
     * Create item handle method
     *
     * @return AbstractItem
     */
    public function handle(): AbstractItem
    {

        $data = [
            'uuid' => Uuid::uuid4()->toString(),
            'name' => $this->request->post('name'),
            'description' => $this->request->post('description')
        ];

        //Save Item
        $saveItem = $this->repository->create($data);

        if( !$saveItem ){
            $this->response = $this->makeResponse(400, 'create.400');
            $this->response->item = null;
        }
        else{
            $this->response = $this->makeResponse(200, 'create.200');
            $this->response->item = $saveItem;
        }

        return $this;
    }
}