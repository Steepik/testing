<?php

namespace App\Http\Controllers;

use App\Nets;
use Illuminate\Http\Request;

class DBController extends Controller
{
    public function index()
    {
        $all = Nets::all();

        foreach($all as $item) {
            $num  = substr($item->stand, 0, 4);
            $record = Nets::where('uid', $item->uid)->update(['nid' => $num]);
        }
    }
}
