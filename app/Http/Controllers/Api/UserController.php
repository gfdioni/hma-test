<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5);

        return new PostResource(true, 'Success', $users);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,user_email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
                    'user_fullname' => $request->nama_lengkap,
                    'user_email' => $request->email,
                    'password'  => Hash::make($request->password),
                    'user_status' => 1
                ]);

        return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $user);
    }

    public function show($user)
    {
        $data = User::find($user);

        return new PostResource(true, 'Detail Data User', $data);
    }

    public function update(Request $request, $user)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['nullable','string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $userRequestData = array_filter($request->except(['password', 'password_confirmation']));

        $user = User::find($user)->update($userRequestData);

        if(filled($request->password))
        {
            User::find($user)->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return new PostResource(true, 'Data User Berhasil Diubah!', $user);
    }

    public function destroy($user)
    {
            $user = User::find($user);
            $user->delete();

            return new PostResource(true, 'Data User Berhasil Dihapus!', null);
    }
}
