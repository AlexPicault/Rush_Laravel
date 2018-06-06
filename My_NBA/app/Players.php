<?php
# @Author: thomas
# @Date:   2017-12-08T14:35:57+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-08T14:38:42+01:00




namespace App;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    protected $fillable = ['teams_current_id', 'first_name', 'last_name', 'birthdate', 'height', 'weight', 'picture', 'starting_five', 'position', 'number_shirt'];
}
