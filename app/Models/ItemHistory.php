<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AbstractBaseModel;
use Carbon\Carbon;

class ItemHistory extends AbstractBaseModel {

    use SoftDeletes;

    protected $table = 'item_histories';
    protected $fillable = [
        "uuid",
        "item_uuid",
        "action",
        "deleted_at"
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        "deleted_at"
    ];
}
