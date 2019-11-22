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
            'name' => $item->name
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
    public function testMarkItem()
    {
        //Create sample item to mark as complete
        $item = factory(\App\Models\Item::class)->create();

        //Check 422 response
        $response = $this->put("item/mark/1");
        $response->assertResponseStatus(422);

        //Check 404 response
        $response = $this->put("item/mark/1", [
            'mark' => 'open'
        ]);
        $response->assertResponseStatus(404);

        //Check 200 response
        $response = $this->put("item/mark/{$item->uuid}", [
            'mark' => 'open'
        ]);
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
     * List item unit test
     *
     * @return void
     */
    public function testListItem()
    {
        //Create sample item to list
        $item = factory(\App\Models\Item::class, 5)->create([
            'is_completed' => false
        ]);

        //Check 200 response with open status
        $response = $this->post("item/list", [
            'status' => 'open'
        ]);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message',
            'items'
        ]);

        // Create sample item to list
        $item = factory(\App\Models\Item::class, 5)->create([
            'is_completed' => true
        ]);

        //Check 200 response with completed status
        $response = $this->post("item/list", [
            'status' => 'completed'
        ]);

        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message',
            'items'
        ]);

        //Check 200 response with all items
        $response = $this->post("item/list");
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message',
            'items'
        ]);
    }
}
