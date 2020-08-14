<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\About;

use App\Http\Requests\AboutRequest;

class AboutController extends Controller
{
    public function index(){
        $title = "About Company";

        return view('pages.about.index', [
            'title' => $title
        ]);
    }
}
