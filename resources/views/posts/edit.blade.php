@extends('layouts.app')



@section('content')
<a href="/posts" role="button" class="btn btn-primary"> Go Back</a>
<br><br>
 <h1>Edit Posts</h1>

<form action="{{route('posts.update',[$posts->id])}}" method="post" enctype="multipart/form-data">
 @CSRF
  @METHOD('PUT')
   <div class="form-group">
    <label for="title">Title</label>
      <br>
        <input type="text" value="{{$posts->title}}" name="title" class="form-control">
         <br>
           <label for="body">Body</label>
            <br>
             <textarea name="body"  class="form-control"rows=20>{{$posts->body}}</textarea>
              <br>
                <input type="file" name="cover_image">
                 <br><br>
                  <input type="submit" value="submit" class="btn btn-success">
                </div>
              </form>
@endsection