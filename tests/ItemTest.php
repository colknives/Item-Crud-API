<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{
    /**
     * Create Item
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
            'name',
            'description'
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
     * Update Item
     *
     * @return void
     */
    public function testMarkItem()
    {
        //Create sample item to save
        $item = factory(\App\Models\Item::class)->create();

        // //Check 404 response
        // $response = $this->put("item/mark/complete/1");
        // $response->assertResponseStatus(422);
        // $response->seeJsonStructure([
        //     'name',
        //     'description'
        // ]);

        //Check 200 response
        $response = $this->put("item/mark/complete/{$item->uuid}");

        dd($response->response->getContent());

        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message'
        ]);
    }
}
