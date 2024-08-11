<?php

namespace App\Modules\Collect;

enum Status: string
{
    case Requested = 'requested';
    case Collected = 'collected';
    case Finished = 'finished';
}
