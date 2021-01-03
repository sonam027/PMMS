<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/* Defines Faculty Model to hold Student Data */
class Student extends Model
{
    protected $table = 'Students'; /* Maps to Users Table */
    protected $primaryKey = 'id'; /* Primary Key of Users Table */
    protected $unique='email';
    public $incrementing = true; /* Users Table has auto_increment column */
    public $timestamps = true; /* Do add Created_at and Updated_at column in Table */
}
