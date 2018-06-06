<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-11T21:04:44+01:00

?>
@extends('layouts/app')
@section('content')
<form class="form" action="http://localhost:8000/edituser/{{$user->id}}" method="post">
  {{ csrf_field() }}
  <p><input type="text" name="name" value="{{$user->name}}" /></p>
  @if($errors->has('name'))
    <p>{{$errors->first('name')}}</p>
    @endif
  <p><input type="text" name="email" value="{{$user->email}}" /></p>
  @if($errors->has('email'))
    <p>{{$errors->first('email')}}</p>
    @endif
  <p><input type="password" name="password" value="password" /></p>
  @if($errors->has('password'))
    <p>{{$errors->first('password')}}</p>
    @endif
  <p><input type="password" name="password_confirmation" value="password"/></p>
  @if($errors->has('password_confirmation'))
    <p>{{$errors->first('password_confirmation')}}</p>
    @endif
    @if ($admin == 1)
  <select class="" name="status">
    <option value="{{$id = $user->status}}">Select Status User vs Admin</option>
    <option value="1">Admin</option>
    <option value="0">Status</option>
  </select><br />
  @endif
  <input class="btn btn-primary" type="submit" name="delete" value="Delete"/>
  <input  class="btn btn-primary" type="submit" value="Edit user"/>
</form>
@endsection
