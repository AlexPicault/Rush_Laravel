<?php
# @Author: alex
# @Date:   2017-12-07T13:04:20-05:00
# @Last modified by:   alex
# @Last modified time: 2017-12-11T10:12:53-05:00




namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $fillable = ['name', 'town', 'logo', 'conference', 'division', 'stadium_name'];
}
