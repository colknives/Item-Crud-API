<?php

namespace App\Services\Item;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use App\Services\Item\AbstractItem;
use App\Repositories\ItemRepository;

class CreateItem extends AbstractItem
{
    protected $addItem;

    protected $request;

    protected $repository;

    public function __construct(
        Request $request,
        ItemRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    /**
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
            $this->response = $this->makeResponse(400, 'save.400');
            $this->response->item = null;
        }
        else{
            $this->response = $this->makeResponse(200, 'save.200');
            $this->response->item = $saveItem;
        }

        return $this;
    }
}