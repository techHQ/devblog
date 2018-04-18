@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary">Create Posts</a>
                    <h3>Your Blog posts</h3>
                    @if(count($posts)> 0)
                     <table class="table table-stripped">
                        <tr class="table-success">
                          <th>Title</th>
                          <th></th>
                          <th></th>
                        </tr>
                     @foreach($posts as $post)
                         <tr>
                          <td>{{$post->title}}</td>
                          <td><a href="/posts/{{$post->id}}/edit" class="btn btn-success">Edit</a></td>
                          <td>
                          <form action="{{route('posts.destroy',[$post->id])}}" method="post">
                                 @CSRF
                                 @METHOD('delete')
                         <input type="submit" class="btn btn-danger pull-right"value="Delete">
                         </form>
                          
                          </td>
                        </tr>
                     @endforeach
                     
                     </table>

                     @else

                       <h5>You have no Posts</h5>

                     @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
