<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module_Teacher extends Model
{

    use HasFactory;
    protected $table = 'module_teacher';
    protected $fillable = ['module_id','teacher_id'];

}
