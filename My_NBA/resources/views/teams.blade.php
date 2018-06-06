<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   alex
# @Last modified time: 2017-12-22T06:05:07-05:00
?>
<style media="screen">
</style>

@extends('layouts/app')
@section('content')

<div class ="a">
    <div class="add"><a href="http://localhost:8000/addteam" class="add">Add Team</a><br />
      @if($admin == 1)
      <a href="/users">Admin user</a><br />
      @endif
      @if($admin == 0)
      <a href="/edituser/{{$user}}">Edit profil</a>
      @endif
    </div>


  <div class="container">
    <div class="row">
      @foreach($teams as $team)
      <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
        <img src="{{URL::asset('storage/' . $team->logo)}}" width="100" height="100"/>
        <a href="one_team/{{$id = $team->id}}" class="btn btn-info">{{$team->name}} {{$team->town}}</a><br />
        Conference : {{$team->conference}}<br />
        Division : {{$team->division}}<br />
        {{$team->create_year}}
        Stadium : {{$team->stadium_name}}<br />
        @if($admin==1)
        <form class="" action="http://localhost:8000/teams/delete/{{$id = $team->id}}" method="post" onsubmit="return confirm('Are you sure you want to delete {{$team->name}}?')">
          {{csrf_field()}}
          <input class="btn btn-primary" type="submit" name="delete" value="Delete {{$team->name}}"/>
          <a href="editteam/{{$id = $team->id}}" class="btn btn-primary">Edit {{$team->name}}</a>
        </form>
        @endif
      </div>
      @endforeach
    </div>
  </div>
  @endsection
</div>
