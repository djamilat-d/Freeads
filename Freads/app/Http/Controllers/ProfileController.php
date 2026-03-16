<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Ad;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function AdminUser(){
        if(auth()->user()->admin == 0){
            return redirect()->route('acceuil');
        }
        $users = User::paginate(15);

        return view('admin.user', compact('users'));
    }

    public function deleteUser($id){
        if(auth()->user()->admin == 0){
            return redirect()->route('acceuil');
        }
        $user= User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user');
    }
    
    public function editUser($id){
        if(auth()->user()->admin == 0){
            return redirect()->route('acceuil');
        }
        $user = User::findOrFail($id);
        $ads = Ad::where("user_id", "=", $user->id)->get();
        return view('admin.modify', [
            "user" => $user,
            "ads" => $ads
        ]);
    }

    public function modifyUser(Request $request, $id){
        if(auth()->user()->admin == 0){
            return redirect()->route('acceuil');
        }
        $user= User::where("id", "=", $id)->update(["admin" => $request->admin]);
        /*$user->update($request->all());
        if($request->validate(['admin' => ['required'], 'exists:users,admin'.User::class])){
            $user->update($request->all());
        }*/
       return redirect()->route('admin.user');
    }
}
