<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Events\RoomJoinedEvent;
use App\Events\someoneJoined;

class RoomController extends Controller
{
    public function selectRoom() {
        $rooms = DB::table("rooms")->get();
        return view('chooseRoom', ['rooms' => $rooms]);
    }

    public function createRoom(Request $request) {
        $room = DB::table('rooms')
        ->where('url', $request['room_url'])->get();
        if (count($room) == 0) {
            DB::table('rooms')->insert(
                ['url' => $request['room_url'], 'password' => $request['password']]
            );
            return view('waitRoom', ['url' => $request['room_url']]);
        } else {
            return view('createRoom', ['error' => '1']);
        }
    }

    public function joinRoom(Request $request) {
        $room = DB::table('rooms')->where([
            ['url', '=', $request['room_url']],
            ['password', '=', $request['password']]
        ])->get();
        if (count($room) != 0) {
            $event = new RoomJoinedEvent(['room' => $request['room_url']]);
            event($event);
            return view('waitRoom', ['url' => $request['room_url']]);
        }
    }

    public function someoneJoined(Request $request) {
        $event = new someoneJoined(['room' => $request['room'], 'number_personn' => $request['number_personn']]);
        event($event);
        return 'ok';
    }
    public function everybodyhere(Request $request) {
        return 'ok_redirect';
    }
}
