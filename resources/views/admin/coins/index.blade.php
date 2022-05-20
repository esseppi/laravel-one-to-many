@extends('layouts.app1')

@section('content')
    <main class="my-3">
        <div class="container">
            <div class="row row-cols-5">
                @foreach ($coins as $coin)
                    <div class="card-group">
                        <div class="card my-3">
                            <img src="{{ $coin['thumb'] }}" class="card-img-top" alt="{{ $coin['name'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $coin['name'] }}</h5>
                                <p class="card-text">{{ $coin['price'] }}</p>
                            </div>
                            <div class="d-flex justify-content-around mb-2">
                                <a href="{{ route('admin.coins.show', $coin->id) }}" class="btn btn-primary">Info</a>
                                <a href="{{ route('admin.coins.edit', $coin->id) }}" class="btn btn-secondary">Edit</a>
                                {{-- trigger delete button --}}
                                <button type="button" class="btn btn-danger deleteButton" data-bs-toggle="modal"
                                    data-id="{{ $coin->id }}" data-base="{{ route('admin.coins.index') }}"
                                    data-bs-target="#staticBackdrop">
                                    Delete
                                </button>

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
                            <form method="POST" data-base="{{ route('admin.coins.index') }}" id="deleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $coins->links() }}
            </div>
        </div>
    </main>
@endsection
