<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Repositories\AbstractBaseRepository;
use App\Models\ItemHistory as Model;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use DB;

class ItemHistoryRepository extends AbstractBaseRepository {

    public function __construct(Model $model) 
    {
        parent::__construct($model);
    }

    public function logHistory($action, $uuid = false) {

    	//Insert Log
        Log::info($action.': '.$uuid);

    	$data = [
    		'uuid' => Uuid::uuid4()->toString(), 
    		'item_uuid' => ( $uuid )? $uuid : '',
    		'action' => $action
    	];

        return $this->model->create($data);
    }
}
