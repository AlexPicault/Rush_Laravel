<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-12T10:12:22+01:00

?>
<body>

  @extends('layouts/app')
  @section('content')

  <div class="add">
    <a href="addplayer">Add Player</a><br />
    @if($admin == 1)
    <a href="/users">Admin user</a><br />
    @endif
    @if($admin == 0)
    <a href="/edituser/{{$user}}">Edit profil</a>
    @endif
  </div>
  <div class="container">
    <div class="row">
      @foreach($players as $player)
      <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
        <img src="{{URL::asset('storage/' . $player->picture)}}" width="100" height="80"/>
        {{$player->first_name}} {{$player->last_name}}<br />
        {{$player->birthdate}}<br />
        Height : {{$player->height}}<br />
        Weight : {{$player->weight}}<br />
        Starting five : {{$player->starting_five}}<br />
        Position : {{$player->position}}<br />
        Number {{$player->number_shirt}}<br />
        @if($admin==1)
        <form class="" action="http://localhost:8000/players/delete/{{$id = $player->id}}" method="post" onsubmit="return confirm('Are you sure you want to delete {{$player->last_name}}?')">
          {{csrf_field()}}
          <input class="btn btn-primary" type="submit" name="delete" value="Delete"/>
          <a class="btn btn-primary" href="editplayer/{{$id = $player->id}}">Edit Player</a>
        </form>
        @endif
      </div>
      @endforeach
    </div>
  </div>
</body>
@endsection
