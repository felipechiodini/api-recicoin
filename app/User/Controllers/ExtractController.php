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
        $points = Helpers::formatCurrency(1000);

        $respository = new \App\Modules\Collect\CollectRepository();
        $extracts = $respository->getAllTransactions($request->user())
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
