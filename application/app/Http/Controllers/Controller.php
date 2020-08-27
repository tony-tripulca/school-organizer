<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $data;

    public function getCurrentUser()
    {
        /*
        |--------------------------------------------------------------------------
        | Session In The Constructor
        |--------------------------------------------------------------------------

        Source: https://laravel.com/docs/5.3/upgrade#5.3-session-in-constructors

        In previous versions of Laravel, you could access session variables or the authenticated user in your controller's constructor. This was never intended to be an explicit feature of the framework. In Laravel 5.3, you can't access the session or authenticated user in your  controller's constructor because the middleware has not run yet.

        As an alternative, you may define a Closure based middleware directly in your controller's constructor. Before using this feature, make sure that your application is running Laravel 5.3.4 or above:

        |
         */
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $user = User::where('active', 1)
                    ->where('id', auth()->user()->id)
                    ->first();

                $user_detail = UserDetail::where('active', 1)
                    ->where('user_id', auth()->user()->id)
                    ->first();

                $this->data['current_user'] = array(
                    'id' => $user->id,
                    'api_token' => $user->api_token,
                    'email' => $user->email,
                    'username' => $user_detail->username,
                    'identifier' => $user_detail->identifier,
                    'image' => $user_detail->image,
                    'first_name' => $user->first_name,
                    'middle_name' => $user_detail->middle_name,
                    'last_name' => $user->last_name,
                    'suffix' => $user_detail->suffix,
                );

            } else {
                $this->data['current_user'] = array(
                    'id' => null,
                    'email' => "john.doe@email.com",
                    'username' => "john.doe",
                    'identifier' => "j0HnDoE",
                    'image' => null,
                    'first_name' => "John",
                    'middle_name' => "Person",
                    'last_name' => "Doe",
                    'suffix' => "Jr.",
                );

            }

            return $next($request);
        });
    }

    public function getYear($date)
    {
        return date('Y', strtotime($date));
    }

    public function dbDateFormat($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    public function appDateFormat($date)
    {
        return date("d F, Y", strtotime($date));
    }
}
