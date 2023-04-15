<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // この行を追加

use Auth;
use App\Models\Blog;


class BlogController extends Controller
{
    public function add()
    {
        return view('blog.create');
    }
    
    
    public function create(Request $request)
    {
        
                // Validationを行う
        $this->validate($request, Blog::$rules);

        $blog = new Blog;
        $form = $request->all();
        
        // ２３でとったblog内のuser_idにAuth::id();を代入
        $blog->user_id = Auth::id();
        
        
        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $blog->image_path = basename($path);
        } else {
            $blog->image_path = null;
        }
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $blog->fill($form);
        $blog->save();
        
        return redirect('home');
    }
    
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $blogs = Blog::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $blogs = Blog::all();
        }
        return view('blog.index', ['blogs' => $blogs, 'cond_title' => $cond_title]);
    }
    
    
    public function edit(Request $request)
    {
        $blogs = Blog::find($request->id);
        if (empty($blogs)) {
            abort(404);
        }
        return view('blog.edit', ['blog_form' => $blogs]);
    }
    
    

   public function update(Request $request, $id)
{
    // ログインユーザーのIDを取得する
    $user_id = Auth::id();

    // IDが一致する投稿を取得する
    $blogs = Blog::where('id', $id)
                ->where('user_id', $user_id) // ログインユーザーのIDでフィルタリングする
                ->first();

    // 投稿が存在しない場合は404エラーを返す
    if (!$blogs) {
        abort(404);
    }

    // バリデーションルールを定義する
    $rules = [
        'title' => 'required|max:255',
        'body' => 'required',
    ];

    // バリデーションを実行する
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        // バリデーションエラーの場合は編集画面に戻す
        return redirect()
            ->route('blog.edit', $id)
            ->withErrors($validator)
            ->withInput();
    }

    // ユーザーが入力した値で投稿を更新する
    $blogs->title = $request->title;
    $blogs->body = $request->body;
    $blogs->save();

    // 編集完了メッセージをフラッシュデータにセットする
    session()->flash('status', '投稿を更新しました。');

    // 投稿詳細ページにリダイレクトする
    return redirect()->route('blog.index', $blogs->id);
    }

    
    
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $blog = Blog::find($request->id);

        // 削除する
        $blog->delete();

        return redirect()->route('blog.index');
    }
    
    
    
    public function show($id)
    {
    $blog = Blog::findOrFail($id);
    return view('blog.show', ['blog' => $blog]);
    }
    
}
