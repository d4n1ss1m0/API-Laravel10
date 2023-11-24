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
<form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input type="name" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
        <label for="surname" class="form-label">Фамилия</label>
        <input type="surname" class="form-control" id="surname" name="surname">
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Номер телефона</label>
        <input type="phone" class="form-control" id="phone" name="phone">
    </div>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroupFile02" name="avatar">
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>
@endsection
