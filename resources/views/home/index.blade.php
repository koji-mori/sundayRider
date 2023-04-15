@extends('layouts.admin')


@section('title','SundayRIDERS')

@section('content')

        
       
  <main class="container">
    <ul class="nav nav-pills nav-fill">
      <li class="nav-item">
          <a class="nav-link"  href="{{ url('home') }}">ホーム</a>
      </li>
      <li class="nav-item">
          <a class="nav-link"  href="{{ route('blog.index') }}">ブログ一覧</a>
      </li>
      <li class="nav-item">
          <a class="nav-link"  href="{{ route('board.index') }}">掲示板</a>
      </li>
      <li class="nav-item">
          <a class="nav-link"  href="{{ route('blog.create') }}">ブログを書く</a>
      </li>
      <li class="nav-item">
          <a class="nav-link"  href="{{ route('board.create') }}">掲示板を書く</a>
      </li>
    </ul>
    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
      <div class="col-md-6 px-0">
        <h1 class="display-4 fst-italic">Sunday RIDER'S</h1>
        <p class="lead my-3">おすすめスポットをのせれるブログとツーリング仲間を募集する掲示板<br>
        初心者から上級者まで気軽に書き込んでください</p>
        <p class="lead mb-0"><a href="#" class="text-white fw-bold"></a></p>
      </div>
    </div>
    
    
    <div class="row mb-2">
    @foreach($posts as $post)
        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              @if($post['type'] == 'blog')
              <strong class="d-inline-block mb-2 text-primary">おすすめスポット</strong>
              @else
              <strong class="d-inline-block mb-2 text-primary">募集掲示板</strong>
              @endif
              <h3 class="mb-0">{{ Str::limit($post['title'], 50) }}</h3>
              <!--<div class="mb-1 text-muted">{{ $post['updated_at'] }}</div>-->
              <p class="card-text mb-auto">{{ Str::limit($post['body'], 150) }}
              </p>
              <div class="mb-1 text-muted">{{ $post['updated_at'] }}</div>
              <a href="{{ route('blog.show', ['id' => $post['id']]) }}" >閲覧</a>
            </div>
            @if(isset($post['image']))
                <div class="col-auto d-none d-lg-block">
                    <img src="{{ $post['image'] }}" alt="image" width="200" height="250">
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
