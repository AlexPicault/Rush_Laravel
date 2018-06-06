<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-12T08:36:19+01:00

?>

@extends('layouts/app')
@section('content')

  <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
  {{$games->game_date}}<br />
  <strong>{{$games->name1}}</strong><br />
  Score - {{$games->home_team_score}}<br />
  Bet - {{$games->home_team_bet}}<br /><br />
  <strong>{{$games->name2}}</strong><br />
  Score - {{$games->away_team_score}}<br />
  Bet - {{$games->away_team_bet}}
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
  <tr>
    <td>{{$stat_t1->first_name}} {{$stat_t1->last_name}}</td>
    <td>{{$stat_t1->points}}</td>
    <td>{{$stat_t1->rebounds}}</td>
    <td>{{$stat_t1->assists}}</td>
    <td>{{$stat_t1->blocks}}</td>
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
  <tr>
    <td>{{$stat_t2->first_name}} {{$stat_t2->last_name}}</td>
    <td>{{$stat_t2->points}}</td>
    <td>{{$stat_t2->rebounds}}</td>
    <td>{{$stat_t2->assists}}</td>
    <td>{{$stat_t2->blocks}}</td>
  </tr>
@endforeach
</table>

@endsection
