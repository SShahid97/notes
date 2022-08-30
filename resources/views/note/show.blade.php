@extends('note.layout')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8 mt-5">
        <div class="col-md-12 text-start mb-2">
            <a class="btn btn-primary" href="{{route('notes.index')}}"> <strong> < </strong> Back</a>
        </div>
        <div class=" margin-tb">
            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3 fw-bold alert-dismissible fade show" role="alert">
                    <span>{{ $message }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="card mb-5 note note-card" >
            <div class="card-header note-card-header" >
                <div class="row">
                    <div class="col-lg-9 col-sm-6">
                        <h5 class="card-title">{{$note->title}}</h5>
                    </div>
                    <div class="col-lg-3 col-sm-6 text-end">
                        <a class="btn btn-primary btn-sm" href="{{ route('notes.edit',$note->id) }}">Edit</a>
                    </div>
                </div> 
            </div>
            <div class="card-body" style="background:#bab6b624">
                <div class="date-time">
                    <span>{{date('d-m-y h:i:s a', strtotime($note->created_at .' UTC'))}}</span>
                </div>
                <p class="card-text note-body">{{$note->body}}</p>
                <div class="row justify-content-center">
                    <div class="col-lg-10" >
                        <p class="comment-head">Comments</p>
                        <!-- showing the particular comment inside the textarea upon edit -->
                        @if( Session::get('editcommentId') AND 
                        Session::get('editcommentNoteId') AND 
                        (Session::get('editcommentNoteId')  == $note->id) ) 
                        
                        @foreach($note->comments as $comment)
                        <!-- only show filled textarea for the one to be edited -->
                            @if($comment->id == Session::get('editcommentId'))
                                <form name="add-comment-form" id="add-comment-form" method="post"       
                                    action="{{ route('comments.update',$comment->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <textarea class="form-control" requiredid="updated_comment" rows="4" placeholder="Add a comment" name="message">{{$comment->message}}</textarea>                             
                                    <div style="text-align: right; margin-top: 10px;">
                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                                    </div>
                                </form>
                             @endif
                        @endforeach
                        <!-- showing the comments normaly when edit button is not clicked 
                           i,e for adding new comments -->
                        @else
                            <form name="add-comment-form" id="add-comment-form" method="post"       action="{{ route('comments.store') }}">
                            @csrf
                                <textarea required class="form-control" id="quote_comment" rows="3" placeholder="Add a comment" name="message"></textarea>
                                <input name="noteid" type="hidden"  value="{{$note->id}}">
                                <div style="text-align: right; margin-top: 10px;">
                                    <button type="submit" class="btn btn-primary btn-sm">ADD</button>
                                </div>
                            </form>
                        @endif
                        <div>
                        @foreach($note->comments as $comment)

                        @if( !(Session::get('editcommentId')) OR 
                             (Session::get('editcommentId') != $comment->id) )
                            <div class="comment">
                                <div >{{$comment->message}}</div>
                                <!-- Buttons for edit comment and delete comment -->
                                <div style="display:flex; justify-content: flex-end;" >
                                    <form 
                                    action="commentupdate/{{$comment->id}}/{{$comment->noteid}}"
                                    method="GET" style="display: inline; margin-right: 5px;" >
                                        @csrf
                                        @method('GET')
                                        <div class="ml-5">
                                            <button type="submit" class="btn btn-sm btn-success">Edit</button>
                                        </div>
                                    </form>  
                                    <form action="{{ route('comments.destroy', $comment->id)}}" 
                                        method="post" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure to delete comment?')" class="btn btn-danger btn-sm" type="submit">
                                        Delete
                                        </button>
                                    </form>
                                </div>   
                            </div>
                            @endif
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection