@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>{{ __('counties.create_county')}}</h1>

        <form action="{{ route('counties.store') }}" method="POST">
            @csrf

            <label for="name">{{ __('counties.name')}}</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            <label for="coatofarms">{{ __('counties.coatofarms')}}</label>
            <input type="text" id="coatofarms" name="coatofarms" value="{{ old('coatofarms') }}" required>

            <div class="actions">
                <button type="submit">{{ __('buttons.save')}}</button>
                <a class="button secondary" href="{{ route('counties.index') }}">{{ __('buttons.cancel')}}</a>
            </div>
        </form>
    </div>
@endsection