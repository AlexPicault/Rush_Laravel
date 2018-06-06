<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-12T10:14:16+01:00



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teams;
use App\Games;
use App\Players;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;

class PlayersController extends Controller
{
  public function checkAdmin(){
    if (Auth::check() && Auth::user()->status==0)
    {
      return 0;
    }
    else if (Auth::check() && Auth::user()->status==1)
    {
      return 1;
    }
    else
    {
      return 9;
    }
  }

  public function ShowPlayers(){
    $admin = $this->checkAdmin();
    if ($admin != 9)
    {
      $user = Auth::user()->id;
    }
    else
      $user = 0;
    $players = Players
    ::join('teams', 'teams.id', '=', 'players.teams_current_id')
    ->select('players.*', 'teams.name')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get();
    return view('players',[
      'players' => $players,
      'admin'=>$admin,
      'user' => $user,
    ]);
  }

  public function ShowPlayer($id) {
    $players = Players::find($id);
    return view('editplayer',[
      'players' => $players,
    ]);
  }

  public function ShowPlayer_team($id) {
    $team = Teams::find($id);
    $players = Players::where('teams_current_id', $id)
    ->get();
    $stats = DB::table('stats')
    ->select('stats.player_id', DB::raw('ROUND(AVG(points), 1) as points'), DB::raw('ROUND(AVG(rebounds), 1) as rebounds'), DB::raw('ROUND(AVG(assists), 1) as assists'), DB::raw('ROUND(AVG(blocks), 1) as blocks'))
    ->groupBy('player_id')
    ->get();
    $win_team = DB::table('games')
    ->select(DB::raw('COUNT(id) as win'))
    ->where('winner', $id)
    ->get();
    $lose_team = DB::table('games')
    ->select(DB::raw('COUNT(id) as lose'))
    ->where('loser', $id)
    ->get();
    $home_team = DB::table('games')
    ->select(DB::raw('ROUND(AVG(home_team_score), 2) as home_score'), DB::raw('ROUND(AVG(away_team_score), 2) as opp_home_score'))
    ->where('home_team_id', $id)
    ->get();
    $away_team = DB::table('games')
    ->select(DB::raw('ROUND(AVG(away_team_score), 2) as away_score'), DB::raw('ROUND(AVG(home_team_score), 2) as opp_away_score'))
    ->where('away_team_id', $id)
    ->get();
    return view('one_team',[
      'team' => $team,
      'players' => $players,
      'stats' => $stats,
      'wins' => $win_team,
      'loses' => $lose_team,
      'home' => $home_team,
      'away' => $away_team,
    ]);
  }

  public function addPlayer(Request $request)
  {
    if ($request->isMethod('post'))
    {
      request()->validate([
        'first_name'=>['required','min:5'],
        'last_name'=>['required','min:3'],
        'height'=>['required'],
        'weight'=>['required'],
        'number_shirt'=>['required','integer'],
      ]);

      $player = Players::create([
        'teams_current_id'=> request('teams_current_id'),
        'first_name' => request('first_name'),
        'last_name' => request('last_name'),
        'birthdate' => ('2000-12-12'),
        'height'=> request('height'),
        'weight' => request('weight'),
        'picture' => request('picture')->getClientOriginalName(),
        'starting_five' => request('starting_five'),
        'position' => request('position'),
        'number_shirt' => request('number_shirt'),
        'created_at' => date('Y-m-d H:i:s'),
        Storage::putFileAs('public', $request->file('picture'), $request->file('picture')->getClientOriginalName()),
      ]);
    }
    $teams = Teams::all();
    return view('addplayer',[
      'teams' => $teams,
    ]);
  }

  public function editPlayer(Request $request, $id)
  {
    if ($request->isMethod('post'))
    {
      request()->validate([
        'first_name'=>['required','min:5'],
        'last_name'=>['required','min:3'],
        'height'=>['required'],
        'weight'=>['required'],
        'number_shirt'=>['required','integer'],
      ]);

      $player = Players::find($id);
      $player->teams_current_id = request('teams_current_id');
      $player->first_name = request('first_name');
      $player->last_name = request('last_name');
      $player->birthdate = ('200-12-12');
      $player->height = request('height');
      $player->weight = request('weight');
      $player->picture = request('picture')->getClientOriginalName();
      $player->starting_five = request('starting_five');
      $player->position = request('position');
      $player->number_shirt = request('number_shirt');
      $player->updated_at = date('Y-m-d H:i:s');
      Storage::putFileAs('public', $request->file('picture'), $request->file('picture')->getClientOriginalName());
      $player->save();
    }
    $player = Players::find($id);
    $teams = Teams::all();
    return view('editplayer',[
      'player' => $player,
      'teams' => $teams,
    ]);
  }

  public function delete($id){
    $player = Players::find($id);
    $player->delete();
    return redirect('players');
  }
}
