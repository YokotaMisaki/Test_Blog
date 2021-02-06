<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;


class BlogController extends Controller
{
    /**
     * ブログ一覧を表示する
     * 
     * @return view
     */
    public function showList(Request $request)
    {
        //10件ごとに表示
        $blogs = Blog::paginate(10);

        //ブログ一覧を表示
        return view('blog.list', ['blogs' => $blogs]);
    }

    /**
     * ブログ詳細画面を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id) 
    {
        //idからデータを取り出す
        $blog = Blog::find($id);

        // idがない場合の処理
        if (is_null($blog)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }

        // 詳細画面を表示
        return view('blog.detail',['blog' => $blog]);
    } 


    /**
     * ブログ登録画面を表示する
     * 
     * @return view
     */

    public function showCreate() 
    {    // 投稿フォームを表示
        return view('blog.form');
    } 

    /**
     * ブログを登録する
     * 
     * @return view
     */
    public function exeStore(BlogRequest $request)
    {
        // もし画像があれば
        if($file = $request->image) {
            // ファイル名をタイムスタンプとアップロードした元ファイル名で生成
            $fileName = time() . $file->getClientOriginalName();
            // storage内のpublic/uploadsファイルに保存
            $target_path = public_path('uploads/');
            // public/uploads/に$fileNameで挿入
            $file->move($target_path, $fileName);
        
        }else{
            // 画像がない場合は空
            $fileName = "";
        }

        // タイトルを取得
        $title = $request->title;
        // 本文を取得
        $body = $request->body;
        
        \DB::beginTransaction();
        try{
            // データベースに保存
            Blog::create([
             "title" => $title,
             "body" => $body,
             "image" => $fileName
            ]);
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }         

        \Session::flash('err_msg', 'ブログを登録しました。');
        
        // ブログ登録に成功したらブログ一覧に返す
        return redirect (route('blogs'));  
    }

    
    /**
     * 検索機能
     * 
     * @return view
     */
    
    public function getSearch(Request $request)
    {
        // キーワードを取得
        $keyword = $request->input('keyword');

        //クエリ作成
        $query = Blog::query();

        //キーワードが入力されている場合
        if(!empty($keyword)){
        $query->where('title', 'like', '%'.$keyword.'%')
              ->orWhere('body','like','%'.$keyword.'%');
        }
        
        // 検索結果を5件ごとに表示
        $blogs = $query->paginate(5);
        
        // 検索結果をブログ一覧に表示
        return view('blog.list')->with(compact("blogs","keyword"));   
    }


    /**
     * ブログ削除する
     * @param int $id
     * @return view
     */

    public function exeDelete($id) 
    {
        // idがない場合
        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }
        
        // ブログデータを削除する
        try{
            Blog::destroy($id);
        } catch(\Throwable $e){
            abort(500);
        }         

        \Session::flash('err_msg', '削除しました。');

        // ブログ一覧を表示
        return redirect(route('blogs'));
    } 
}
