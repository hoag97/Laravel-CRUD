<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'facultys';
    protected $primaryKey = 'id';


    public function member(){
    	return $this->hasMany('App\Models\Member', 'id', 'id');
    }

}