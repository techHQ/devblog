

@extends('layouts.app')
@section('content')
<a href="/posts" class="btn btn-primary">Go Back </a>
  <h3>{{$posts->title}}</h3>
  
   <div class="list-group-item">
   <img id="cover-image" src="/storage/cover_images/{{$posts->cover_image}}">
   <br><br>
     {!!$posts->body!!}
   </div>
   <hr>
   <small>Written On {{$posts->created_at}} by <b> {{$posts->user->name}}</b></samll>
   <hr>
   @if(!Auth::guest())
    @if(Auth::user()->id == $posts->user_id)
        <table> 
          <tr>
           <td>
             <a href="/posts/{{$posts->id}}/edit" class="btn btn-success">Edit</a>
              </td>
                <td>
                  <form action="{{route('posts.destroy',[$posts->id])}}" method="post">
                    @CSRF
                      @METHOD('delete')
                       <input type="submit" class="btn btn-danger pull-right"value="Delete">
                    </form>
                 </td>
              </tr>
         </table>
       @endif
  @endif
@endsection