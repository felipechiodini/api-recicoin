<?php

namespace App\User\Controllers;

use App\Models\UserTransaction;
use App\Modules\Transaction\Type;
use Carbon\Carbon;
use Felipechiodini\Helpers\Helpers;
use Illuminate\Http\Request;

class HomeController
{
    public function __invoke(Request $request)
    {
        $balance = Helpers::formatCurrency($request->user()->balance);

        $transactions = UserTransaction::query()
            ->select('type', 'value', 'description', 'created_at')
            ->where('user_id', $request->user()->id)
            ->get()
            ->map(function(UserTransaction $transaction) {
                return [
                    'type' => $transaction->type,
                    'type_label' => Type::from($transaction->type)->label(),
                    'value' => Helpers::formatCurrency($transaction->value),
                    'description' => $transaction->description,
                    'date' => Carbon::parse($transaction->created_at)->format('d/m/Y H:i:s'),
                ];
            });

        return response()
            ->json(compact('transactions', 'balance'));
    }
}
