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
<form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input type="name" class="form-control" id="name" name="name" value="{{$user->name}}">
    </div>
    <div class="mb-3">
        <label for="surname" class="form-label">Фамилия</label>
        <input type="surname" class="form-control" id="surname" name="surname" value="{{$user->surname}}">
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Номер телефона</label>
        <input type="phone" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
    </div>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroupFile02" name="avatar" value="">
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>
@endsection
