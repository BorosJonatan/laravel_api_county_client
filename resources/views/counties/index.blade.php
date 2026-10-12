@extends('layouts.app')

@section('content')

    <div class="actions">
        <h1>{{ __('counties.title')}}</h1>
        <a class="button" href="{{ route('counties.create') }}">{{ __('buttons.add_new')}}</a>
    </div>
    <form method="GET" action="{{ route('counties.index') }}" style="margin-bottom: 20px">
      <input type="search" name="needle" value="{{ request('needle') }}">
      <button type="submit">{{ __('buttons.search')}}</button>
    </form>
    <div class="city-container">
        <table>
                <thead>
                    <tr>
                        <th>{{ __('counties.name')}}</th>
                        <th>{{ __('counties.coatofarms')}}</th>
                    </tr>
                </thead>
                <tbody>
        @foreach($counties as $county)
        <tr>
            <td>{{ $county->name }}</td>
            <td><img src="{{ $county->coatofarms }}" style="width:60px;height:60px"></td>
            <td class="actions">
                <a class="button secondary" href="{{ route('counties.show', $county->id) }}">{{ __('buttons.view')}}</a>
                <a class="button" href="{{ route('counties.edit', $county->id) }}">{{ __('buttons.edit')}}</a>
                <form action="{{ route('counties.destroy', $county->id) }}" method="POST">
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