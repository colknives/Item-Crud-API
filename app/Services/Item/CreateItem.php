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

    protected $repository

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

        dd('hahahah');

        // $contactId = $this->request->post('contact_id');
        // $items = json_decode($this->request->post('items'));

        // $data = [
        //     'customer_id' => $contactId,
        //     'date' => Carbon::now()->format('Y-m-d'),
        //     'line_items' => $items
        // ];

        // //Save Item
        // $saveItem = $this->addItem->addItem(json_encode($data));

        // if( !$saveItem ){
        //     $this->response = $this->makeResponse(400, 'save.400');
        //     $this->response->order = null;
        //     return $this;
        // }


        // $this->response = $this->makeResponse(200, 'save.200');
        // $this->response->order = $saveItem;

        // return $this;
    }
}