<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'user_settings';

   public $foreignKey = 'user_id';

   protected $casts = [
    'user_settings_json' => 'array'
    ];
}
