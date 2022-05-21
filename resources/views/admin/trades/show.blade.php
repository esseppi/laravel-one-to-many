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
                                    <img src="{{ $trade->coin->thumb }}" class="rounded img-fluid"
                                        alt="{{ $trade->title }}">
                                </div>
                                <div>
                                    <h2>{{ $trade->tradeDir }}</h2>
                                    <h2>{{ $trade->coin->ticker }}</h2>
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
