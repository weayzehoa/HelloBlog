<?php

namespace App\Http\Controllers;

//將需要使用到的 Request、Eloquent、套件及Facade寫入
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post as PostEloquent; //posts資料表
use App\PostType as PostTypeEloquent; //post_types資料表
use Carbon\Carbon; //時間格式套件
use Auth;   //使用者驗證
use View;   //視圖
use Redirect; //轉向

class PostsController extends Controller
{
    /*
        新增一個建構式在class中, 主要是進入此控制器時，優先走這邊,
        進入到 middleware 中, 除了 index 與 show 不需要做驗證.
        意思就是說 非會員也可以看文章, 其餘的功能通通都要驗證.
    */
    public function __construct(){
        $this->middleware('auth', [
            'except' => [
                'index', 'show'
            ]
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostEloquent::orderBy('created_at', 'DESC')->paginate(5);
        $post_types = PostTypeEloquent::orderBy('name', 'ASC')->get();
        $posts_total = PostEloquent::get()->count();
        return View::make('posts.index', compact('posts','post_types','posts_total'));
        return View::make('posts.index', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //將id帶入並找文章顯示到視圖
        $post = PostEloquent::findOrFail($id);
        return View::make('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
