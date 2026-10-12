@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>{{ __('cities.edit_city')}}</h1>

        <form action="{{ route('cities.update', $city->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <label for="name">{{ __('cities.table_name')}}</label>
            <input type="text" id="name" name="name" value="{{ old('name', $city->name) }}" required>
            <label for="county_id">{{ __('cities.table_county')}}</label>
            <select id="county_id" name="county_id">
                <option value="">Select a county</option>
                @foreach ($counties as $county)
                    <option value="{{ $county->county_id }}" @selected(old('county_id', $county->county_id) == $county->county_id)>
                        {{ $county->name }}
                    </option>
                @endforeach
            </select>
            <label for="zip_code">{{ __('cities.table_zip_code')}}</label>
            <input type="text" id="zip_code" name="zip_code" value="{{ old('zip_code', $city->zip_code) }}" required>
            <label for="population">{{ __('cities.table_population')}}</label>
            <input type="text" id="population" name="population" value="{{ old('population', $city->population) }}" required>
            <script>
                const population = document.getElementById('population');
                function formatNumber(value) {
                    return value
                        .replace(/\D/g, '')
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                }
                population.value = formatNumber(population.value);
                population.addEventListener('input', function () {
                    this.value = formatNumber(this.value);
                });
            </script>
            <div class="actions">
                <button type="submit">{{ __('buttons.save')}}</button>
                <a class="button secondary" href="{{ route('cities.index') }}">{{ __('buttons.cancel')}}</a>
            </div>
        </form>
    </div>
@endsection