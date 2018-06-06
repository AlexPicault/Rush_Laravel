<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-11T20:48:30+01:00

?>
@extends('layouts/app')
@section('content')
<form class="form" action="http://localhost:8000/editplayer/{{$player->id}}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
<select class="" name="teams_current_id">
  @foreach($teams as $team)
<option value="{{$team->id}}" {{$team->id == $player->teams_current_id ? 'selected' : ''}}>{{$team->name}}</option>
  @endforeach
</select>
<p><input type="text" name="first_name" placeholder="first_name" value="{{$player->first_name}}"/></p>
@if($errors->has('first_name'))
<p>{{$errors->first('first_name')}}</p>
@endif
<p><input type="text" name="last_name" placeholder="last_name" value="{{$player->last_name}}"/></p>
@if($errors->has('last_name'))
<p>{{$errors->first('last_name')}}</p>
@endif
<p><input type="text" name="height" placeholder="height" value="{{$player->height}}"/></p>
@if($errors->has('height'))
<p>{{$errors->first('height')}}</p>
@endif
<p><input type="text" name="weight" placeholder="weight" value="{{$player->weight}}"/></p>
@if($errors->has('weight'))
<p>{{$errors->first('weight')}}</p>
@endif
<p><select class="" name="starting_five"></p>
  <option value="1" {{$player->starting_five == 1 ? 'selected' : ''}}>Starter</option>
  <option value="0" {{$player->starting_five == 0 ? 'selected' : ''}}>Bench</option>
</select>
<p><select class="" name="position">
  <option {{$player->position == 'PG' ? 'selected' : ''}}>PG</option>
  <option {{$player->position == 'SF' ? 'selected' : ''}}>SF</option>
  <option {{$player->position == 'SG' ? 'selected' : ''}}>SG</option>
  <option {{$player->position == 'PF' ? 'selected' : ''}}>PF</option>
  <option {{$player->position == 'C' ? 'selected' : ''}}>C</option>
</select></p>
<p><input type="number" name="number_shirt" placeholder="number_shirt" value="{{$player->number_shirt}}" /></p>
@if($errors->has('number_shirt'))
<p>{{$errors->first('number_shirt')}}</p>
@endif
  <p><input type="file" name="picture"/></p><br />
<p><input class="btn btn-primary" type="submit" value="Edit Player"/></p>
</form>
@endsection
