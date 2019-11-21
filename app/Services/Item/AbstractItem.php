<?php

namespace App\Services\Item;

use App\Services\AbstractBaseService;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

abstract class AbstractItem extends AbstractBaseService
{
    protected $module = 'item';

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    abstract public function handle(): AbstractItem;
}