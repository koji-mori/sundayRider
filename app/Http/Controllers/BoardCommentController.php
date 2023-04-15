<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardCommentController extends Controller
{
    public function add()
    {
        return view('boardcom.create');
    }
}
