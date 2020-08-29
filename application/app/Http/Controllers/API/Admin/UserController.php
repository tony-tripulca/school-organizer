<?php

namespace App\Http\Controllers\API\Admin;

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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json($this->user->get($request->input()));
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
        $user_type = "";
        switch ($request->input("user_type_id")) {
            case 3:
                $user_type = "Admin";
                $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|unique:users,email|email',
                ]);
                break;
            case 6:
                $user_type = "Student";
                $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|unique:users,email|email',
                ]);
                break;
        }

        // Add user to users table
        $user = $this->user->create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => $this->user->defaultPassword(),
            'api_token' => $this->user->generateApiToken(),
            'type_id' => $request->input('user_type_id'),
        ]);

        // Add user to user_details table
        $this->user_detail->create([
            'user_id' => $user->id,
        ]);

        // Update user details from user_details table
        $this->user_detail->where([
            'user_id' => $user->id,
        ])->update([
            'middle_name' => $request->input('middle_name'),
            'suffix' => $request->input('suffix'),
            'gender' => $request->input('gender'),
            'full_address' => $request->input('full_address'),
            'mobile' => $request->input('mobile'),
            'father_name' => $request->input('father_name'),
            'father_mobile' => $request->input('father_mobile'),
            'mother_name' => $request->input('mother_name'),
            'mother_mobile' => $request->input('mother_mobile'),
        ]);

        return response()->json(['success' => ucwords($user_type) . " has been added"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->user->getById($id));
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
        dd($request->input());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->where([
            'id' => $id,
        ])->update([
            'active' => 0,
            'email' => null,
        ]);

        $this->user_detail->where([
            'user_id' => $id,
        ])->update([
            'active' => 0,
        ]);

        return response()->json(['success' => "User has been deleted"]);
    }
}
