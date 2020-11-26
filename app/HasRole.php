<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'has_role';


    public $foreignKey = 'user_id';
}
