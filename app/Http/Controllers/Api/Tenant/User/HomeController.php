<?php

namespace App\Http\Controllers\Api\Tenant\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return response(['data' => Auth::guard('user')->user()]);
    }
}
