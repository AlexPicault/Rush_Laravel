<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-12T10:19:48+01:00



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teams;
use App\Games;
use App\Players;
use App\Stats;
use App\Http\Controllers\StatsController;
use Auth;
use DB;

class GamesController extends Controller
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

  public function ShowGames(){
    $admin = $this->checkAdmin();
    if ($admin != 9)
    {
      $user = Auth::user()->id;
    }
    else
      $user = 0;
    $games = Games
    ::join('teams AS t1', 't1.id', '=', 'games.home_team_id')
    ->join('teams AS t2', 't2.id', '=', 'games.away_team_id')
    ->select('games.*', 't1.name AS name1', 't2.name AS name2')
    ->orderBy('game_date')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get();
    return view('games',[
      'games' => $games,
      'admin' => $admin,
      'user' => $user,
    ]);
  }

  public function ShowGame2($id) {
    $games = Games::find($id);
    return view('editgame',[
      'games' => $games,
    ]);
  }

  public function addGame(Request $request)
  {
    if ($request->isMethod('post'))
    {
      if (request('home_team_score') != '' && request('away_team_score') != '' && request('home_team_score') > request('away_team_score'))
      {
        $winner = request('home_team_id');
        $loser = request('away_team_id');
      }
      else
      {
        $loser = request('home_team_id');
        $winner = request('away_team_id');
      }
      $games = Games::create([
        'home_team_id'=> request('home_team_id'),
        'away_team_id' => request('away_team_id'),
        'home_team_score' => request('home_team_score'),
        'away_team_score' => request('away_team_score'),
        'winner'=> $winner,
        'loser' => $loser,
        'game_date' => request('game_date'),
        'home_team_bet' => request('home_team_bet'),
        'away_team_bet' => request('away_team_bet'),
        'created_at' => date('Y-m-d H:i:s'),
      ]);
      $players = Players::where('teams_current_id', request('home_team_id'))
      ->get();
      $game_id = Games::orderBy('id', 'desc')->first();
      foreach($players as $player)
      {
        $stats = Stats::create([
          'player_id'=> $player->id,
          'game_id'=> $game_id->id,
          'created_at' => date('Y-m-d H:i:s')
        ]);
      }
      $players = Players::where('teams_current_id', request('away_team_id'))
      ->get();
      foreach($players as $player)
      {
        $stats = Stats::create([
          'player_id'=> $player->id,
          'game_id'=> $game_id->id,
          'created_at' => date('Y-m-d H:i:s')
        ]);
      }
    }
    $teams = Teams::all();
    return view('addgame',[
      'teams' => $teams,
    ]);
  }

  public function editGame(Request $request, $id)
  {
    $admin = $this->checkAdmin();
    if ($admin != 1)
    {
      return redirect('/login');
    }
    else
    {
      if ($request->isMethod('post'))
      {
        $game = Games::find($id);
        $game->home_team_score = request('home_team_score');
        $game->away_team_score = request('away_team_score');
        $game->winner = request('winner');
        $game->loser = request('loser');
        $game->home_team_bet = request('home_team_bet');
        $game->away_team_bet = request('away_team_bet');
        $game->updated_at = date('Y-m-d H:i:s');
        $game->save();
      }

      $games = Games
      ::join('teams AS t1', 't1.id', '=', 'games.home_team_id')
      ->join('teams AS t2', 't2.id', '=', 'games.away_team_id')
      ->select('games.*', 't1.name AS name1', 't2.name AS name2')
      ->where('games.id', $id)
      ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
      ->first();
      $stats_t1 = Stats
      ::join('players', 'players.id', '=', 'stats.player_id')
      ->select('stats.*', 'players.last_name', 'players.first_name', 'players.teams_current_id')
      ->where('stats.game_id', '=', $id)
      ->where('players.teams_current_id', '=', $games->home_team_id)
      ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
      ->get();
      $stats_t2 = Stats
      ::join('players', 'players.id', '=', 'stats.player_id')
      ->select('stats.*', 'players.last_name', 'players.first_name', 'players.teams_current_id')
      ->where('stats.game_id', '=', $id)
      ->where('players.teams_current_id', '=', $games->away_team_id)
      ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
      ->get();
      return view('editgame',[
        'games' => $games,
        'stats_t1' => $stats_t1,
        'stats_t2' => $stats_t2,
        'admin'=>$admin,
      ]);
    }
  }

  public function showGame(Request $request, $id)
  {
    $admin = $this->checkAdmin();
    if ($admin != 9)
    {
      $user = Auth::user()->id;
    }
    else
      $user = 0;
    $games = Games
    ::join('teams AS t1', 't1.id', '=', 'games.home_team_id')
    ->join('teams AS t2', 't2.id', '=', 'games.away_team_id')
    ->select('games.*', 't1.name AS name1', 't2.name AS name2')
    ->where('games.id', $id)
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->first();
    $stats_t1 = Stats
    ::join('players', 'players.id', '=', 'stats.player_id')
    ->select('stats.*', 'players.last_name', 'players.first_name', 'players.teams_current_id')
    ->where('stats.game_id', '=', $id)
    ->where('players.teams_current_id', '=', $games->home_team_id)
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get();
    $stats_t2 = Stats
    ::join('players', 'players.id', '=', 'stats.player_id')
    ->select('stats.*', 'players.last_name', 'players.first_name', 'players.teams_current_id')
    ->where('stats.game_id', '=', $id)
    ->where('players.teams_current_id', '=', $games->away_team_id)
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get();
    return view('showgame',[
      'games' => $games,
      'stats_t1' => $stats_t1,
      'stats_t2' => $stats_t2,
      'admin'=>$admin,
    ]);
  }

  public function editStat(Request $request, $id, $player)
  {
    $admin = $this->checkAdmin();
    if ($admin == 9)
    {
      return redirect('/login');
    }
    else
    {
      if ($request->isMethod('post'))
      {
        $stat = Stats::where([['game_id', $id], ['id', $player]])->first();
        $stat->points = request('points');
        $stat->rebounds = request('rebounds');
        $stat->assists = request('assists');
        $stat->blocks = request('blocks');
        $stat->updated_at = date('Y-m-d H:i:s');
        $stat->save();
      }

      $games = Games
      ::join('teams AS t1', 't1.id', '=', 'games.home_team_id')
      ->join('teams AS t2', 't2.id', '=', 'games.away_team_id')
      ->select('games.*', 't1.name AS name1', 't2.name AS name2')
      ->where('games.id', $id)
      ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
      ->first();
      $teams = Teams::all();
      $stats_t1 = Stats
      ::join('players', 'players.id', '=', 'stats.player_id')
      ->select('stats.*', 'players.last_name', 'players.first_name', 'players.teams_current_id')
      ->where('stats.game_id', '=', $id)
      ->where('players.teams_current_id', '=', $games->home_team_id)
      ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
      ->get();
      $stats_t2 = Stats
      ::join('players', 'players.id', '=', 'stats.player_id')
      ->select('stats.*', 'players.last_name', 'players.first_name', 'players.teams_current_id')
      ->where('stats.game_id', '=', $id)
      ->where('players.teams_current_id', '=', $games->away_team_id)
      ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
      ->get();
      return view('editgame',[
        'games' => $games,
        'teams' => $teams,
        'stats_t1' => $stats_t1,
        'stats_t2' => $stats_t2,
        'admin'=>$admin,
      ]);
    }
  }

  public function delete($id){
    DB::table('stats')->where('game_id', '=', $id)->delete();
    $game = Games::find($id);
    $game->delete();
    return redirect('games');
  }
}
