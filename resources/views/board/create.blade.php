@extends('layouts.admin')
@section('title', 'バイク仲間募集掲示板')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>バイク仲間募集掲示板</h2>
                <form action="{{ route('board.create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-md-2">題名</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">本文</label>
                        <div class="col-md-7">
                            <textarea class="form-control" name="body" rows="10">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-7">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    @csrf
                    
                    <input type="submit" class="btn btn-primary" value="更新">
                    
                    
                </form>
            </div>
        </div>
    </div>
@endsection