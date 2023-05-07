@extends('layouts.admin')


@section('title','SundayRIDERS')

@section('content')

    <main class="container">
        <div class="row mb-2">
            @foreach($posts as $post)
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                    
                        @if($post['type'] == 'blog')
                            <strong class="d-inline-block mb-2 text-primary">スポットブログ</strong>
                        @else
                            <strong class="d-inline-block mb-2 text-primary">募集掲示板</strong>
                        @endif
                        
                        <h3 class="mb-0">{{ Str::limit($post['title'], 50) }}</h3>
                        <!--<div class="mb-1 text-muted">{{ $post['updated_at'] }}</div>-->
                        <p class="card-text mb-auto">{{ Str::limit($post['body'], 150) }}</p>
                        <div class="mb-1 text-muted">{{ $post['updated_at'] }}</div>
                    
                            @if ($post['type'] == 'blog')
                                <a href="{{ route('blog.show', ['id' => $post['id']]) }}">ブログをみる</a>
                            @elseif ($post['type'] == 'board')
                                <a href="{{ route('board.show', ['id' => $post['id']]) }}">掲示板を見る</a>
                            @endif
                        
                        </div>
                        
                        @if(isset($post['image']))
                            <div class="col-auto d-none d-lg-block">
                                <img src="{{ secure_asset('storage/image/' . $post['image']) }}" alt="image" width="200" height="250">
                            </div>
                        @else
                            <div class="col-auto d-none d-lg-block">
                                <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                            </div>
                        @endif
                    </div>
                </div>  
            @endforeach
            </div>
        </div>
    </main>
       
        
@endsection
