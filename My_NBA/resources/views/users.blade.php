<?php
# @Author: alex
# @Date:   2017-12-08T08:21:12-05:00
# @Last modified by:   alex
# @Last modified time: 2017-12-11T06:11:17-05:00
?>
<body>
  @extends('layouts/mainlayout')
  @extends('layouts/navbar')
  @section('navbar')
  @section('start')
    <div class="add"><a href="adduser">Add User</a></div>
  <div class="container">
    <div class="row">
      @foreach($users as $user)
      <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">7
        {{$user->name}}
        {{$user->email}}
        <form class="" action="http://localhost:8000/users/delete/{{$user->id}}" method="post" onsubmit="return confirm('Are you sure you want to delete {{$user->name}}?')">
          {{csrf_field()}}
          <input class="btn btn-primary" type="submit" name="delete" value="Delete"/>
          <a href="edituser/{{$user->id}}" class="btn btn-primary" >Edit User</a>
        </form>

      </div>
      @endforeach
    </div>
  </div>
</body>
@endsection
