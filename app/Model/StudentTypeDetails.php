<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentTypeDetails extends Model
{
    protected $fillable = ['student_id', 'class_id', 'type_id', 'batch_id', 'roll_no', 'type_status'];
}
