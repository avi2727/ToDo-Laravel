<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todolist extends Model
{
    use HasFactory;
    protected $table = 'todo_tbl';
    protected $fillable = [
    	'name',
    	'list',
    ];
}
