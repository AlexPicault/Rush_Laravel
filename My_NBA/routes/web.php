<?php
# @Author: thomas
# @Date:   2017-12-08T11:39:52+01:00
# @Last modified by:   thomas
# @Last modified time: 2017-12-11T21:12:24+01:00




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'GamesController@ShowGames')->name('home');
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'GamesController@ShowGames')->name('home');

Auth::routes();

Route::get('/teams', ['uses' =>'TeamsController@ShowTeams', 'as' => 'showTeams']);
Route::get('/test', ['uses' =>'TeamsController@ShowTeam', 'as' => 'show_one']);
Route::match(['get', 'post'], 'editteam/{id}', ['uses' => 'TeamsController@editTeam','as' => 'editteam']);
Route::match(['get', 'post'], 'teams/delete/{id}', ['uses' => 'TeamsController@delete','as' => 'deleteteam']);
Route::match(['get', 'post'], '/addteam', ['uses' => 'TeamsController@addTeam','as' => 'addteam']);

Route::get('/users', ['uses' =>'UsersController@ShowUsers', 'as' => 'showUsers']);
Route::match(['get', 'post'], '/adduser', ['uses' => 'UsersController@addUser','as' => 'adduser']);
Route::match(['get', 'post'], 'edituser/{id}', ['uses' => 'UsersController@editUser','as' => 'edituser']);
Route::match(['get', 'post'], 'users/delete/{id}', ['uses' => 'UsersController@delete','as' => 'deleteuser']);

Route::get('/players', ['uses' =>'PlayersController@ShowPlayers', 'as' => 'showplayers']);
Route::get('/test', ['uses' =>'PlayersController@ShowPlayer', 'as' => 'show_one_player']);
Route::match(['get', 'post'], 'editplayer/{id}', ['uses' => 'PlayersController@editPlayer','as' => 'editplayer']);
Route::match(['get', 'post'], 'players/delete/{id}', ['uses' => 'PlayersController@delete','as' => 'deleteplayer']);
Route::match(['get', 'post'], 'addplayer', ['uses' => 'PlayersController@addPlayer','as' => 'addplayer']);
//Route::match(['get', 'post'], 'addplayer', ['uses' => 'PlayersController@storeTeam','as' => 'storeteam']);

Route::get('/one_team/{id}', ['uses' =>'PlayersController@ShowPlayer_team', 'as' => 'showPlayers_team']);

Route::get('/games', ['uses' =>'GamesController@ShowGames', 'as' => 'showgames']);
Route::get('/test', ['uses' =>'GamesController@ShowGame', 'as' => 'show_one_game']);
Route::match(['get', 'post'], 'editgame/{id}', ['uses' => 'GamesController@editGame','as' => 'editgame']);
Route::match(['get', 'post'], 'showgame/{id}', ['uses' => 'GamesController@showGame','as' => 'showgame']);
Route::match(['get', 'post'], 'games/delete/{id}', ['uses' => 'GamesController@delete','as' => 'deletegame']);
Route::match(['get', 'post'], '/addgame', ['uses' => 'GamesController@addGame','as' => 'addgame']);
