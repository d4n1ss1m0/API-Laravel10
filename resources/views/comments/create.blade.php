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
<form action="{{route('comments.store')}}" method="post">
    @csrf
    <div class="mb-3">
        <label for="user_id" class="form-label">id_user</label>
        <input type="user_id" class="form-control" id="user_id" name="user_id">
    </div>
    <div class="mb-3">
        <label for="company_id" class="form-label">id_company</label>
        <input type="company_id" class="form-control" id="company_id" name="company_id">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Содержание</label>
        <input type="content" class="form-control" id="content" name="content">
    </div>
    <div class="mb-3">
        <label for="score" class="form-label">Оценка</label>
        <input type="score" class="form-control" id="score" name="score">
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>
@endsection
