<?php
# @Author: alex
# @Date:   2017-12-10T10:50:17-05:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-12T09:47:45+01:00
?>
<body>
  @extends('layouts/app')
  @section('content')
  <div class="container">
    <h1>{{$team->name}}</h1>
    Wins : @foreach ($wins as $win) {{$win->win}}  @endforeach   -    Loses : @foreach ($loses as $lose) {{$lose->lose}}  @endforeach <br />
    Home Pts/Gm : @foreach ($home as $hom) {{$hom->home_score}}  - Opponent Pts/Gm : {{$hom->opp_home_score}}  @endforeach <br />
    Away Pts/Gm : @foreach ($away as $awa) {{$awa->away_score}}  - Opponent Pts/Gm : {{$awa->opp_away_score}}  @endforeach
    <div class="row">
      @foreach($players as $player)
      <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
        <img src="{{URL::asset('storage/' . $player->picture)}}" width="100" height="80"/ />
        {{$player->first_name}}
        {{$player->last_name}}<br />
        {{$player->birthdate}}<br />
        Height : {{$player->height}}     -
        Weight : {{$player->weight}}<br />
        @if ($player->position != 'Coach' )
        Starting five : {{$player->starting_five}}     -
        @endif
        Position : {{$player->position}}<br />
        @if ($player->position != 'Coach' )
        Number {{$player->number_shirt}}<br />
        @endif
        @foreach ($stats as $stat)
        @if ($stat->player_id == $player->id && $player->position != 'Coach' )
          <strong>Pts/Gm : {{$stat->points}}</strong>      -
          <strong>Rbds/Gm : {{$stat->rebounds}}</strong><br />
          <strong>Assists/Gm : {{$stat->assists}}</strong>      -
          <strong>Bks/Gm : {{$stat->blocks}}</strong>
          @endif
        @endforeach
      </div>
      @endforeach
    </div>
  </div>
</body>
@endsection
