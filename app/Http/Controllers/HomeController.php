<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Blog;
use App\Models\Board;
use App\Models\User;

class HomeController extends Controller
{
   
    public function index(Request $request)
    {
        $posts = [];
    
        $blogs = Blog::orderBy('updated_at', 'desc')->get();
        foreach ($blogs as $blog){
            $post = [
                'title' => $blog->title,
                'body' => $blog->body,
                'image' => $blog->image_path,
                'type' => 'blog',
                'updated_at' => $blog->updated_at ?? '', // 条件付き演算子を使用して、nullである場合に代替の値を提供
                'id' => $blog->id  // ← id を追加する
                
            ];
            array_push($posts, $post);
        }
        
        $boards = Board::orderBy('updated_at', 'desc')->get();
        foreach ($boards as $board){
            $post = [
                'title' => $board->title,
                'body' => $board->body,
                'image' => $board->image_path,
                'type' => 'board',
                'updated_at' => $board->updated_at ?? '', // 条件付き演算子を使用して、nullである場合に代替の値を提供
                'id' => $board->id  // ← id を追加する
            ];
            array_push($posts, $post);
        }
        
        usort($posts, function($a, $b) {
        return $b['updated_at'] <=> $a['updated_at'];
        });
        
        
        
                 
        return view('home.index', compact('posts'));
    }
    
    
    
    
    //ブログ投稿画面
    public function createBlog()
    {
        return view('create_blog');
    }
    
    // 掲示板投稿画面
    public function createBoard()
    {
        return view('create_boards');
    }
    
    //ブログ一覧画面
    public function indexBlog()
    {
        return view('blog.index');
    }
    
    // 掲示板一覧画面
    public function indexBoard()
    {
        return view('boards.index');
    }
    
    
    public function showBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $controller = new BlogController;
        return $controller->show($id);
    }
    
    
    public function showBoard($id)
    {
        $board = Board::findOrFail($id);
        $controller = new BoardController;
        return $controller->show($id);
    }
    
    
    
}
