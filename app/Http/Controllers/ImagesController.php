<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImagesController extends Controller
{
  public function show($what, $type, $lang, $carte)
  {
    $collection = "";
    for ($i = 0; $i < strpos($carte, '_'); $i++) {
      $collection .= $carte[$i];
    }
    if ($collection != "") {
      if ($what == "cartes") {
        if(Auth::check()) {
          $collections = DB::table("users")->where('id', '=', Auth::id())->get();
          $droits = explode(",", $collections[0]->privileges);
          if(!in_array($collection, $droits))
            return redirect('login');
          }
        else {
          return redirect('login');
        }
      }
      if ($what == "set") {
        if(Auth::check()) {
          $collections = DB::table("users")->where('id', '=', Auth::id())->get();
          $droits = explode(",", $collections[0]->sets);
          if(!in_array($lang, $droits) && $lang != "basic")
            return redirect('login');
        }
        else {
          return response()->json(array('success' => true, 'event' => $lang));
          //return redirect('login');
        }
      }
    }
    $storagePath = storage_path("app/images/$what/$type/$lang/$carte");
    return response()->file($storagePath);
  }
}
