<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UE extends Model
{

    protected $table = 'u_es';
    protected $hidden = ['created_at','updated_at'];
}
