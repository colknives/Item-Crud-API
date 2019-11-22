<?php

namespace App\Services\Item;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use App\Repositories\ItemRepository;
use App\Repositories\ItemHistoryRepository;
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
     * Item History Repository Instance
     */
    protected $itemHistoryRepository;

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
        ItemRepository $itemRepository,
        ItemHistoryRepository $itemHistoryRepository) {

        $this->request = $request;
        $this->itemRepository = $itemRepository;
        $this->itemHistoryRepository = $itemHistoryRepository;

        parent::__construct($request);
    }

    /**
     * Create item service method
     *
     * @return response
     */
    public function createItem() 
    {
        return (new CreateItem($this->request, $this->itemRepository, $this->itemHistoryRepository))->handle()->response();
    }

    /**
     * Mark item as complete service method
     *
     * @return response
     */
    public function markItem($uuid) 
    {
        return (new MarkItem($uuid, $this->request, $this->itemRepository, $this->itemHistoryRepository))->handle()->response();
    } 

    /**
     * Delete item service method
     *
     * @return response
     */
    public function deleteItem($uuid) 
    {
        return (new DeleteItem($uuid, $this->itemRepository, $this->itemHistoryRepository))->handle()->response();
    }  

    /**
     * List item service method
     *
     * @return response
     */
    public function listItem() 
    {
        return (new ListItem($this->request, $this->itemRepository))->handle()->response();
    }  
}
