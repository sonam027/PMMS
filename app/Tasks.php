<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'Tasks';
    protected $primaryKey = 'SrNo';
    public $incrementing = false;
    public $timestamps = false;
}
