<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
     // profile

    /**
     * Show the profile editing form.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editProfile()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user
    
        return view('users.profile', compact('user')); // Assuming the 'profile' view is in the 'users' folder
    }
    

    /**
     * Update the user's profile data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            // Define validation rules for profile data fields
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8', // Allow password to be nullable (optional)
            'phone' => 'nullable|string|max:15', // Allow phone to be nullable (optional)
            // Add more fields as needed...
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the user's profile data
        $user = Auth::user();
        $user->name = $request->input('name');
        
        // Check if the password field is not empty before updating it
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Check if the phone field is not empty before updating it
        if ($request->filled('phone')) {
            $user->phone = $request->input('phone');
        }

        // Update more fields as needed...
        $user->save();

        return redirect()->route('home')->with('success', 'Profile updated successfully!');
    }

}
