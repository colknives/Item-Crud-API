<?php

namespace App\Repositories;

use App\Repositories\AbstractBaseRepository;
use App\Models\Item as Model;
use Carbon\Carbon;
use DB;

class ItemRepository extends AbstractBaseRepository {

    public function __construct(Model $model) 
    {
        parent::__construct($model);
    }

    public function findByStatus($status = false) {

    	$query = $this->model;

    	//Check if status is provided
    	if( $status ){
    		switch (strtoupper($status)) {
    			case 'COMPLETED':
    				$query = $query->where('is_completed', true);
    				break;

    			case 'OPEN':
    				$query = $query->where('is_completed', false);
    				break;
    		}
    	}

    	return $query->get();
    }
}
