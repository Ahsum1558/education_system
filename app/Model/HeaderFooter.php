<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HeaderFooter extends Model
{
    protected $fillable = ['owner_name', 'owner_department', 'mobile', 'address', 'copyright', 'status'];
}
