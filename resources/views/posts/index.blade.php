

@extends('layouts.app')
@section('content')

  <h1>Posts <a href="/posts/create" class="btn btn-danger pull-right" role="button">Create Posts</a></h1>
@if(count($Posts) > 0)

@foreach($Posts as $Post)
 <div class="group-item">
  <div class="list-group-item" >
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <img id="cover-image" src="/storage/cover_images/{{$Post->cover_image}}">
      </div>
        <div class="col-md-8 col-sm-8">
          <h3 ><a href="/posts/{{$Post->id}}">{{$Post->title}}</a>  </h3>
          <small>Written on {{$Post->created_at}} by <b> {{$Post->user->name}}</b> </small>
        </div>
    </div>
    </div>
 </div>
@endforeach 
<br><br>
{{$Posts->links()}}
@else
<h4>No posts found</h4>
@endif
@endsection