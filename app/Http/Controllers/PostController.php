<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $event = new PostCreatedEvent();
        event($event);
        dd();
    }
}
