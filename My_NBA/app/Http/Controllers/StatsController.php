<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-11T12:33:28+01:00



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Players;
use App\Games;
use App\Stats;
use DB;

class StatsController extends Controller
{

  public function ShowStats(){
    $stats = Stats
    ::join('games', 'games.id', '=', 'stats.game_id')
    ->join('players', 'players.id', '=', 'stats.player_id')
    ->select('stats.*', 'player.last_name', 'player.first_name')
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get();
    return view('stats',[
      'stats' => $stats,
    ]);
  }

  public function ShowStat($id) {
    $stats = Stats::find($id);
    return view('editstat',[
      'stats' => $stats,
    ]);
  }

  public function addStats(Request $request)
  {
    if ($request->isMethod('post'))
    {
      $stats = Stats::create([
        'player_id'=> request('player_id'),
        'game_id' => request('game_id'),
        'points' => request('points'),
        'rebounds' => request('rebounds'),
        'assists'=> request('assists'),
        'blocks' => request('blocks'),
        'created_at' => date('Y-m-d H:i:s'),
      ]);
    }
    return view('addstat');
  }

  public function editStats(Request $request, $id)
  {
    if ($request->isMethod('post'))
    {
      $stat = Stats::find($id);
      $stat->player_id = request('player_id');
      $stat->game_id = request('game_id');
      $stat->points = request('points');
      $stat->rebounds = request('rebounds');
      $stat->assists = request('assists');
      $stat->blocks = request('blocks');
      $stat->faults = request('faults');
      $stat->updated_at = date('Y-m-d H:i:s');
      $stat->save();
    }
    $stat = Stats::find($id);
    return view('editstat',[
      'stat' => $stat,
    ]);
  }

  public function delete($id){
    $stat = Stats::find($id);
    $stat->delete();
    return redirect('stats');
  }
}
