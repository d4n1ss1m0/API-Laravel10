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
<div>user_id: {{$user->id}}</div>
<form action="{{route('users.destroy',$user->id)}}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>
@endsection
