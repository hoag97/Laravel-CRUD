<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'facultys';
    protected $primaryKey = 'id';

      protected $fillable = [
        'title', 'status'
    ];


    public function member(){
    	return $this->hasMany(Member::class, 'faculty_id', 'id');
    }

}