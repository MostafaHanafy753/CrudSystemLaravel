@extends('layouts.master')
@section('content')
    <div class="main-content mt-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4> Trashed Posts</h4>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped " style=" ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width:10% ">Image</th>
                            <th scope="col" style="width:10% ">Title</th>
                            <th scope="col" style="width:30% ">Description</th>
                            <th scope="col" style="width:10% ">Category</th>
                            <th scope="col" style="width:20% ">Publish Dates</th>
                            <th scope="col" style="width:20% ">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post )
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                <img src="{{ asset('storage/'.$post->image) }}" alt="" width="80px">
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->description }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                        <a class="btn-sm btn-success ml-2" href="{{  route('posts.restore',$post->id) }}">Restore</a>
                                        <form action="{{ route('posts.forceDelete',$post->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger ml-2" >Delete</button>
                                        </form>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
