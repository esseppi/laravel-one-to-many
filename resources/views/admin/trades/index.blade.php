@extends('layouts.app1')

@section('content')
    <main class="container my-3">
        @if (session('status'))
            <div class="alert alert-warning">{{ session('status') }}</div>
        @endif
        <form action="" method="get" class="row g-3 mb-3">
            <div class="col-md-4">
                <select class="form-select" aria-label="Default select example" name="baseCoin" id="baseCoin">
                    <option value="" selected>Select a base coin</option>
                    @foreach ($coins as $coin)
                        <option value="{{ $coin->id }}" @if ($coin->id == $request->baseCoin) selected @endif>
                            {{ $coin->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select" aria-label="Default select example" name="foreignCoin" id="foreignCoin">
                    <option value="" selected>Select a foreign coin</option>
                    @foreach ($coins as $coin)
                        <option value="{{ $coin->id }}" @if ($coin->id == $request->foreignCoin) selected @endif>
                            {{ $coin->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <select class="form-select" aria-label="select trader" name="users" id="users">
                    <option value="" selected>Select a trader</option>

                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if ($user->id == $request->users) selected @endif>
                            {{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="date" name="date" id="date">
            </div>


            <div class="col-md-2 mx-auto my-2">
                <button class="btn btn-primary">Applica filtri</button>
            </div>
        </form>



        <div class="list-group">
            @foreach ($trades as $trade)
                <a href="{{ route('admin.trades.show', $trade->id) }}" class="list-group-item list-group-item-action"
                    aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="d-flex flex-column me-3" style="width: 150px">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ $trade->baseCoin->image }}" style="height: 20px"
                                        alt="{{ $trade->baseCoin->name }}-thumb" class="align-self-center">
                                    <h6 class="my-0 ms-2">{{ $trade->baseCoin->name }}</h6>
                                </div>
                                <span class="fs-6 text-center">{{ $trade->basePrice }}$</span>
                            </div>
                            <div class="d-flex flex-column ms-3 " style="width: 150px">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ $trade->foreignCoin->image }}" style="height: 20px"
                                        alt="{{ $trade->foreignCoin->name }}-thumb" class="align-self-center">
                                    <h6 class="my-0 ms-2">{{ $trade->foreignCoin->name }}</h6>
                                </div>
                                <span class="fs-6 text-center">{{ $trade->foreignPrice }}$</span>
                            </div>
                        </div>
                        <h5 class="mb-1"></h5>
                        <small>{{ $trade->date }}</small>
                    </div>
                    <div class="ms-3 d-flex justify-content-between">
                        <small>{{ $trade->baseAmount }}|{{ $trade->baseCoin->name }}|Exchanged</small>
                        <small>{{ $trade->user->name }}</small>
                    </div>
                    <div class="d-flex justify-content-around mb-2">
                        <a href="{{ route('admin.trades.show', $trade->id) }}" class="btn btn-primary">Info</a>
                        @if (Auth::user()->id === $trade->user_id)
                            <a href="{{ route('admin.trades.edit', $trade->id) }}" class="btn btn-secondary">Edit</a>
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

                </a>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    </main>
@endsection
