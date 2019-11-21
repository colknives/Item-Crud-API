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
        
        $item = factory(\App\Models\Item::class)->make();

        //200
        $response = $this->post("item/create", [
            'name' => $item->name,
            'description' => $item->description
        ]);

        dd($response->response->getContent());

        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message',
            'item'
        ]);

    }
}
