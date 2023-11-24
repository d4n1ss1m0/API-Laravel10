@extends('template')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div>comment_id: {{$comment->id}}</div>
<form action="{{route('comments.destroy',$comment->id)}}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>
@endsection
