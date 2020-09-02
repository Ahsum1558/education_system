<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = ['class_id', 'batch_name', 'student_capacity', 'status'];
}
