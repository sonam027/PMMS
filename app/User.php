<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/* Defines Faculty Model to hold Faculty Data */
class User extends Model
{
    protected $table = 'Users'; /* Maps to Users Table */
    protected $primaryKey = 'id'; /* Primary Key of Users Table */
    protected $unique='email';
    public $incrementing = true; /* Users Table has auto_increment column */
    public $timestamps = true; /* Do add Created_at and Updated_at column in Table */
}
