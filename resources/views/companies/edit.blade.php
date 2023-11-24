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
<form action="{{route('companies.update', $company->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="title" class="form-control" id="title" name="title" value="{{$company->title}}">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <input type="description" class="form-control" id="description" name="description" value="{{$company->description}}">
    </div>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroupFile02" name="logo">
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>
@endsection
