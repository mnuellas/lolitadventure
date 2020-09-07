<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            return redirect(route('waitRoom', ['url' => $request['room_url']]));
        } else {
            return view('createRoom', ['error' => '1']);
        }
    }
}
