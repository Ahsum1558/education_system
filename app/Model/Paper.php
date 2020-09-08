<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = ['exam_id', 'paper_name', 'short_name', 'mark', 'weight', 'status'];
}
