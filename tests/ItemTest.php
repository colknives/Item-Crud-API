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
        //Create sample item to save
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
        //Create sample item to save
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
}
