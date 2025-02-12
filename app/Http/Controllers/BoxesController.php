<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Boxes;

class BoxesController extends Controller
{
    /**
     * Display all the boxes the user's can see.
     */
    public function getAll(Request $request): View
    {
        $boxes = Boxes::all();

        return view('boxes.getAll', [
            'boxes' => $boxes,
            'user' => $request->user(),
        ]);
    }
}
