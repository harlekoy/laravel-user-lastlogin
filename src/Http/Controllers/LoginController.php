<?php

namespace Harlekoy\LastLogin\Http\Controllers;

use Harlekoy\LastLogin\Models\Login;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logins = Login::with('user')
            ->latest()
            ->limit(config('lastlogin.limit'))
            ->get();

        return view('lastlogin::layout', [
            'logins' => $logins,
        ]);
    }
}
