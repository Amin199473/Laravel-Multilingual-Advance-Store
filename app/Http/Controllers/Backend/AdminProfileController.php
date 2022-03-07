<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function AdminProfile()
    {
        $admin = Admin::find(1);
        return view('admin.adminProfile', compact('admin'));
    }

    public function AdminProfileEdit($id)
    {
        $admin = Admin::find($id);
        return view('admin.adminProfileEdit', compact('admin'));
    }

    public function AdminProfileUpdate(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        //upload Profile Image
        if ($request->hasFile('image')) {
            @unlink(public_path('upload/admin_images/' . $admin->profile_photo_path));
            $photo = $request->file('image');
            $filename = 'Admin' . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('upload/admin_images');
            $request->file('image')->move($location, $filename);
            $admin->profile_photo_path = $filename;
        }
        $admin->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function AdminChangePassword()
    {
        return view('admin.adminChangePassword');
    }

    public function AdminUpdateChangePassword(Request $request)
    {
        $validateRequest = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Admin::find(1)->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        } else {
            $notification = array(
                'message' => 'the Current password is not correct',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function AllUsers()
    {
        $users = User::all();

        return view('backend.users.all', compact('users'));
    }
}
