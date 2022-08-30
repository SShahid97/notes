@extends('note.layout')
@section('content')

<div class="container col-lg-8 mt-2">
    <div class="text-end mt-3 mb-2">
        <a class="btn btn-primary" style="font-weight:600;" href="{{ route('notes.create') }}"> <strong>+</strong> Create New Note</a>
    </div>
    <div class=" margin-tb">
        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-3 fw-bold alert-dismissible fade show" role="alert">
                <span>{{ $message }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
  <div class="row">
    @foreach ($notes as $note)
       <div class="card mb-3 custom">
            <div class="card-body">
                <div class="row cards-heading" >
                    <div class="col-lg-8 col-sm-6">
                        <h5 class="card-title">{{$note->title}}</h5>
                    </div>
                    <div class="col-lg-4 col-sm-6 ">
                        <div class="date-time" style="color:white;">
                            <span>
                                {{date('d-m-y h:i:s a', strtotime($note->created_at .' UTC'))}}
                            </span>
                        </div>
                    </div>
                </div> 
                
                <!-- <p class="card-text">{{$note->body}}</p> -->
                @if(strlen($note->body)>150)
                    <p class="card-text">{{substr($note->body, 0, 150)}}...</p>
                @else
                    <p class="card-text">{{$note->body}}</p>
                @endif
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('notes.show',$note->id) }}" class="btn btn-primary btn-sm">View Note</a>
                    </div>
                    <div class="col-6">
                        <form class="float-end" action="{{ route('notes.destroy',$note->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure to delete this Note? All its comments will also be deleted!')"
                            >Delete Note</button>
                        </form>
                    </div>
                </div>
            </div>
       </div>
    @endforeach
  </div>
</div>

@if(count($notes) == 0)
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="alert alert-danger">
            <h4> There are no notes to display.</h4> 
        </div>
    </div>
<div>
@endif
@endsection
