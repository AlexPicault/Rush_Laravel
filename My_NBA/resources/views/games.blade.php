<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-12T10:14:46+01:00

?>
@extends('layouts/app')
@section('content')
  <div class="add"><a href="addgame">Add Game</a><br />
    @if($admin == 1)
    <a href="/users">Admin user</a><br />
    @endif
    @if($admin == 0)
    <a href="/edituser/{{$user}}">Edit profil</a>
    @endif
  </div>

  <div class="container">
    <div class="row">
    @foreach($games as $game)
      <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
      {{$game->name1}}
      {{$game->game_date < '2017-09-26 00:00:00' ? $game->home_team_score . ' - ' .  $game->away_team_score : $game->game_date}}
      {{$game->name2}}<br />
      <strong>home bet : {{$game->home_team_bet}}</strong><br />
      <strong>Away bet : {{$game->away_team_bet}}</strong><br />
      <form class="" action="http://localhost:8000/players/delete/{{$id = $game->id}}" method="post" onsubmit="return confirm('Are you sure you want to delete this game?')">
        {{csrf_field()}}
        @if($admin==1)
        <input type="submit" name="delete" value="Delete" class="btn btn-primary"/>
        <a href="editgame/{{$id = $game->id}}" class="btn btn-primary">Edit Game</a>
        @else
        <a href="showgame/{{$id = $game->id}}" class="btn btn-primary">Show Game</a>
        @endif

      </form>
    </div>
    @endforeach
  </div>
</div>
@endsection
