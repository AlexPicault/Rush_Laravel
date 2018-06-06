<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   alex
# @Last modified time: 2018-02-01T08:50:44-05:00

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teams;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;

class TeamsController extends Controller
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

  public function ShowTeams(){
    $admin = $this->checkAdmin();
    if ($admin != 9)
    {
      $user = Auth::user()->id;
    }else {
      $user = 0;
    }
    $teams = Teams::all();
    return view('teams',[
      'teams' => $teams,
      'admin'=>$admin,
      'user' => $user,
    ]);
  }

  public function ShowTeam($id) {
    $team = Teams::find($id);
    return view('editteam',[
      'team' => $team,
    ]);
  }

  public function storeTeam(Request $request){

    if($request->hasFile('logo')){
      $request->file('logo');
    }
    return $request->logo->store('public.img');
  }

  public function addTeam(Request $request)
  {
    if ($request->isMethod('post'))
    {

      request()->validate([
        'name'=>['required','min:5'],
        'town'=>['required','min:5'],
        'logo'=>['image','file','filled'],
        'stadium_name'=>['required','min:5'],
      ]);
      $team = Teams::create([
        'name'=> request('name'),
        'town' => request('town'),
        'logo' => request('logo')->getClientOriginalName(),
        'conference' => request('conference'),
        'division'=> request('division'),
        'stadium_name' => request('stadium_name'),
        'created_' => date('Y-m-d H:i:s'),
        Storage::putFileAs('public', $request->file('logo'), $request->file('logo')->getClientOriginalName()),
      ]);
    }
    return view('addteam');
  }

  public function editTeam(Request $request, $id) 
  {
    if ($request->isMethod('post'))
    {
      request()->validate([
        'name'=>['required','min:5'],
        'town'=>['required','min:5'],
        'stadium_name'=>['required','min:5'],
      ]);

      $team = Teams::find($id);
      $team->name = request('name');
      $team->town = request('town');
      $team->logo = request('logo')->getClientOriginalName();
      $team->conference = request('conference');
      $team->division = request('division');
      $team->stadium_name = request('stadium_name');
      $team->updated_at = date('Y-m-d H:i:s');
      Storage::putFileAs('public', $request->file('logo'), $request->file('logo')->getClientOriginalName());
      $team->save();
    }
    $team = Teams::find($id);
    return view('editteam',[
      'team' => $team,
    ]);
  }

  public function delete($id){
    $team = Teams::find($id);
    $team->delete();
    return redirect('teams');
  }
}
