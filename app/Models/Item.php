<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AbstractBaseModel;
use Carbon\Carbon;

class Item extends AbstractBaseModel {

    use SoftDeletes;

    protected $table = 'items';
    protected $fillable = [
        "uuid",
        "name",
        "description",
        "is_completed",
        "deleted_at"
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
