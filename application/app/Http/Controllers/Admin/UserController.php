<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\Users\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private $user, $user_detail;

    public function __construct(User $user, UserDetail $user_detail)
    {
        $this->user = $user;
        $this->user_detail = $user_detail;

        $this->getCurrentUser();

        $this->data['tab_title'] = "School Organizer | Admin";
    }

    public function new_function() {
        // This is a test code
        // Another line here
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        switch ($request->input('type')) {
            case "admin":
                $this->data['user_type_id'] = 3;
                $this->data['user_type'] = "admin";
                break;
            case "student":
                $this->data['user_type_id'] = 6;
                $this->data['user_type'] = "student";
                break;
            default:
                $this->data['page_title'] = "USERS";
                break;
        }

        return view('admin/users/index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(['testing' => "Test"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
