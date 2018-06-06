<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   alex
# @Last modified time: 2017-12-11T14:15:45-05:00

?>
@extends('layouts/app')
@section('content')
<form class="form" action="http://localhost:8000/addplayer" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
  <p>
  <select class="" name="teams_current_id">
    @foreach($teams as $team)
      <option value="{{$team->id}}">{{$team->name}}</option>
    @endforeach
  </select></p>
  <p><input type="text" name="first_name" placeholder="first_name" /></p>
  @if($errors->has('first_name'))
  <p>{{$errors->first('first_name')}}</p>
  @endif
  <p><input type="text" name="last_name" placeholder="last_name" /></p>
  @if($errors->has('last_name'))
  <p>{{$errors->first('last_name')}}</p>
  @endif
  <p><input type="text" name="height" placeholder="height" /></p>
  @if($errors->has('height'))
  <p>{{$errors->first('height')}}</p>
  @endif
  <p><input type="text" name="weight" placeaddplayerholder="weight" /></p>
  @if($errors->has('weight'))
  <p>{{$errors->first('weight')}}</p>
  @endif
  <p><select class="" name="starting_five">
    <option value="">Select Status</option>
    <option value="1">Starter</option>
    <option value="0">Bench</option>
  </select></p>
  <p><select class="" name="position">
    <option value="">Select Status</option>
    <option>PG</option>
    <option>SF</option>
    <option>SG</option>
    <option>PF</option>
    <option>C</option>
  </select></p>
  <p><input type="number" name="number_shirt" placeholder="number_shirt" /></p>
  @if($errors->has('number_shirt'))
  <p>{{$errors->first('number_shirt')}}</p>
  @endif
<input type="file" name="picture"/><br />
  <input class="btn btn-primary" type="submit" value="Add Player"/>
</form>
@endsection
