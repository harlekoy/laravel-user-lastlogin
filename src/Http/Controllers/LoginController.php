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
        return view('lastlogin::layout', [
            'logins' => Login::with('user')->latest()->get(),
        ]);
    }
}
