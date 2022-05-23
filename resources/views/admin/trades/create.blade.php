@extends('layouts.app1')
@section('content')
    <div class="container">
        <h1>Trade</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.trades.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <div>
                    Your ID: <span id="userId">{{ Auth::user()->id }}</span>
                </div>
                {{-- COIN BASE --}}
                <div class="col-sm-6">
                    <label for="baseCoin_id" class="form-label">Coin 1</label>
                    <select placeholder="Prima Coin" id="coin1" name="baseCoin_id" class="form-control">
                        @foreach ($coins as $coin)
                            <option data-name="{{ $coin['name'] }}" value="{{ $coin['id'] }}">
                                {{ $coin['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- COIN FOREIGN --}}
                <div class="col-sm-6">
                    <label for="coin2" class="form-label">Coin 2</label>
                    <select placeholder="Seconda Coin" id="coin2" name="foreignCoin_id" class="form-control">
                        @foreach ($coins as $coin)
                            <option value="{{ $coin['id'] }}" data-name="{{ $coin['name'] }}">{{ $coin['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- DATA --}}
                <div class="col-12">
                    <label for="address2" class="form-label">Date <span class="text-muted">(Optional)</span></label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}"
                        placeholder="Date">
                </div>
                {{-- COIN BASE VS USD --}}
                <div class="col-6">
                    <label for="address2" class="form-label">COIN 1 VS USD</label>
                    <input disabled="disabled" class="form-control" id="baseCoinUsd" name="basePrice"
                        value="{{ old('baseCoinUsd') }}" placeholder="Price of base coin in selected date">
                </div>
                {{-- COIN FOREIGN VS USD --}}
                <div class="col-6">
                    <label for="address2" class="form-label">COIN 2 VS USD</label>
                    <input disabled="disabled" class="form-control" id="foreignCoinUsd" name="foreignPrice"
                        value="{{ old('foreignCoinUsd') }}" placeholder="Price of foreign coin in selected date">
                </div>
                {{-- RATE COIN 2 / COIN 1 --}}
                <div class="col-12">
                    <label for="address2" class="form-label">Exchange Rate</label>
                    <input class="form-control" id="tradePrice" name="price" value="{{ old('price') }}"
                        placeholder="Price">
                </div>
                {{-- BUY OR SELL --}}
                <div class="col-sm-12">
                    <label for="slug" class="form-label">Buy/Sell</label>
                    <select placeholder="Seconda Coin" id="tradeDir" name="tradeDir" class="form-control">
                        <option value="1">Buy</option>
                        <option value="0">Sell</option>
                    </select>
                </div>
                {{-- EXCHANGED AMOUNT --}}
                <div class="col-6">
                    <label for="address2" class="form-label">Amount you trade</label>
                    <input class="form-control" id="baseAmount" name="baseAmount" value="{{ old('baseAmount') }}"
                        placeholder="Amount you trade">
                </div>

                <div class="col-6">
                    <label for="address2" class="form-label">Amount you will get</label>
                    <input disabled="disabled" id="foreignAmount" name="foreignAmount" value="{{ old('foreignAmount') }}"
                        placeholder="Amount you will get">
                </div>
                <div class="col-sm-12">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" id="slugRes" name="slug">
                    <input type="button" value="Genera info trade" id="btnGenerator">
                </div>
            </div>
            <div class="w-100 d-flex justify-content-center">
                <button class="w-50 btn btn-primary btn-lg mx-auto" type="submit">Create new Trade</button>
            </div>

        </form>
    </div>
@endsection
