<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XLS extends Model
{
    protected $fillable = ['air', 'air_express','train', 'sea', 'customs_air',
        'customs_train', 'customs_sea','numm_id','numm_title'];
}
