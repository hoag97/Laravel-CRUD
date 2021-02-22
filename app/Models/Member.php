<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
	public $timestamps = false;
    protected $table = "members";
    protected $primaryKey = 'id'; 
    protected $fillable = [
    	'name', 'phone', 'email', 'addres', 'faculty_id'
    ];

    public function faculty(){
    	return $this->belongsTo(Faculty::class, 'faculty_id');
    }

}