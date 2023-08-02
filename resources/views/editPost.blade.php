@extends('layouts.master')
@section('content')
    <div class="main-content mt-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4> Edit Posts</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success m-1" href="">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($errors->any)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $error }}</strong>
                        </div>
                    @endforeach
                @endif
                <img src="{{ asset('storage/' . $post->image) }}" alt="" width="100px">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="ImageName">image</label>
                        <input type="file" class="form-control" name="ImageName" id=""
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="" value="{{ $post->title }}"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <select name="category_id" id="" class="form-control">
                            @foreach ($Categories as $category)
                                <option {{ $category->id == $post->category_id ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="" cols="30" rows="5" class="form-control">
                            {{ $post->description }}
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
