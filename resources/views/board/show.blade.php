@extends('layouts.admin')

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
                
            </div>
        </div>
    </div>
@endsection

