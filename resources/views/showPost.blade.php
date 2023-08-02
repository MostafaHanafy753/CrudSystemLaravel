@extends('layouts.master')
@section('content')
    <div class="main-content mt-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4> Post : {{ $post->title }} </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped " style=" ">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ID</td>
                            <td>{{ $post->id }}</td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Image
                            </td>
                            <td>
                                <img src="{{ asset('storage/' . $post->image) }}" alt="" width="80px">
                            </td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{ $post->title }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{ $post->description }}</td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>{{ $post->category_id }}</td>
                        </tr>
                        <tr>
                            <td>Date of creation </td>
                            <td>{{ $post->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
