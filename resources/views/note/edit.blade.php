@extends('note.layout')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-8 margin-tb">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-12 text-start mb-2">
                <a class="btn btn-primary" href="{{ url()->previous() }}"><strong> < </strong> Back</a>
            </div>
            <div class="headers">
                    <h3>Edit Note</h3>
            </div>     
            <form action="{{ route('notes.update',$note->id)}}" method="POST" class="forms">
                @csrf
                @method('PUT')
                 <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="title" class="form-label"><strong>Title</strong></label>
                            <input type="text" name="title" class="form-control" placeholder="Note Title"
                            value="{{$note->title}}" required>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                    <br>
                        <div class="form-group">
                            <label for="body" class="form-label"><strong>Body</strong></label>
                            <textarea class="form-control" style="height:150px" name="body" placeholder="Note Body" required>{{ $note->body }}</textarea>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                        <button type="submit" class="form-control btn btn-success">UPDATE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection