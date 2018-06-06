<?php
# @Author: thomas
# @Date:   2017-12-08T14:35:57+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-09T10:20:42+01:00




namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $fillable = ['home_team_id',
                           'away_team_id',
                           'home_team_score',
                           'away_team_score',
                           'winner',
                           'loser',
                           'game_date',
                           'home_team_bet',
                           'away_team_bet'];
}
