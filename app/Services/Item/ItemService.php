<?php

namespace App\Services\Item;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use App\Repositories\ItemRepository;
use App\Services\AbstractBaseService;

class ItemService extends AbstractBaseService implements ItemInterface {

    /**
     * Module Name
     */
    protected $module = 'item';

    /**
     * Item Repository Instance
     */
    protected $itemRepository;
    
    /**
     * ItemService constructor.
     *
     * @param Request $request
     * @param ItemRepository $itemRepository
     *
     * @return void
     */
    public function __construct(
        Request $request,
        ItemRepository $itemRepository) {

        $this->request = $request;
        $this->itemRepository = $itemRepository;

        parent::__construct($request);
    }

    /**
     * Create item service method
     *
     * @return response
     */
    public function createItem() 
    {
        return (new CreateItem($this->request, $this->itemRepository))->handle()->response();
    }

    /**
     * Mark item as complete service method
     *
     * @return response
     */
    public function markComplete($uuid) 
    {
        return (new MarkComplete($uuid, $this->itemRepository))->handle()->response();
    } 

    /**
     * Delete item service method
     *
     * @return response
     */
    public function deleteItem($uuid) 
    {
        return (new DeleteItem($uuid, $this->itemRepository))->handle()->response();
    }  

    /**
     * View item service method
     *
     * @return response
     */
    public function viewItem($uuid) 
    {
        return (new ViewItem($uuid, $this->itemRepository))->handle()->response();
    }  
}
