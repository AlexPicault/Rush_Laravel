<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   alex
# @Last modified time: 2017-12-11T14:14:58-05:00

?>
@extends('layouts/app')
@section('content')
  <a href="games"  class="navbar navbar-fixed-top">Games</a><br />
<form class="form" action="http://localhost:8000/addgame" method="post">
    {{ csrf_field() }}
  <p><select class="" name="home_team_id">
    @foreach($teams as $team)
      <option value="{{$team->id}}">{{$team->name}}</option>
    @endforeach
  </select></p>
  <p><select class="" name="away_team_id">
    @foreach($teams as $team)
      <option value="{{$team->id}}">{{$team->name}}</option>
    @endforeach
  </select></p>
  <p><input type="date" name="game_date" /></p>
  <p><input type="number" name="home_team_score" placeholder="home team score" /></p>
  <p><input type="number" name="away_team_score" placeholder="away team score" /></p>
  <p><input type="number" name="home_team_bet" placeholder="home team bet" /></p>
  <p><input type="number" name="away_team_bet" placeholder="away team bet" /></p>
  <p><input  class="btn btn-primary" type="submit" value="Add Game"/></p>
</form>
@endsection
