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
<div>company_id: {{$company->id}}</div>
<form action="{{route('companies.destroy',$company->id)}}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>
@endsection
