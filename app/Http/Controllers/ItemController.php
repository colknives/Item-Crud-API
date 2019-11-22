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
     * Mark item method.
     *
     * @return void
     */
    public function mark(Request $request, $uuid)
    {
        $this->validate($request, [
            'mark' => 'required'
        ]);

        $mark = $this->itemService->markItem($uuid);

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
     * List items method.
     *
     * @return void
     */
    public function list(Request $request)
    {
        $list = $this->itemService->listItem();

        return response()->json([
            "message" => $list->message,
            "items" => $list->items,
            "status" => $request->post('status')
        ], $list->status); 
    }
}
