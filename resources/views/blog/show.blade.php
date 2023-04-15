@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>{{ $blog->title }}</h2>
                <p>{{ $blog->body }}</p>
                @if ($blog->image_path)
                    <img src="{{ asset('storage/' . $blog->image_path) }}" alt="blog image">
                @endif
                <p>{{ $blog->updated_at }}</p>
                
            </div>
        </div>
    </div>
@endsection

