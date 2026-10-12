@extends('layouts.app')

@section('content')
<div class='card county-show'>
    <h1>{{ $county->name }}</h1>
    <img src="{{ $county->coatofarms}}" style="width:300px;"></img>
</div>

@endsection