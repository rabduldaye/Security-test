<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\NbiController;
use App\Http\Controllers\AllTimeRankController;
use App\Http\Controllers\MostDivisionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TopPerformanceController;
use App\Http\Controllers\MapController;

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

//home page
Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/home', [HomeController::class, 'home'])->name('home.index');
//admin
Route::get('/admin', [HomeController::class, 'admin'])->name('admin.index')->middleware('is_admin');
//logout
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

//picks -> get/set
Route::get('/picks', 'App\Http\Controllers\GamesController@picks')->name('picks');
Route::get("/picks/{id}",'App\Http\Controllers\GamesController@showPicks')->middleware('auth');
Route::get('/pickdistro', 'App\Http\Controllers\GamesController@pickDistro')->name('pickdistro')->middleware('auth');;
Route::post('storepicks', 'App\Http\Controllers\GamesController@storepicks')->name('storepicks')->middleware('auth');;


//sorting user into divisions/tags
Route::get('user/usersorter', 'App\Http\Controllers\DivisionController@divisionSorter')->name('user.usersorter')->middleware('is_admin');
Route::post('user/adduser2div', 'App\Http\Controllers\DivisionController@addUser2Div')->name('user.adduser2div')->middleware('is_admin');
Route::get('tags/usersorter', 'App\Http\Controllers\TagsController@userSorter')->name('tags.usersorter')->middleware('is_admin');
Route::post('tags/adduser2tag', 'App\Http\Controllers\TagsController@addUser2Tag')->name('tags.adduser2tag')->middleware('is_admin');
//config stuff
Route::get('config/rules', 'App\Http\Controllers\ConfigController@editRules')->name("config.editrules")->middleware('is_admin');
Route::get('rules', 'App\Http\Controllers\ConfigController@showRules')->name("rules")->middleware('auth');
Route::get('map', 'App\Http\Controllers\ConfigController@showMap')->name("map")->middleware('auth');
Route::post('config/rulesupdate','App\Http\Controllers\ConfigController@updateRules')->name("config.rulesupdate")->middleware('is_admin');
Route::get('config', 'App\Http\Controllers\ConfigController@showConfig')->name("config")->middleware('is_admin');
Route::get('config/edit', 'App\Http\Controllers\ConfigController@editConfig')->name("config.edit")->middleware('is_admin');
Route::post('config/update','App\Http\Controllers\ConfigController@updateConfig')->name("config.update")->middleware('is_admin');
Route::get('config/map', 'App\Http\Controllers\ConfigController@editMap')->name("config.editmap")->middleware('is_admin');
Route::post('config/mapupdate','App\Http\Controllers\ConfigController@updateMap')->name("config.mapupdate")->middleware('is_admin');
//toggles season
Route::get('config/toggleSeason','App\Http\Controllers\ConfigController@toggleSeason')->name("config.toggleSeason")->middleware('is_admin');

//Route::get('games/seasons', 'App\Http\Controllers\GamesController@disable')->name('games.disable');

//set scores of games
Route::get("/games/setscore/{id}",'App\Http\Controllers\GamesController@setScore')->middleware('is_admin');
Route::patch("/games/updatescore/{id}",'App\Http\Controllers\GamesController@updateScore')->name('games.updatescore')->middleware('is_admin');

Route::get('/games/scenariogenerator','App\Http\Controllers\GamesController@scenarioGenerator')->name('games.scenariogenerator')->middleware('auth');;

//overall resources (tags - user - division - conference - games)
Route::resource('tags', TagsController::class)->middleware('is_admin');
Route::resource('user', UserController::class)->middleware('auth');
Route::get("/user/editpwd/{id}",'App\Http\Controllers\UserController@editpwd')->name("user.editpwd")->middleware('auth');
Route::post('/user/updatepwd/{id}', 'App\Http\Controllers\UserController@updatepwd')->name('user.updatepwd')->middleware('auth');;
Route::resource('division', DivisionController::class)->middleware('is_admin');
Route::resource('conference', ConferenceController::class)->middleware('is_admin');
Route::resource('games', GamesController::class)->middleware('auth');;

//standings (all four)
Route::get('/standings', 'App\Http\Controllers\StandingsController@showStandings')->name("standings")->middleware('auth');
Route::get('/standings/division/{division}', 'App\Http\Controllers\StandingsController@showStandingsByGivenDivision')->name("divstandings")->middleware('auth');
Route::get('/standings/conference', 'App\Http\Controllers\StandingsController@showStandingsbyConf')->name("confstandings")->middleware('auth');
Route::get('/standings/conference/{conference}', 'App\Http\Controllers\StandingsController@showStandingsbyConfByGivenConference')->name("givenconfstandings")->middleware('auth');
Route::get('/standings/league', 'App\Http\Controllers\StandingsController@showStandingsbyLeague')->name("leaguestandings")->middleware('auth');
Route::get('/standings/category', 'App\Http\Controllers\StandingsController@showStandingsbyTag')->name("tagstandings")->middleware('auth');

Route::get('/standings/category/{tag}', 'App\Http\Controllers\StandingsController@showStandingsbyGivenTag')->name("giventagstandings")->middleware('auth');

//stats
Route::get('/stats', 'App\Http\Controllers\StatsController@showStatsPage')->name("stats")->middleware('auth');
Route::get('/stats/nbi', 'App\Http\Controllers\StatsController@showNBI')->name("stats.nbi")->middleware('auth');
Route::get('/stats/nbi/edit', 'App\Http\Controllers\StatsController@batchUpdateNBI')->name("stats.editnbi")->middleware('is_admin');
Route::post('/stats/nbi/update', 'App\Http\Controllers\StatsController@updateNBI')->name("stats.updatenbi")->middleware('is_admin');

Route::get('/stats/nbi/download', 'App\Http\Controllers\StatsController@downloadNBIData')->name("stats.dlnbi")->middleware('is_admin');
Route::get('/stats/divwins', 'App\Http\Controllers\StatsController@showMostDivisionWins')->name("stats.divwins")->middleware('auth');

// Route::resource('stats/alltimerank', AllTimeRankController::class);
// Route::resource('stats/topperformance', TopPerformanceController::class);
// Route::resource('stats/divisiontitles', MostDivisionController::class);

//email
Route::get('/admin/mail','App\Http\Controllers\MailController@index')->name('mail')->middleware('is_admin');;
//Route::resource('mail', MailController::class);
Route::post('/admin/sendmail', 'App\Http\Controllers\MailController@send')->name('send')->middleware('is_admin');;

//scenario generator

//fun stuff
// -> MAP 
//Route::resource('map', MapController::class);
// -> 
//adds auth routes
Auth::routes();


// // Route::get('/welcome', function () {
// //     return view('/layouts/landing');
// // });

// Route::get('/test', function () {
//     return view('/layouts/test-landing');
// });

// Route::get('/test-profiles', function () {
//     return view('/user/test-index-two');
// });
// // Route::get('/', function () {
// //     return view('/map/index');
// // });


