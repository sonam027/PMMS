<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'Projects';
    protected $primaryKey = 'ProjectId';
    public $incrementing = true;
    public $timestamps = false;
}
