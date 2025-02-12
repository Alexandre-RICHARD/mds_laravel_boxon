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
        $boxes = Boxes::where("user_id", Auth::id())->get();

        return view('boxes.get-all', [
            'boxes' => $boxes,
            'user' => $request->user(),
        ]);
    }

    /**
     * Display one box that user can see.
     */
    public function getOne(Request $request): View
    {
        $id = $request->route('id');
        $box = Boxes::where([
            ['id', '=', $id],
            ['user_id', '=', Auth::id()],
        ])->firstOrFail();

        return view('boxes.get-one', [
            'box' => $box,
            'user' => $request->user(),
        ]);
    }
}
