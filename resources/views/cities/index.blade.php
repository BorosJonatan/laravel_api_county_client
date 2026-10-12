@extends('layouts.app')

@section('content')

    <div class="actions">
        <h1>{{ __('cities.title')}}</h1>
        <a class="button" href="{{ route('cities.create') }}">{{ __('buttons.add_new')}}</a>
    </div>
    <form method="GET" action="{{ route('cities.index') }}" style="margin-bottom: 20px">
        <input type="search" name="needle" value="{{ request('needle') }}">
        <button type="submit">{{ __('buttons.search')}}</button>
    </form>
    <div class="city-container">
        <table>
                <thead>
                    <tr>
                        <th>{{ __('cities.table_name')}}</th>
                        <th>{{ __('cities.table_county')}}</th>
                        <th>{{ __('cities.table_zip_code')}}</th>
                        <th>{{ __('cities.table_population')}}</th>
                    </tr>
                </thead>
                <tbody>
        @foreach($cities as $city)
        <tr>
            <td>{{ $city->name }}</td>
            <td>{{ $city->county->name }}</td>
            <td>{{ $city->zip_code }}</td>
            <td>{{ number_format($city->population, 0, '.', ' ') }}</td>
            <td class="actions">
                <a class="button secondary" href="{{ route('cities.show', $city->id) }}">{{ __('buttons.view')}}</a>
                <a class="button" href="{{ route('cities.edit', $city->id) }}">{{ __('buttons.edit')}}</a>
                <form action="{{ route('cities.destroy', $city->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class='danger'>{{ __('buttons.delete')}}</button>
                </form>
            </td>
        </tr>
        @endforeach
        </table>  
    </div>  

@endsection