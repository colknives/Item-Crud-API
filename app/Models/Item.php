<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Item extends Model {

    use SoftDeletes;

    protected $table = 'items';
    protected $fillable = [
        "uuid",
        "name",
        "description",
        "deleted_at"
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
