<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardComment;

class BoardCommentController extends Controller
{
    
    public function create()
    {
        
        $comments = BoardComment::with('user')->get();
        return view('board.show', compact('comments'));
    }


}
