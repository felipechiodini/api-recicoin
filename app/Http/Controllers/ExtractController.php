<?php

namespace App\Http\Controllers;

use App\Models\UserTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExtractController extends Controller
{

    public function __invoke(Request $request)
    {
        $points = 1000;

        $extract = UserTransaction::query()
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function(UserTransaction $transaction) {
                return [
                    'id' => $transaction->id,
                    'status' => 'Requisitado',
                    'points' => 200,
                    'date' => Carbon::parse($transaction->created_at)->format('d/m/Y')
                ];
            });

        return response()
            ->json(compact('extract', 'points'));

    }

}
