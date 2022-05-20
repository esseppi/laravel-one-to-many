@extends('layouts.app1')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <div class="row g-4 m-auto">
                        <div class="col-8 m-auto">
                            <div class="m-auto d-flex flex-column justify-center">
                                <div class="m-auto">
                                    <img src="{{ $coin->thumb }}" class="rounded img-fluid" alt="{{ $coin->title }}">
                                </div>
                                <div>
                                    <h2>{{ $coin->name }}</h2>
                                    <p>{{ $coin->description }}</p>
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
