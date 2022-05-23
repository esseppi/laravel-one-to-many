@extends('layouts.app1')

@section('content')
    <div class="container">
        <div class="col-8 m-auto">
            <div class="m-auto d-flex flex-column justify-center mt-3">
                <div class="m-auto">
                    <img src="{{ $coin->image }}" class="rounded img-fluid" alt="{{ $coin->slug }}">
                </div>
                <div>
                    Current usd price: {{ $data['market_data']['current_price']['usd'] }}
                </div>
                <div>
                    @php
                        print $coin->description;
                    @endphp
                </div>
            </div>
            <a href="{{ url()->previous() }}">Back</a>
        </div>

    </div>
@endsection
