<?php

namespace App\Http\Controllers;

use App\Models\Cards;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    // list.vue 
    public function index() {
        // select 10 results with pagination
        $cards = Cards::latest()->paginate(10);

        // return informations
        return response()->json($cards);
    }

    // add.vue
    public function store(Request $request) {
        // delete T from activation data. datatime-local have T between date and hour
        $request->merge([
            'activation' => str_replace('T', ' ', $request->input('activation')),
        ]);

        // validation before add data
        $validator = $request->validate([
            'card' => 'required|digits:20',
            'pin' => 'required|digits:4',
            'activation' => 'required|date_format:Y-m-d H:i',
            'expiration' => 'required|date_format:Y-m-d',
        ]);

        // send errors
        if(!is_array($validator)){
            return response()->json(401);
        }

        //add
        $cards = new Cards([
            'card' => $request->input('card'),
            'pin' => $request->input('pin'),
            'activation' => $request->input('activation'),
            'expiration' => $request->input('expiration'),
            'balance' => $request->input('balance') * 100
        ]);
        $cards->save();

        // return informations
        return response()->json([
            'message'=>'Card Created Successfully!!',
            'cards'=>$cards
        ]);
    }

    // show.vue
    public function show($id) {
        $cards = Cards::find($id);

        // return informations
        return response()->json($cards);
    }

    // edit.vue
    public function update($id, Request $request) {
        // delete T from activation data. datatime-local have T between date and hour
        $request->merge([
            'activation' => str_replace('T', ' ', $request->input('activation')),
        ]);

        // validation before update data
        $validator = $request->validate([
            'card' => 'required|digits:20',
            'pin' => 'required|digits:4',
            'activation' => 'required|date_format:Y-m-d H:i',
            'expiration' => 'required|date_format:Y-m-d',
        ]);

        // send errors
        if(!is_array($validator)){
            return response()->json(401);
        }

        // update
        $cards = Cards::find($id);
        $cards->update([
            'card' => $request->input('card'),
            'pin' => $request->input('pin'),
            'activation' => $request->input('activation'),
            'expiration' => $request->input('expiration'),
            'balance' => $request->input('balance') * 100
        ]);

        // return informations
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
