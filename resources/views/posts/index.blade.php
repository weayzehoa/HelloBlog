@extends('layouts.master')

@section('title', '所有文章')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h4>
                @auth
                    <div class="float-right">
                        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-success ml-2">
                            <i class="fas fa-plus"></i>
                            <span class="pl-1">新增文章</span>
                        </a>
                    </div>
                @endauth
                @isset($keyword) <!-- 判斷是否有收到 keyword 關鍵字 -->
                    搜尋：{{ $keyword }}
                @else
                    所有文章
                @endisset
            </h4>
            <hr>
            @if(count($posts) == 0) <!-- 如果沒有文章就顯示 沒有任何文章 字串 -->
                <p class="text-center">
                    沒有任何文章
                </p>
            @endif
            @foreach($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="card-title">{{ $post->title }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    @if($post->postType != null)
                                        <span class="badge badge-secondary ml-2">
                                            {{ $post->postType->name }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4 text-right">
                                    {{ $post->created_at->toDateString() }}
                                </div>
                            </div>
                            <hr class="my-2 mx-0">
                            <div class="row">
                                <div class="col-md-12" style="height: 100px; overflow: hidden;">
                                    <p class="card-text">
                                        {{ $post->content }}
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-8">
                                    @auth
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-pencil-alt"></i>
                                                <span class="pl-1">編輯文章</span>
                                            </a>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                                <span class="pl-1">刪除文章</span>
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                                <div class="col-md-4">
                                    <!-- 導向該篇文章 -->
                                    <a href="{{ route('posts.show', $post->id) }}" class="float-right card-link">繼續閱讀...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row pt-2">
        <div class="col-md-8">
            <!-- 判斷有無傳入 keyword 有的話 利用 render 方式 自動建立可以點擊的分頁頁碼 -->
            @isset($keyword)
                {{ $posts->appends(['keyword' => $keyword])->render() }}
            @else
                {{ $posts->render() }}
            @endisset
        </div>
    </div>
</div>
@stop
