@extends('layouts.app1')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    {{-- @dd($trade) --}}
                    <div class="row g-4 m-auto">
                        <div class="col-8 m-auto">
                            <div class="m-auto d-flex flex-column justify-center">
                                <div class="m-auto">
                                    <img src="{{ $trade->baseCoin->image }}" class="rounded img-fluid"
                                        alt="{{ $trade->title }}">
                                </div>
                                <div>
                                    @if ($trade->tradeDir)
                                        <h2>Acquisto</h2>
                                    @else
                                        <h2>Venduto</h2>
                                    @endif
                                    <h2>{{ $trade->baseCoin->price_usd }}</h2>
                                    <h2>{{ $trade->baseCoin->name }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url()->previous() }}">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
