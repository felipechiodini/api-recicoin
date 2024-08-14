<?php

namespace App\User\Controllers;

use App\Models\UserTransaction;
use Carbon\Carbon;
use Felipechiodini\Helpers\Helpers;
use Illuminate\Http\Request;

class ExtractController
{
    public function __invoke(Request $request)
    {
        $points = Helpers::formatCurrency($request->user()->points);

        $extracts = UserTransaction::query()
            ->select('id', 'type', 'value', 'description', 'created_at')
            ->where('user_id', $request->user()->id)
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
            ->json(compact('extracts', 'points'));
    }
}
