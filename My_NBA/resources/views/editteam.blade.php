<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   alex
# @Last modified time: 2017-12-11T14:17:02-05:00

?>
@extends('layouts/app')
@section('content')
<form class="form" action="http://localhost:8000/editteam/{{$team->id}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
  <p><input type="text" name="name" value="{{$team->name}}" /></p>
  @if($errors->has('name'))
  <p>{{$errors->first('name')}}</p>
  @endif
  <p><input type="text" name="town" value="{{$team->town}}"/></p>
  @if($errors->has('town'))
  <p>{{$errors->first('town')}}</p>
  @endif
  <select class="" name="conference">
    <option {{$team->conference == 'Est' ? 'selected' : ''}}>Est</option>
    <option {{$team->conference == 'West' ? 'selected' : ''}}>West</option>
  </select>
  <select class="" name="division">
    <option {{$team->division == 'Atlantic' ? 'selected' : ''}}>Atlantic</option>
    <option {{$team->division == 'Central' ? 'selected' : ''}}>Central</option>
    <option {{$team->division == 'Southeast' ? 'selected' : ''}}>Southeast</option>
    <option {{$team->division == 'Northwest' ? 'selected' : ''}}>Northwest</option>
    <option {{$team->division == 'Pacific' ? 'selected' : ''}}>Pacific</option>
    <option {{$team->division == 'Southwest' ? 'selected' : ''}}>Southwest</option>
  </select>
  <p><input type="text" name="stadium_name" value="{{$team->stadium_name}}"/></p>
  @if($errors->has('stadium_name'))
  <p>{{$errors->first('stadium_name')}}</p>
  @endif
    <input type="file" name="logo"/><br />
  <input class="btn btn-primary" type="submit" value="Edit Team"/>
</form>
@endsection
