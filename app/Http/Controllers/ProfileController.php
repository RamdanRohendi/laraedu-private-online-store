<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        return view('auth.profile')->with([
            'user' => $user,
        ]);
    }

    public function updateFoto(Request $request)
    {
        $validatedData = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $user = Auth::user();

        $file = $request->file('foto');
        $nama_file = $user->id."_".$user->username.".".$file->getClientOriginalExtension();
        $path_file = $file->storeAs('public/uploads/'.$user->id.'/foto', $nama_file);

        $user->foto = $nama_file;
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Foto berhasil diubah');
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => ['required','min:8'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Password updated successfully!');
    }

    public function delete(Request $request)
    {
        $user = Auth::user();

        if ($user->foto) {
            $path_storage = 'storage/uploads/'.$user->id;
            if (file_exists($path_storage)) {
                File::deleteDirectory(public_path($path_storage));
            }
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Account deleted successfully!');
    }
}
