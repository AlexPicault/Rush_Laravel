<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-11T21:08:42+01:00

?>

@extends('layouts/app')
@section('content')
<form class="" action="http://localhost:8000/editgame/{{$games->id}}" method="post" id="edit_game">
  {{ csrf_field() }}

  <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
  {{$games->game_date}}<br />
  {{$games->name1}}
  <input type="number" name="home_team_score" value="{{$games->home_team_score}}"  form="edit_game"/>
  <input type="number" name="home_team_bet" value="{{$games->home_team_bet}}" placeholder="home team bet" form="edit_game" /><br />
  {{$games->name2}}
  <input type="number" name="away_team_score" value="{{$games->away_team_score}}" form="edit_game" />
  <input type="number" name="away_team_bet" value="{{$games->away_team_bet}}" placeholder="away team bet" form="edit_game" />
  @if($admin==1)
<input type="submit" value="Edit Game" form="edit_game" />
@endif
</form>
<br /><br />

{{$games->name1 . ' - Stats'}}

<table>
<tr>
  <th>Name</th>
  <th>Points</th>
  <th>Rebounds</th>
  <th>Assists</th>
  <th>Blocks</th>
</tr>

@foreach($stats_t1 as $stat_t1)
<form action="http://localhost:8000/editstat/{{$games->id}}/{{$stat_t1->id}}" method="post" id="{{$stat_t1->player_id}}">{{ csrf_field() }}</form>
  <tr>
    <td>{{$stat_t1->first_name}} {{$stat_t1->last_name}}</td>
    <td><input type="number" name="points" value="{{$stat_t1->points}}" placeholder="points" form="{{$stat_t1->player_id}}"/></td>
    <td><input type="number" name="rebounds" value="{{$stat_t1->rebounds}}" placeholder="rebounds" form="{{$stat_t1->player_id}}"/></td>
    <td><input type="number" name="assists" value="{{$stat_t1->assists}}" placeholder="assists" form="{{$stat_t1->player_id}}"/></td>
    <td><input type="number" name="blocks" value="{{$stat_t1->blocks}}" placeholder="blocks" form="{{$stat_t1->player_id}}"/></td>
      @if($admin==1)
    <td><input type="submit" value="Add stats" form="{{$stat_t1->player_id}}"/></td>
    @endif
  </tr>
@endforeach
</table><br />

{{$games->name2 . ' - Stats'}}

<table>
<tr>
  <th>Name</th>
  <th>Points</th>
  <th>Rebounds</th>
  <th>Assists</th>
  <th>Blocks</th>
</tr>

@foreach($stats_t2 as $stat_t2)
<form action="http://localhost:8000/editstat/{{$games->id}}/{{$stat_t2->id}}" method="post" id="{{$stat_t2->player_id}}">{{ csrf_field() }}</form>
  <tr>
    <td>{{$stat_t2->first_name}} {{$stat_t2->last_name}}</td>
    <td><input type="number" name="points" value="{{$stat_t2->points}}" placeholder="points" form="{{$stat_t2->player_id}}"/></td>
    <td><input type="number" name="rebounds" value="{{$stat_t2->rebounds}}" placeholder="rebounds" form="{{$stat_t2->player_id}}"/></td>
    <td><input type="number" name="assists" value="{{$stat_t2->assists}}" placeholder="assists" form="{{$stat_t2->player_id}}"/></td>
    <td><input type="number" name="blocks" value="{{$stat_t2->blocks}}" placeholder="blocks" form="{{$stat_t2->player_id}}"/></td>
    @if($admin==1)
    <td><input type="submit" value="Add stats" form="{{$stat_t2->player_id}}"/></td>
    @endif
  </tr>
@endforeach
</table>

@endsection
