<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
    
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/nearbyshops';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     protected function authenticated(Request $request, $user)
    {
        if( $request->get('location') !== null ){
            $location= json_decode($request->get('location'));
            $user->location = ['type' => 'Point', 'coordinates' => [$location->lat, $location->lon]];

            $user->save();
        } 
    }
}
