<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {

        $transactions = UserTransaction::query()
            ->where('user_id', $request->user()->id)
            ->get();


        return response()
            ->json(compact('transactions'));







    }

}
