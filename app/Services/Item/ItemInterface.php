<?php

namespace App\Services\Item;

interface ItemInterface {

	public function createItem();

	public function markItem($uuid);

	public function deleteItem($uuid);

	public function listItem() ;
	
}
