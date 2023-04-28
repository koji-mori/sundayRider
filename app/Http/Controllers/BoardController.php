<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Auth;
use App\Models\Board;
use App\Models\BoardComment;
use App\Models\User;//add

class BoardController extends Controller
{
    public function add()
    {
        return view('board.create');
    }
    
    
    public function create(Request $request)
    {
        
                // Validationを行う
        $this->validate($request, Board::$rules);

        $board = new Board;
        $form = $request->all();
        
        // ２３でとったblog内のuser_idにAuth::id();を代入
        $board->user_id = Auth::id();
        
        
        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $board->image_path = basename($path);
        } else {
            $board->image_path = null;
        }
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $board->fill($form);
        $board->save();
        
        return redirect('home');
    }
    
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $boards = Board::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $boards = Board::all();
        }
        return view('board.index', ['boards' => $boards, 'cond_title' => $cond_title]);

    }
    
    
    public function edit(Request $request)
    {
        $board = Board::find($request->id);
        if (empty($board)) {
            abort(404);
        }
        return view('board.edit', ['board_form' => $board]);
    }
    
    

   
    public function update(Request $request, $id)
   {
       
        // ログインユーザーのIDを取得する
        $user_id = Auth::id();
    
        // IDが一致する投稿を取得する
        $board = Board::where('id', $id)
                    ->where('user_id', $user_id) // ログインユーザーのIDでフィルタリングする
                    ->first();
    
        // 投稿が存在しない場合は404エラーを返す
        if (!$board) {
            abort(404);
        }
    
        // バリデーションルールを定義する
        $rules = [
            'title' => 'required|max:255',
            'body' => 'required',
        ];
    
        // バリデーションを実行する
        $validator = Validator::make($request->all(), Board::$rules);
    
        if ($validator->fails()) {
            // バリデーションエラーの場合は編集画面に戻す
            return redirect()
                ->route('board.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
    
        // ユーザーが入力した値で投稿を更新する
        $board->title = $request->title;
        $board->body = $request->body;
        $board->save();
    
        // 編集完了メッセージをフラッシュデータにセットする
        session()->flash('status', '投稿を更新しました。');
    
        // 投稿詳細ページにリダイレクトする
        return redirect()->route('board.index', $board->id);
    }
    
    
    
    
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $boards = Board::find($request->id);

        // 削除する
        $boards->delete();

        return redirect()->route('board.index');
    }
    
    
    
    public function show($id)
    {
        $board = Board::findOrFail($id);
        $comments = $board->comments;
        
        return view('board.show', ['board' => $board, 'comments' => $comments]);
        //                             二つのテーブルをつかう
    }

    

    public function createComment(Request $request)
    {
        
        //         // Validationを行う
        $this->validate($request, BoardComment::$rules);

        $comment = new BoardComment;
        $form = $request->all();
        
        // $comment = new BoardCommentでとったcomment内のuser_idにAuth::id();を代入
        $comment->user_id = Auth::id();
        
        // $comment->name = Auth::name();//add
        
        
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
       

        // データベースに保存する
        $comment->fill($form);
        $comment->save();
        
        return redirect('board/'.$request->board_id.'/show');
    }
    
}
