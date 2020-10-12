<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Events\RoomJoinedEvent;
use App\Events\someoneJoined;
use App\Events\EverybodyHereEvent;
use App\Events\printRenameEvent;
use App\Events\finishedTutoEvent;
use App\Events\throwDiceEvent;
use App\Events\playCardEvent;
use App\Events\playedEventEvent;
use App\Events\playedQuizzEvent;
use App\Events\playDefiEvent;
use App\Events\playingDefiEvent;
use App\Events\spiedEvent;
use App\Events\playedActionEvent;

class RoomController extends Controller
{
    public function selectRoom() {
        $rooms = DB::table("rooms")->get();
        return view('chooseRoom', ['rooms' => $rooms]);
    }

    public function getLang() {
        if(session()->exists('lang')) {
          return session('lang');
        } else {
          return app()->getLocale();
        }
    }

    public function createRoomView($error = 0) {
        //TODO faire ça en un seul return quand t'as le temps en jouant avec set = basic de base
        $sets = ['basic'];
        $privilege = ['basic'];
        $defaultSet = 'basic';
        $playing = ['basic'];
        if (Auth::check()) {
            $user = DB::table("users")->where('id', '=', Auth::id())->get();
            $sets = array();
            $privilege = array();
            foreach(explode(",", $user[0]->sets) as $set) {
              array_push($sets, DB::table("sets")->where('name', '=', $set)->get());
            }
              $sets = explode(",", $user[0]->sets);
              $privilege = explode(",", $user[0]->privileges);
              $defaultSet = $user[0]->DefaultBackground;
              $playing = explode(",", $user[0]->playing);
        }
        return view('createRoom', [
            'sets' => $sets,
            'privileges' => $privilege,
            'defaultSet' => $defaultSet,
            'playing' => $playing,
            'error' => $error
        ]);
    }

    public function createRoom(Request $request) {
        $room = DB::table('rooms')
        ->where('url', $request['room_url'])->get();
        $decks = "";
        if (count($room) == 0) {
            foreach($request["play"] as $deck) {
                $decks .= $deck . ',';
            }
            DB::table('rooms')->insert(
                ['url' => $request['room_url'], 'password' => $request['password'], 'plateau' => $request['set'], 'collection' => $decks]
            );
            return view('waitRoom', ['url' => $request['room_url'], 'number_player' => 1]);
        } else {
            return $this->createRoomView(1);
        }
    }

    public function joinRoom(Request $request) {
        $room = DB::table('rooms')->where([
            ['url', '=', $request['room_url']],
            ['password', '=', $request['password']]
        ])->get();
        if (count($room) != 0) {
            DB::table('rooms')->where('url', '=', $request['room_url'])->increment('number_player');
            $event = new RoomJoinedEvent(['room' => $request['room_url']]);
            event($event);
            return view('waitRoom', ['url' => $request['room_url'], 'number_player' => $room[0]->number_player]);
        }
    }

    public function someoneJoined(Request $request) {
        $room = DB::table('rooms')->where('url', '=', $request['room'])->get();
        $event = new someoneJoined(['room' => $request['room'], 'number_personn' => $room[0]->number_player]);
        event($event);
        return 'ok';
    }
    public function everybodyhere(Request $request) {
        $room = DB::table('rooms')->where('url', '=', $request['room'])->get();
        DB::table('rooms')->where('url', '=', $request['room'])->delete();
        $event = new EverybodyHereEvent(['room' => $request['room'], 'number_personn' => $room[0]->number_player, 'room_info' => $room[0]]);
        event($event);
        return 'ok';
    }
    public function play(Request $request) {
        if ($request->session()->has('room') && $request->session()->has('number_personn') && $request->session()->has('room_info')) {
            //$request->session()->forget(['room', 'number_personn']);
            $lang = RoomController::getLang();//app()->getLocale();
            app()->setLocale($lang);
            //$room = DB::table('rooms')->where('url', '=', $request->session()->get('room'))->get();
            $plateau =  $request->session()->get('room_info')['plateau'];
            $collection = explode(",", $request->session()->get('room_info')['collection']);
            $cartesEvent = DB::table('carteevent')
                ->whereIn('collection', $collection)
                ->get();
            $cartesAction = DB::table('carteaction')
                ->whereIn('collection', $collection)
                ->get();
            return view('room', ['room' => $request->session()->get('room'), 'players'  => $request->session()->get('number_personn'), 'player_nbr' => $request->session()->get('player_nbr'),'action' => $cartesAction, 'event' => $cartesEvent, 'lang' => $lang, 'plateau' => $plateau]);
        } else {
            return redirect('error');
        }
    }

    public function print_rename(Request $request) {
        $event = new printRenameEvent(['room' => $request['room'], 'id' => $request['id'], 'value' => $request['value']]);
        event($event);
    }

    public function finishedTuto(Request $request) {
        $event = new finishedTutoEvent(['room' => $request['room']]);
        event($event);
        return 'ok';
    }

    public function throwDice(Request $request) {
        $event = new throwDiceEvent(['room' => $request['room'], 'de' => $request['de'], 'player_number' => $request["player_number"]]);
        event($event);
    }

    public function spied(Request $request) {
        $event = new spiedEvent(['room' => $request['room'], 'span' => $request['span']]);
        event($event);
    }

    public function playCard(Request $request) {
        switch ($request["type"]) {
            case 'Event':
                $event = new playCardEvent(['room' => $request['room'], 'card' => $request['card'], 'type' => $request["type"]]);
                break;
            case 'Quizz':
                $event = new playCardEvent(['room' => $request['room'], 'card' => $request['card'], 'type' => $request["type"], 'whereGoodAnswerIs' => $request["whereGoodAnswerIs"]]);
                break;
            case "Action":
                $event = new playCardEvent(['room' => $request['room'], 'card' => $request['card'], 'type' => $request["type"]]);
        }
        event($event);
    }

    public function playingDefi(Request $request) {
        $event = new playingDefiEvent(['room' => $request['room'], 'card' => $request['card'], 'value', $request['value']]);
        event($event);
    }

    public function playDefi(Request $request) {
        $event = new playDefiEvent(['room' => $request['room'], 'card' => $request['card'], 'whoPress', $request['whoPress']]);
        event($event);
    }

    public function playedEvent(Request $request) {
        $event = new playedEventEvent(['room' => $request['room'], 'card' => $request['card']]);
        event($event);
    }

    public function playedQuizz(Request $request) {
        $event = new playedQuizzEvent(['room' => $request['room'], 'card' => $request['card'], 'whereGoodAnswerIs' => $request["whereGoodAnswerIs"], 'answer_id' => $request["answer"]]);
        event($event);
    }

    public function playedAction(Request $request) {
        $event = new playedActionEvent(['room' => $request['room'], 'card' => $request['card']]);
        event($event);
    }
}
