<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RouteLogicController extends Controller
{
    static function redirectLogic()
    {
        $name = User::find(Auth::user()->id)->role()->first()->id;
        switch ($name)
        {
            case '1':
                if(Session::has('administrator'))
                {
                    return '/administrator';
                }
                else
                {
                    Session::put('administrator', '1');
                    return '/administrator';
                }
                break;
            case '2':
                if(Session::has('client'))
                {
                    return '/client';
                }
                else
                {
                    Session::put('client', '1');
                    return '/client';
                }
                break;
            default:
                Auth::logout();
                return '/';
                break;
        }
    }
}