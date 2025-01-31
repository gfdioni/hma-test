<?php

namespace App\Http\Controllers;

use DataTables;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        return view('dashboard.user-management.index');
    }

    public function list()
    {
        $data = User::select('user_id', 'user_fullname', 'user_email')->get();
        $dt = DataTables::of($data)
        ->addColumn('action', function ($q) {
            $url = '<a class="btn btn-success btn-sm" href="' . route('user-management-detail', ['id' => $q->user_id]) . '"><i class="far fa-eye"></i> Edit</a>';
            if($q->user_id !== Auth::id())
            {
                $url = $url . '<br> <a class="btn btn-danger btn-sm" href="' . route('user-management-hapus', ['id' => $q->user_id]) . '"><i class="fas fa-trash"></i> Hapus</a>';
            }
            return $url;
        })->rawColumns(['action'])->addIndexColumn()->make();

        return $dt;
    }

    public function create()
    {
        return view('dashboard.user-management.tambah');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,user_email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'user_fullname' => $request->nama,
            'user_email' => $request->email,
            'password'  => Hash::make($request->password),
            'user_status' => 1
        ]);

        return redirect()->route('user-management-index');
    }

    public function show($id)
    {
        $data = User::find($id);
        return view('dashboard.user-management.edit', $data);
    }

    public function update(Request $request)
    {

        $request->validate([
            'password' => ['nullable','string', 'min:8', 'confirmed'],
        ]);

        $userRequestData = array_filter($request->except(['password', 'password_confirmation']));

        User::find($request->user_id)->update($userRequestData);

        if(filled($request->password))
        {
            User::find($request->user_id)->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('user-management-index');
    }

    public function delete($id)
    {
        if($id !== Auth::id())
        {
            $user = User::find($id);
            $user->delete();
        }

        return redirect()->route('user-management-index');
    }
}
