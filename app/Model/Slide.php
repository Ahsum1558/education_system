<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['slide_image', 'slide_title', 'slide_description', 'status'];
}
