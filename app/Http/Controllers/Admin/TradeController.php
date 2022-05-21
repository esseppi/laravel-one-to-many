<?php

namespace App\Http\Controllers\Admin;

use App\Trade;
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
    public function index()
    {
        $trades = Trade::paginate(25);
        return view('admin.trades.index', compact('trades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trades.create');
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
            'name'              => 'required|min:1|max:128',
            'thumb'             => 'url|max:2000',
            'description'       => 'max:250',
            'slug'              => 'required|unique:trades|max:250',
            'price'             => 'required|numeric',
            'amount'            => 'required|numeric',
        ];
        // validazion
        $request->validate($this->validationRules);
        $newTrade = $request->all();
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
    public function edit(Trade $trade)
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
