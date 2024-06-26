<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class AddUpdate extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['first_name', 'last_name' , 'age', 'address','Mobile_num','email','password'];
}
