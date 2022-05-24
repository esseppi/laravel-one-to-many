<?php

namespace App\Http\Controllers\Admin;

use App\Trade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Faker\Generator as Faker;

use App\Coin;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trades = Trade::where('id', '>', 0);

        if ($request->baseCoin) {
            $trades->where('baseCoin_id', $request->baseCoin);
        }
        if ($request->foreignCoin) {
            $trades->where('foreignCoin_id', $request->foreignCoin);
        }
        if ($request->date) {
            $trades->where('foreignCoin_id', $request->dates);
        }

        if ($request->users) {
            $trades->where('user_id', $request->users);
        }

        $trades = $trades->paginate(20);

        // $trades = Trade::paginate(50);

        $coins = Coin::all();
        $users = User::all();

        return view('admin.trades.index', [
            'coins'         => $coins,
            'trades'        => $trades,
            'users'         => $users,
            'request'       => $request
        ]);
    }
    // dd($request);


    public function myTrades()
    {
        $trades = Trade::where('user_id', Auth::user()->id)->paginate(25);
        return view('admin.trades.myTrades', compact('trades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Coin $coin)
    {
        $coins = Coin::all();
        return view('admin.trades.create', compact('coins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        // dd($request);
        $this->validationRules = [
            // 'user_id'              => 'required|min:1|max:200',
            'baseCoin_id'          => 'required|min:1|max:200',
            'foreignCoin_id'       => 'required|min:1|max:200',
            'slug'                 => 'required|unique:trades|max:250',

            'basePrice'            => 'numeric|max:200000000',
            'foreignPrice'         => 'numeric|max:200000000',
            'date'                 => 'date',
            'tradeDir'             => 'required|boolean',
        ];
        // validazione
        $request->validate($this->validationRules);

        $newTrade = $request->all() + [
            'user_id' => Auth::user()->id,
        ];

        $trade = Trade::create($newTrade);
        return redirect()->route('admin.trades.show', $trade->id);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function show(Trade $trade)
    {
        return view('admin.trades.show', compact('trade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function edit(Faker $faker, Trade $trade)
    {

        return view('admin.trades.edit', compact('trade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trade $trade)
    {
        if (Auth::user()->id !== $trade->user_id) abort(403);

        $formData = $request->all();

        $trade->update($formData);

        return redirect()->route('admin.trades.show', $trade->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trade $trade)
    {
        $trade->delete();
        return redirect()->route('admin.trades.index');
    }


    public function search(Request $request)
    {
        $search_text = $request->query('query');
        $trades = Trade::where('name', 'LIKE', '%' . $search_text . '%')->get();
        return view('admin.trades.search', compact('trades'));
    }

    // GENERATORE SLUGGER
    public function slugger(Request $request)
    {
        return response()->json([
            'slug' => Trade::generateSlug($request->all()['generatorString'])
        ]);
    }
}
