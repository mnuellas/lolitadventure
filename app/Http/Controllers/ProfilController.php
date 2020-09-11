<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
  public function index()
  {
      if(Auth::check())
        return view('panier');
      return redirect()->route('login');
  }

  public function getLang() {
    if(session()->exists('lang')) {
      return session('lang');
    } else {
      return app()->getLocale();
    }
  }

  public function Welcome()
  {
    $lang = ProfilController::getLang();//app()->getLocale();
    app()->setLocale($lang);
    $collection = ['basic'];
    $defaultBackground = 'basic';
    if(Auth::check()) {
      $collections = DB::table("users")->where('id', '=', Auth::id())->get();
      $collection = explode(",", $collections[0]->privileges);
      $defaultBackground =  $collections[0]->DefaultBackground;
    }
    $cartesEvent = DB::table('carteevent')
        ->whereIn('collection', $collection)
        ->get();
    $cartesAction = DB::table('carteaction')
        ->whereIn('collection', $collection)
        ->get();
    $cartesQuizz = DB::table('cartequizz')
        ->where('lang', '=', $lang)
        ->where(function ($query) {
                $collection = ['basic'];
                if(Auth::check()) {
                  $collections = DB::table("users")->where('id', '=', Auth::id())->get();
                  $collection = explode(",", $collections[0]->privileges);
                }
                $query->whereIn('collection', $collection);
        })->get();
      return view('welcome', ['action' => $cartesAction, 'event' => $cartesEvent, 'lang' => $lang, 'plateau' => $defaultBackground]);
  }

  public function test()
  {
    /*$CarteEvent = array();
    $CarteEvent[] = array("prenom" => "toto");
    $CarteEvent[] = array("prenom" => "Momo");
    $cartes = DB::table('carteevent')->get();
    return response()->json(array('success' => true, 'event' => $cartes));*/
  }

  public function quizz()
  {
    $lang = app()->getLocale();
    $cartes = DB::table('cartequizz')
        ->where('lang', '=', $lang)
        ->where(function ($query) {
                $collection = ['basic'];
                if(Auth::check()) {
                  $collections = DB::table("users")->where('id', '=', Auth::id())->get();
                  $collection = explode(",", $collections[0]->privileges);
                }
                $query->whereIn('collection', $collection);
        })
        ->get();
    return response()->json(array('success' => true, 'carte' => $cartes));
  }

  public function event()
  {
    $lang = app()->getLocale();
    $collection = ['basic'];
    if(Auth::check()) {
      $collections = DB::table("users")->where('id', '=', Auth::id())->get();
      $collection = explode(",", $collections[0]->privileges);
    }
    $cartes = DB::table('carteevent')
        ->whereIn('collection', $collection)
        ->get();
    return response()->json(array('success' => true, 'carte' => $cartes));
  }

  public function action()
  {
    $lang = app()->getLocale();
    $collection = ['basic'];
    if(Auth::check()) {
      $collections = DB::table("users")->where('id', '=', Auth::id())->get();
      $collection = explode(",", $collections[0]->privileges);
    }
    $cartes = DB::table('carteaction')
        ->whereIn('collection', $collection)
        ->get();
    return response()->json(array('success' => true, 'carte' => $cartes));
  }

  public function getProfil()
  {
    if (Auth::check()) {
      $user = DB::table("users")->where('id', '=', Auth::id())->get();
      $sets = array();
      foreach(explode(",", $user[0]->sets) as $set) {
        array_push($sets, DB::table("sets")->where('name', '=', $set)->get());
      }
      return view('profil', 
        [
          'user' => $user[0]->name,
          'email' => $user[0]->email,
          'sets' => explode(",", $user[0]->sets),
          'privileges' => explode(",", $user[0]->privileges),
          'defaultSet' => $user[0]->DefaultBackground,
          'playing' => explode(",", $user[0]->playing)
        ]);
    } else return route('login');
  }

  public function add_deck(Request $request) {
    $user = DB::table("users")->where('id', '=', Auth::id())->get();
    $playing = explode(",", $user[0]->playing);
    $i = 0;
    $have_trigger = false;
    $new_playing = '';
    foreach ($playing as $play) {
      if ($play == $request["deck"]) {
        array_splice($playing, $i, 1);
        $have_trigger = true;
      }
      $i++;
    }
    if ($have_trigger == false) {
      array_push($playing, $request["deck"]);
    }
    foreach ($playing as $play) {
      if ($play != "")
        $new_playing = $new_playing . $play . ',';
    }
    $affected = DB::table('users')
              ->where('id', Auth::id())
              ->update(['playing' => $new_playing]);
    return response()->json(array('response' => 'ok'));
  }

  public function change_set(Request $request) {
    $affected = DB::table('users')
      ->where('id', Auth::id())
      ->update(['DefaultBackground' => $request["deck"]]);
    return response()->json($request);
  }

  public function change_email(Request $request) {
    try {
      $affected = DB::table('users')
      ->where('id', Auth::id())
      ->update(['email' => $request['email']]);
      // return self::getProfil();
      return redirect(route('profil'));
    } catch (Exception $error) {
      return redirect(route('error', ['error' => $error]));
    }
  }

  public function change_username(Request $request) {
    try {
      $affected = DB::table('users')
        ->where('id', Auth::id())
        ->update(['name' => $request['name']]);
        return redirect(route('profil'));
    } catch (Exception $error) {
      return redirect(route('error', ['error' => $error]));
    }
  }

  public function dbPost(Request $request)
  {
    $input = $request->all();
    // for ($i=1; $i <= 42; $i++) {
    //   DB::table('carteevent')->insert(
    //         ['url' => $input["carte"][(string)$i]["img"], 'texte' =>  $input["carte"][(string)$i]["texte"], 'value' => $input["carte"][(string)$i]["value"], 'collection' => "basic"]
    //     );
    // }
    // print_r( $input["carte"][(string)1]["img"]);
    // for ($i=1; $i <= 42 ; $i++) {
    //   $value = 0;
    //   $espionnage = 0;
    //   if ($input["carte"][(string)$i]["type"] == "defi") {
    //     $value = $input["carte"][(string)$i]["nombre"];
    //   }
    //   if ($input["carte"][(string)$i]["type"] == "minuteur") {
    //     $value = $input["carte"][(string)$i]["temps"];
    //     if($input["carte"][(string)$i]["espionnage"] == true) {
    //       $espionnage = 1;
    //     }
    //   }
    //   if ($input["carte"][(string)$i]["type"] == "tour") {
    //     $value = $input["carte"][(string)$i]["tour"];
    //     if($input["carte"][(string)$i]["espionnage"] == true) {
    //       $espionnage = 1;
    //     }
    //   }
    //   DB::table('carteaction')->insert(
    //            ['url' => $input["carte"][(string)$i]["img"], 'texte' =>  $input["carte"][(string)$i]["texte"], 'type' => $input["carte"][(string)$i]["type"], 'value' => $value, 'espionnage' => $espionnage, 'collection' => "basic"]
    //        );
    // }
    // for ($i=1; $i =< 44; $i++) {
    //   DB::table('cartequizz')->insert(
    //            ['texte' => $input["carte"][(string)$i]["question"], 'false1' =>  $input["carte"][(string)$i]["reponsefalse1"], 'false2' => $input["carte"][(string)$i]["reponsefalse2"], 'true' => $input["carte"][(string)$i]["reponsetrue"], 'lang'=> 'fr' , 'collection' => "basic"]
    //   );
    // }
    return response()->json(array('success'=>'Got Simple Ajax Request.', 'carte'=>$input));
  }
}
