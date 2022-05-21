@extends('layouts.app1')

@section('content')
    <main class="my-3">
        <div class="container">
            @foreach ($coins as $coin)
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="container">
                            <div class="row g-4 m-auto">
                                <div class="col-8 m-auto">
                                    <div class="m-auto d-flex flex-column justify-center">
                                        <div class="m-auto">
                                            <img src="{{ $coin['image']['thumb'] }}" class="rounded img-fluid"
                                                alt="{{ $coin['name'] }}">
                                        </div>
                                        <h2>{{ $coin['name'] }}</h2>
                                        <h2>{{ $coin['market_data']['current_price']['usd'] }}</h2>

                                    </div>
                                </div>
                            </div>
                            <a href="{{ url()->previous() }}">Back</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection

<script>
    // const askBtc = parseFloat(prompt("Inserisci il numero dei tuoi Bitcoin"))
    // const askEth = parseFloat(prompt("Inserisci il numero dei tuoi Eth"))
    // const askDot = parseFloat(prompt("Inserisci il numero dei tuoi Dot"))
    // const askGlmr = parseFloat(prompt("Inserisci il numero dei tuoi Glimmer"))
    // const askLuna = parseFloat(prompt("Inserisci il numero dei tuoi Luna"))

    // async function getData(x, coin, log, pusd, peur, id2, pusdeur, conv, pamount) {
    //   const response = await fetch(`https://api.coingecko.com/api/v3/coins/${coin}`);
    //   const data = await response.json();
    //   const {
    //     name,
    //     market_data
    //   } = data;
    //   var info = [name, market_data.current_price.usd, market_data.current_price.eur]
    //   let usd = info[1];
    //   let eur = info[2];
    //   let id = info[0]

    //   document.getElementById(log).textContent = id;
    //   document.getElementById(pusd).textContent = usd;
    //   document.getElementById(peur).textContent = eur;

    //   document.getElementById(pusdeur).textContent = (
    //     `$${usd} / €${market_data.current_price.eur}`);
    //   document.getElementById(conv).textContent = ('$' + Math.ceil(x * market_data.current_price.usd) + ' / ' +
    //     '€' +
    //     Math.ceil(x * market_data.current_price.eur))
    //   document.getElementById(pamount).textContent = x;

    // }
    // console.log(getData(askBtc, 'bitcoin', 'btc', 'btcusd', 'btceur', 'btc2', 'btcusdeur', 'convb', 'amountb'));
    // console.log(getData(askGlmr, 'moonbeam', 'glmr', 'glmrusd', 'glmreur', 'glmr2', 'glmrusdeur', 'convm', 'amountm'));
    // console.log(getData(askEth, 'ethereum', 'eth', 'ethusd', 'etheur', 'eth2', 'ethusdeur', 'conve', 'amounte'));
    // console.log(getData(askDot, 'polkadot', 'dot', 'dotusd', 'doteur', 'dot2', 'dotusdeur', 'convd', 'amountp'));
    // console.log(getData(askLuna, 'terra-luna', 'luna', 'lunausd', 'lunaeur', 'luna2', 'lunausdeur', 'convl',
    //   'amountl'));
</script>
