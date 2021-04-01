<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function index() {
        $categories = Cards::all(['id','number','expiration']);
        return response()->json($categories);
    }

    public function store(Request $request) {
        $cards = Cards::create($request->post());
        return response()->json([
            'message'=>'Card Created Successfully!!',
            'cards'=>$cards
        ]);
    }

    public function show(Cards $cards) {
        return response()->json($cards);
    }

    public function update(Request $request, Cards $cards) {
        $cards->fill($request->post())->save();
        return response()->json([
            'message'=>'Card Updated Successfully!!',
            'cards'=>$cards
        ]);
    }

    public function destroy(Cards $cards) {
        $cards->delete();
        return response()->json([
            'message'=>'Card Deleted Successfully!!'
        ]);
    }
}
