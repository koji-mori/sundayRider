@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>{{ $blog->title }}</h2>
                <p>{{ $blog->body }}</p>
                @if ($blog->image_path)
                    <img src="{{ secure_asset('storage/image/' . $blog->image_path) }}" alt="blog image" width="600" height="750" >
                @endif
                <p>{{ $blog->updated_at }}</p>
                
            </div>
        </div>
    </div>
@endsection

