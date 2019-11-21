<?php

namespace App\Services\Item;

interface ItemInterface {

	public function createItem();

	public function markComplete($uuid);
	
}
