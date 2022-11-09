<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class StudentController extends Controller
{
    //

    //add student
    public function addStudent(Request $request)
    {

        try {
            return Student::create(
                [
                    'address' => $request->input('address'),
                    'email' => $request->input('email'),
                    'name' => $request->input('name'),
                    'contact' => $request->input('contact'),
                    'class name' => $request->input('class name'),
                    'dob' => $request->input('dob'),
                    'user_id' => Auth::user()->id,
                ]
            );
        } catch (\Throwable $th) {
            $msg = $th->errorInfo[2];
            return response()->json(['msg' => $msg], 501);
        }



    }

    public function getstudents(Request $request)
    {
        try {
            //code...
            $user = User::findOrFail(Auth::user()->id);

            return $user->students()->get();
        } catch (\Throwable $th) {
            $msg = $th->errorInfo[2];
            return response()->json(['msg' => $msg], 501);
        }

    }
    public function getstudent(Request $request)
    {
        try {
            //code...
            $user = User::findOrFail(Auth::user()->id);
            return $user->students()->where('id', '=', $request->id)->get();
            ;
        } catch (\Throwable $th) {
            $msg = $th->errorInfo[2];
            return response()->json(['msg' => $msg], 501);
        }

    }

    public function updateStudent(Request $request)
    {

        try {
            //code...
            Student::where('id', '=', $request->id)->update(
                [
                    'address' => $request->input('address'),
                    'email' => $request->input('email'),
                    'name' => $request->input('name'),
                    'contact' => $request->input('contact'),
                    'class name' => $request->input('class name'),
                    'dob' => $request->input('dob'),
                    'user_id' => Auth::user()->id,
                ]
            );
            return 'the student with id ' . $request->id . ' has successfully updated';
        } catch (\Throwable $th) {
            $msg = $th->errorInfo[2];
            return response()->json(['msg' => $msg], 501);
        }

    }


    public function deleteStudent(Request $request)
    {
        Student::where('id', '=', $request->id)->delete();
        return 'the student with id ' . $request->id . ' has successfully deleted';
    }



}