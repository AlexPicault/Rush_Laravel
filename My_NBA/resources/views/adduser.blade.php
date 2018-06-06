<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   alex
# @Last modified time: 2017-12-11T14:16:26-05:00

?>
@extends('layouts/app')
@section('content')
<form class="form" action="http://localhost:8000/adduser" method="post">
    {{ csrf_field() }}
  <p><input type="text" name="name" placeholder="name" value="{{old('name')}}"/></p>
  @if($errors->has('name'))
    <p>{{$errors->first('name')}}</p>
    @endif
  <p><input type="text" name="email" placeholder="email" value="{{old('email')}}"/></p>
  @if($errors->has('email'))
    <p>{{$errors->first('email')}}</p>
    @endif
  <p><input type="password" name="password" placeholder="password"/></p>
  @if($errors->has('password'))
    <p>{{$errors->first('password')}}</p>
    @endif
  <p><input type="password" name="password_confirmation" placeholder="password"/></p>
  @if($errors->has('password_confirmation'))
    <p>{{$errors->first('password_confirmation')}}</p>
    @endif
  <select class="" name="status">
    <option value="">Select Status</option>
    <option value="1">Admin</option>
    <option value="0">User</option>
  </select><br />
  <input class="btn btn-primary" type="submit" name="delete" value="Delete"/>
  <input  class="btn btn-primary" type="submit" value="Add User"/>
</form>
@endsection
