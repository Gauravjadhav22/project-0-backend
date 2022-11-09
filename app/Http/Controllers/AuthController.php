<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function user()
    {

        return Auth::user();
    }
    public function updateUser(Request $request)
    {
        try {
            $user = User::where('id', '=', $request->id)->update(
                [
                    'email' => $request->input('email'),
                    'name' => $request->input('name'),
                ]
            );
            return $user;
        } catch (\Throwable $th) {
            $msg = $th->errorInfo[2];
            return response()->json(['msg' => $msg], 501);
        }


        return 'the user with id ' . $user . ' has successfully updated';
    }

    public function register(Request $request)
    {
        try {
            return User::create(
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                ]
            );
            // $user = User::where('email', '=', $request->input('email'))->first();
            // return $user;
            // return ['name'=>$request->input('name'),'email'=> $request->input('email')];
        } catch (\Throwable $th) {
            // return $th->errorInfo[1];
            $msg = $th->errorInfo[2];
            return $th->errorInfo;
            return response()->json(['msg' => $msg], 501);
        }


    }

    public function login(Request $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {

            return response(['message' => 'invalid credenetials'], Response::HTTP_UNAUTHORIZED);
        }

        try {
            //code...
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('jwt', $token, 60 * 24); //1d

            // $response = new \Illuminate\Http\Response();
            // $response->withCookie(cookie('user_id',(string)$token, 60));
            // return $response;




            return response(
                [
                    "token" => $token,
                    "user" => $user
                ]
            )->withCookie(
                    cookie('jwt',  $cookie)
                );




        } catch (\Throwable $th) {
            $msg = $th->errorInfo[2];
            return response()->json(['msg' => $msg], 501);
        }
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response(
            [
                'msg' => "Success"
            ]
        )->withCookie(
                $cookie
            );

    }


}