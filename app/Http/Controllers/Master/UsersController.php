<?php

namespace App\Http\Controllers\Master;

use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;

class UsersController extends Controller
{
    public function index()
    {
        return view('master.users.index');
    }

    public function get_user()
    {
        $users = User::all();

        return DataTables::of($users)
            ->addIndexColumn()
            ->editColumn('foto', function ($user) {
                return '<img id="foto" class="" onerror="this.onerror=null;this.src=\''.asset('assets/img/default-profile.jpg').'\';" src="'.asset($user->foto).'" alt="foto-profile" width="75">';
            })
            ->addColumn('action', function($user){
                $btn = '
                    <a href="'.route('users.show', $user->id).'" class="btn btn-primary">Show</a>
                    <a href="'.route('users.edit', $user->id).'" class="btn btn-warning">Edit</a>
                    <a href="'.route('users.destroy', $user->id).'" data-csrf="'.csrf_token().'" class="btn btn-danger btn-delete">Delete</a>
                ';

                return $btn;
            })
            ->rawColumns(['foto', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('master.users.form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg',
            'username' => 'required|min:3|unique:users',
            'email' => 'required|email:dns|unique:users',
            'role' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = $user->id."_".$user->username.".".$file->getClientOriginalExtension();
            $path_file = $file->storeAs('public/uploads/'.$user->id.'/foto', $nama_file);
            $user->foto = $nama_file;
            $user->save();
        }

        return redirect()->route('users.index')->with('success', 'Account created successfully!');
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('master.users.show')->with([
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('master.users.form')->with([
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => 'required|min:3',
            'email' => 'required|email:dns',
            'role' => 'required',
        ]);

        $user = User::find($id);

        if ($request->password) {
            $request->validate([
                'password' => 'min:8|confirmed',
            ]);

            $validatedData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg',
            ]);

            $file = $request->file('foto');
            $nama_file = $user->id."_".$user->username.".".$file->getClientOriginalExtension();
            $path_file = $file->storeAs('public/uploads/'.$user->id.'/foto', $nama_file);

            $validatedData['foto'] = $nama_file;
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'Account updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->foto) {
            $path_storage = 'storage/uploads/'.$user->id;
            if (file_exists($path_storage)) {
                File::deleteDirectory(public_path($path_storage));
            }
        }

        $user->delete();

        return response()->json([
            'message' => 'Account deleted successfully!',
        ]);
    }
}
