<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   alex
# @Last modified time: 2017-12-11T14:16:11-05:00
?>
@extends('layouts/app')
@section('content')
<form class="form" action="http://localhost:8000/addteam" enctype="multipart/form-data" method="post">
  {{ csrf_field() }}
  <p><input type="text" name="name" placeholder="name" value="{{old('name')}}"/></p>
  @if($errors->has('name'))
  <p>{{$errors->first('name')}}</p>
  @endif
  <p><input type="text" name="town" placeholder="town" value="{{old('town')}}"/></p>
  @if($errors->has('town'))
  <p>{{$errors->first('town')}}</p>
  @endif
  <select class="" name="conference">
    <option value="">Select conference</option>
    <option value="Est">Est</option>
    <option value="West">West</option>
  </select>
  <select class="" name="division">
    <option value="">Select division</option>
    <option value="Atlantic">Atlantic</option>
    <option value="Central">Central</option>
    <option value="Central">Southeast</option>
    <option value="Central">northwest</option>
    <option value="Central">Pacific</option>
    <option value="Central">Southwest</option>
  </select>
  <p><input type="text" name="stadium_name" placeholder="stadium_name"/></p>
  @if($errors->has('stadium_name'))
  <p>{{$errors->first('stadium_name')}}</p>
  @endif
  <input type="file" name="logo"/><br />
  <input class="btn btn-primary" type="submit" value="Add Team"/>
</form>
@endsection
