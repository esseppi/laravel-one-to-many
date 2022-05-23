<?php

namespace App\Http\Controllers\Admin;


use App\Coin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coins = Coin::paginate(25);
        return view('admin.coins.index', compact('coins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validationRules = [
            'name'              => 'required|min:3|max:128',
            'slug'              => 'required|unique:coins|max:250',
            'image'             => 'url|max:2000',
        ];
        // validazione
        $request->validate($this->validationRules);
        // salvataggio dati
        $newCoin = $request->all();
        // creazione istanza
        $coin = Coin::create($newCoin);
        return redirect()->route('admin.coins.show', $coin->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function show(Coin $coin)
    {
        $data = Http::get('https://api.coingecko.com/api/v3/coins/' . $coin->slug)->json();;
        return view('admin.coins.show', [
            'coin'     => $coin,
            'data'     => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function edit(Coin $coin)
    {

        return view('admin.coins.edit', compact('coin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function update(Coin $coin, Request $request)
    {
        $formData = $request->all();

        $coin->update($formData);


        return redirect()->route('admin.coins.show', $coin->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coin $coin)
    {
        $coin->delete();
        return redirect()->route('admin.coins.index');
    }


    public function search(Request $request)
    {
        $search_text = $request->query('query');
        $coins = Coin::where('name', 'LIKE', '%' . $search_text . '%')->get();
        return view('admin.coins.search', compact('coins'));
    }




    // RICEVO RICHIESTA POST DA AXIOS APP.JS E RISPONDO CON LO SLUG CON OGETTO DEL POST-AXIOS IN JSON
    // GENERATORE SLUGGER
    public function slugger(Request $request)
    {
        return response()->json([
            'slug' => Coin::generateSlug($request->all()['generatorString'])
        ]);
    }


    // CREAZIONE CONVERTITORE 
    public function getCoins(Coin $oldCoin)
    {
        $Coinlist = Http::get('https://api.coingecko.com/api/v3/coins/')->json();

        return view('admin.coins.price', ['coins' => $Coinlist]);
    }
}
