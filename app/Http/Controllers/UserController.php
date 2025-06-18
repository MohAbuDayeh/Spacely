<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
     public function profile($id)
    {
        $user = User::findOrFail($id);


        $data = [
            'user' => $user,
            'activeTab' => request()->get('tab', 'profile')
        ];

        if ($user->hasRole('admin')) {
            $data['usersCount'] = User::count();
            $data['bookingsCount'] = Booking::count();
            $data['spacesCount'] = Workspace::count();
            return view('admin.profile', $data);
        }
        elseif ($user->hasRole('lessor')) {
            $data['spaces'] = $user->workspaces()->with('bookings')->get();
            return view('lessor.profile', $data);
        }
        else {
            $data['bookings'] = Booking::where('user_id', $id)
                ->with('workspace')
                ->orderBy('created_at', 'desc')
                ->get();
            return view('user.profile', $data);
        }
    }

    public function edit($id, $ref)
    {
        $user = User::findOrFail($id);

        return redirect()->route($user->getProfileRoute(), [
            'id' => $id,
            'tab' => ($ref == 'personal') ? 'profile' : 'password'
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->has('current_password')) {
            $this->updatePassword($request, $user);
        } else {
            $this->updateProfile($request, $user);
        }

        return redirect()->route($user->getProfileRoute(), $user->id)
            ->with('success', __('Profile updated successfully'))
            ->with('activeTab', $request->has('current_password') ? 'password' : 'profile');
    }

    protected function updateProfile(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $user->id
            ],
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'The full name field is required.',
            'email.required' => 'The email address field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'phone.required' => 'The phone number field is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB in size.',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image) {
                Storage::delete('public/' . $user->image);
            }

            // Store new image
            $path = $request->file('image')->store('public/images/users');
            $user->image = str_replace('public/', '', $path);
        } elseif ($request->has('remove_image') && $request->remove_image == '1') {
            // Remove existing image
            if ($user->image) {
                Storage::delete('public/' . $user->image);
                $user->image = null;
            }
        }

        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
        ]);

        return redirect()->route('user.profile', $user->id)
            ->with('success', 'Profile updated successfully');
    }

    protected function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'The current password field is required.',
            'password.required' => 'The new password field is required.',
            'password.min' => 'The new password must be at least 8 characters.',
            'password.confirmed' => 'The new password confirmation does not match.',
        ]);

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully');
    }
}
