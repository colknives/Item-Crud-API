<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{
    /**
     * Create item unit test
     *
     * @return void
     */
    public function testCreateItem()
    {
        //Create sample item to save
        $item = factory(\App\Models\Item::class)->make();

        //Check 422 response
        $response = $this->post("item/create", []);
        $response->assertResponseStatus(422);
        $response->seeJsonStructure([
            'name'
        ]);

        //Check 200 response
        $response = $this->post("item/create", [
            'name' => $item->name,
            'description' => $item->description
        ]);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message',
            'item'
        ]);
    }

    /**
     * Mark item as complete unit test
     *
     * @return void
     */
    public function testMarkItemComplete()
    {
        //Create sample item to mark as complete
        $item = factory(\App\Models\Item::class)->create();

        //Check 404 response
        $response = $this->put("item/mark/complete/1");
        $response->assertResponseStatus(404);

        //Check 200 response
        $response = $this->put("item/mark/complete/{$item->uuid}");
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message'
        ]);
    }

    /**
     * Delete item unit test
     *
     * @return void
     */
    public function testDeleteItem()
    {
        //Create sample item to delete
        $item = factory(\App\Models\Item::class)->create();

        //Check 404 response
        $response = $this->delete("item/delete/1");
        $response->assertResponseStatus(404);

        //Check 200 response
        $response = $this->delete("item/delete/{$item->uuid}");
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message'
        ]);
    }

    /**
     * View item unit test
     *
     * @return void
     */
    public function testViewItem()
    {
        //Create sample item to view
        $item = factory(\App\Models\Item::class)->create();

        //Check 404 response
        $response = $this->get("item/view/1");
        $response->assertResponseStatus(404);

        //Check 200 response
        $response = $this->get("item/view/{$item->uuid}");
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message',
            'item'
        ]);
    }

    /**
     * List item unit test
     *
     * @return void
     */
    public function testListItem()
    {
        //Create sample item to list
        $item = factory(\App\Models\Item::class, 10)->create();

        //Check 200 response
        $response = $this->get("item/list");
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message',
            'items'
        ]);
    }
}
