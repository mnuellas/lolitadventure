<?php

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

use Illuminate\Http\Request;

Route::get('/', 'ProfilController@Welcome')->name('home');
Route::get('/home', 'ProfilController@Welcome');
Auth::routes();

Route::get('/images/{what}/{type}/{lang}/{carte}', [
     'as'         => 'images.show',
     'uses'       => 'ImagesController@show',
]);

Route::get('/shop', function() {
  return view('shop');
})->name('shop');

Route::get('/fr', function() {
  session(['lang' => 'fr']);
  return redirect('home');
})->name('fr');

Route::get('/en', function() {
  session(['lang' => 'en']);
  return redirect('home');
})->name('en');

Route::get('/digitalShop', function() {
  return view('digitalShop');
})->name('digital shop');

Route::get('/boardShop', function() {
  return view('realShop');
})->name('boards shop');

Route::get('/chooseRoom', 'RoomController@selectRoom')->name('chooseRoom');
Route::get('/createRoom', 'RoomController@createRoomView')->name('createRoom');
Route::post('/createRoom', 'RoomController@createRoom')->name('createRoom');
Route::get('/waitRoom', function(Request $request) {
  return view('waitRoom', ['url' => $request->input('url')]);
})->middleware('checkRoomUrl')->name('waitRoom');


Route::get('/connectRoom/{room}', function ($room) {
  return view('connectRoom', ['room_url' => $room]);
})->name('connectRoom');

Route::post('/connectRoom', 'RoomController@joinRoom')->name('connectRoom');
Route::post('/someonejoined', 'RoomController@someoneJoined');
Route::post('/everybodyhere', 'RoomController@everybodyhere');
Route::post('/okredirectUs', function(Request $request) {
  $request->session()->put('room',  $request['room']);
  $request->session()->put('number_personn', $request['number_personn']);
  $request->session()->put('player_nbr', $request["player_number"]);
  return response('ok');
});
Route::post('/finishedTuto', 'RoomController@finishedTuto');
Route::post('/throwDice', 'RoomController@throwDice');
Route::post('/playCard', 'RoomController@playCard');
Route::post('/playedEvent', 'RoomController@playedEvent');
Route::post('/playedQuizz', 'RoomController@playedQuizz');

Route::get('/playRoom', 'RoomController@play');

Route::get('/room', function() {
  return view('room');
})->name('room');

Route::post('/change_user', 'ProfilController@change_username')->name('change_username');

Route::post('/change_email', 'ProfilController@change_email')->name('change_email');

Route::get('/add_deck', 'ProfilController@add_deck');

Route::get('/change_set', 'ProfilController@change_set');

Route::get('/compte', 'ProfilController@getProfil')
  ->middleware('auth')
  ->name('profil');//->middleware('auth')
Route::post('/ajaxRequest', 'ProfilController@dbPost');
Route::get('/quizz', 'ProfilController@quizz');
Route::get('/event', 'ProfilController@event');
Route::get('/action', 'ProfilController@action');
Route::get('Lexicon', function() {
  return view('lexicon');
})->name('lexicon');
Route::get('/error', function(Request $error) {
  return view('error', ["error" => $error]);
})->name('error');

//toujours la dernière route, c'est le fallack
Route::get('/{any}', function () {
  return view('error');
});
