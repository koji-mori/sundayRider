@extends('layouts.admin')
@section('title', 'バイク仲間募集掲示板')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>{{ $board->title }}</h2>
                <p>{{ $board->body }}</p>
                @if ($board->image_path)
                    <img src="{{ asset('storage/' . $board->image_path) }}" alt="board image">
                @endif
                <p>{{ $board->updated_at }}</p>
                
                
                
                <h2>Comments</h2>
                <form action="{{ route('board.create.comment') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="{{$board->id}}" name="board_id" />

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="row">
                    <div class="list-news col-md-12 mx-auto">
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="20%">name</th>
                                        <th width="80%">内容</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach($comments as $comment)
                                    <tr>
                                        
                                        <th>{{ $comment->user->name }}</th> 
                                        
                                        
                                        <th> {{$comment->content}}</th>
                                        
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    
                    
                    <div class="form-group row">
                        <label class="col-md-2">本文</label>
                        <div class="col-md-7">
                            <textarea class="form-control" name="content" rows="1">{{ old('content') }}</textarea>
                        </div>
                    </div>
                    
                    @csrf
                    <div class="col-2">
                        <input type="submit" class="btn btn-primary" value="投稿">
                    </div>
                    
                </form>
                
            </div>
        </div>
    </div>
@endsection

