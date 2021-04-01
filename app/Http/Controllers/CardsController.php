<?php

namespace App\Http\Controllers;

use App\Models\Cards;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function index() {
        $cards = Cards::latest()->paginate(2);
        return response()->json($cards);
    }

    public function store(Request $request) {
        $cards = new Cards([
            'card' => $request->input('card'),
            'pin' => $request->input('pin'),
            'activation' => $request->input('activation'),
            'expiration' => $request->input('expiration'),
            'balance' => $request->input('balance')
        ]);
        $cards->save();

        return response()->json([
            'message'=>'Card Created Successfully!!',
            'cards'=>$cards
        ]);
    }

    public function show($id) {
        $cards = Cards::find($id);

        return response()->json($cards);
    }

    public function update($id, Request $request) {
        $cards = Cards::find($id);
        $cards->update($request->all());

        return response()->json([
            'message'=>'Card Updated Successfully!!',
            'cards'=>$cards
        ]);
    }

    public function destroy($id) {
        $cards = Cards::find($id);
        $cards->delete();

        return response()->json([
            'message'=>'Card Updated Successfully!!',
            'cards'=>$cards
        ]);
    }
}
