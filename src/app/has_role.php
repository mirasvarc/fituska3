<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class has_role extends Model
{
    protected $table = 'has_role';
    public $foreignKey = 'user_id';
}
