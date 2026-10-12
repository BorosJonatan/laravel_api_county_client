@extends('layouts.app')

@section('content')
<div class='card'>
    <h1>{{ $city->name }}</h1>
    <label>{{ __('cities.table_county')}}:</label>
    <p>{{ $city->county_id}}</p>
    <label>{{ __('cities.table_zip_code')}}:</label>
    <p>{{ $city->zip_code}}</p>
    <label>{{ __('cities.table_population')}}:</label>
    <p>{{ number_format($city->population, 0, '.', ' ')}}</p>
</div>

@endsection