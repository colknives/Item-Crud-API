<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Services\Item\ItemInterface as ItemService;

class ItemController extends Controller
{
    /**
     * Item Service Instance
     */
    protected $itemService;

    /**
     * ItemController constructor.
     *
     * @param ItemService $itemService
     *
     * @return void
     */
    public function __construct(
        ItemService $itemService
    )
    {
        $this->itemService = $itemService;
    }

    /**
     * Create item method.
     *
     * @return void
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50'
        ]);

        $save = $this->itemService->createItem();

        return response()->json([
            "message" => $save->message,
            "item" => $save->item
        ], $save->status); 
    }

    /**
     * Mark item as complete method.
     *
     * @return void
     */
    public function markComplete($uuid)
    {
        $mark = $this->itemService->markComplete($uuid);

        return response()->json([
            "message" => $mark->message
        ], $mark->status); 
    }

    /**
     * Delete item method.
     *
     * @return void
     */
    public function delete($uuid)
    {
        $delete = $this->itemService->deleteItem($uuid);

        return response()->json([
            "message" => $delete->message
        ], $delete->status); 
    }

    /**
     * View item method.
     *
     * @return void
     */
    public function view($uuid)
    {
        $view = $this->itemService->viewItem($uuid);

        return response()->json([
            "message" => $view->message,
            "item" => $view->item
        ], $view->status); 
    }
}
