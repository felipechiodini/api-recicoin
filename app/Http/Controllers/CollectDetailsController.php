<?php

namespace App\Http\Controllers;

use App\Models\UserCollect;
use Illuminate\Http\Request;

class CollectDetailsController extends Controller
{

    public function __invoke(UserCollect $userCollect, Request $request)
    {
        $collect = [
            'id' => $userCollect->id,
            // 'status' => $userCollect->status,
            // 'points' => 200,
            // 'date' => Carbon::parse($userCollect->created_at)->format('d/m/Y'),
        ];

        return response()
            ->json(compact('collect'));
    }

}
