<?php

namespace App\Http\Controllers;

use App\Models\Classes\CustomResponse;
use App\Models\Enums\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate =  Validator::make(
            $request->all(),
            [
                "name" => "required",
                "email" => "email|required|unique:users",
                "password" => "required|confirmed",
            ]
        );

        if ($validate->fails()) {
            return json_encode(new CustomResponse(Status::Failed->value, $validate->errors(), "Validation error"));
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return $user;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate =  Validator::make(
            $request->all(),
            [
                "name" => "required"
            ]
        );

        if ($validate->fails()) {
            return json_encode(new CustomResponse(Status::Failed->value, $validate->errors(), "Validation error"));
        }

        $user = User::find($id);
        if ($user) {
            $user->name = $request->name;
            return json_encode(new CustomResponse(Status::Successful->value, $user, "Profile updated"));
        }

        return json_encode(new CustomResponse(Status::Failed->value, null, "User not found"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $user = User::find($id);
        if ($user) {
            $user = $user->delete();
            return json_encode(new CustomResponse(Status::Successful->value, null, "User deleted"));
        }

        return json_encode(new CustomResponse(Status::Failed->value, null, "User not found"));
    }
}
