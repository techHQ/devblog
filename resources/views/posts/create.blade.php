
@extends('layouts.app')



@section('content')
<a href="/posts" role="button" class="btn btn-primary"> Go Back</a>
<br><br>
 <h1>Create Posts</h1>

<form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
@CSRF
  <div class="form-group">
    <label for="title">Title</label>
    <br>
    <input type="text" name="title" class="form-control">
  </div>
    <br>
    <label for="body">Body</label>
    <br>
    <div class="form-group">
    <textarea name="body" id="article-ckeditor" style="resize:vertical;" class="form-control" rows="5" ></textarea>
    {{-- <br>  id="article-ckeditor" --}}
    
  </div>
    <br>
    <input type="file" name="cover_image">
    <br><br>
    <input type="submit" value="submit" class="btn btn-success">
  </div>
 </form>

@endsection