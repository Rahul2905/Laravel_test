<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    
    protected $fillable = ['fname', 'lname', 'pid' , 'created_at'];

    protected $casts = [
    					'fname' 		=> 'string',
    					'lname' 		=> 'string'
					];

	public function substudent() {
        return $this->hasMany('App\Models\Student', 'pid');
    }
}
