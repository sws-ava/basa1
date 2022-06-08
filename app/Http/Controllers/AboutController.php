<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index()
    {
        $page = DB::table('pages')->where('id', 1)->first();
        return view('about', ['page' => $page]);
    }
}
