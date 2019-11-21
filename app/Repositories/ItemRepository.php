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
}
