<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\Builder;

class AbstractBaseModel extends Model
{
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}