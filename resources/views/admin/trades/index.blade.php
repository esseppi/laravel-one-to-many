@extends('layouts.app1')

@section('content')
    <main class="my-3">
        <div class="container">
            <div class="row row-cols-5">
                @foreach ($trades as $trade)
                    <div class="card-group">
                        <div class="card my-3">
                            <div class="card-header">
                                <div class="d-flex">
                                    <img style="width: 50px" class="img-fluid" src="{{ $trade->baseCoin->image }}"
                                        alt="" srcset="">
                                    <span>EXCHANGED FOR</span>
                                    <img style="width: 50px" class="img-fluid" src="{{ $trade->foreignCoin->image }}"
                                        alt="" srcset="">
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $trade->baseCoin->name }}</h5>
                                <p class="card-text">{{ $trade->user->name }}</p>
                                <h5 class="card-title">Price:{{ $trade->baseCoin->price_usd }}</h5>
                                <h5 class="card-title">Amount:{{ $trade->amount }}</h5>
                                <p class="card-text">{{ $trade->tradeDirection }}</p>
                            </div>
                            <div class="d-flex justify-content-around mb-2">
                                <a href="{{ route('admin.trades.show', $trade->id) }}" class="btn btn-primary">Info</a>

                                @if (Auth::user()->id === $trade->user_id)
                                    <a href="{{ route('admin.trades.edit', $trade->id) }}"
                                        class="btn btn-secondary">Edit</a>
                                @endif
                                {{-- trigger delete button --}}
                                @if (Auth::user()->id === $trade->user_id)
                                    <button type="button" class="btn btn-danger deleteButton" data-bs-toggle="modal"
                                        data-id="{{ $trade->id }}" data-base="{{ route('admin.trades.index') }}"
                                        data-bs-target="#staticBackdrop">
                                        Delete
                                    </button>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- invisible delete popup --}}
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Do you want delete this
                                file?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            This action is irreversible!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form method="POST" data-base="{{ route('admin.trades.index') }}" id="deleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $trades->links() }}
            </div>
        </div>
    </main>
@endsection
