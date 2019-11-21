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
            'name' => 'required|max:50',
            'description' => 'required'
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

        dd($mark);

        return response()->json([
            "message" => $save->message,
            "item" => $save->item
        ], $save->status); 
    }
}
