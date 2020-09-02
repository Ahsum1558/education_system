<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentType extends Model
{
    protected $fillable = ['class_id', 'student_type', 'status'];
}
