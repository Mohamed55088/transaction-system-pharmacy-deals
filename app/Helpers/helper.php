<?php

use App\Models\Sales;

function percentEarn($id)
{

    $sale = Sales::find($id);

    if ($sale !== null) {
        return $sale->total_price;
    } else {
        return 0;
    }
}