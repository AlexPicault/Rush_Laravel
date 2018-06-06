<?php
# @Author: thomas
# @Date:   2017-12-08T14:35:57+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-09T10:23:33+01:00




namespace App;

use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    protected $fillable = ['player_id',
                           'game_id',
                           'points',
                           'rebounds',
                           'assists',
                           'blocks',
                           'faults'];
}
