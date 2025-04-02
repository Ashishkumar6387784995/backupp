<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Category;
use DB;
use Validator;
use Image;
use File;
use Auth;
use Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        try {
            $page_title = 'Dashboard';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Dashboard',
                    'url' => '',
                ],
            ];
            
            // dd($ordersMonthWiseData);
            return view('admin.pages.dashboard.list', compact('page_title', 'page_description', 'breadcrumbs'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function changePass(Request $request) {
        try {
            if ($request->isMethod('post')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'old_password' => 'required',
                    'password' => 'required|min:8|confirmed',
                ], [
                    'old_password.required' => 'Current password is required.',
                    'password.required' => 'New password is required.',
                    'password.min' => 'New password must be at least 8 characters.',
                    'password.confirmed' => 'New password confirmation does not match.',
                ]);
    
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
    
                // Check if current password matches the one in the database
                $user = Auth::guard('admin')->user();
                if (!Hash::check($request->old_password, $user->password)) {
                    return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
                }
    
                // Update the password in the database
                $user->password = Hash::make($request->password);
                $user->save();
    
                return redirect()->back()->with('success', 'Password updated successfully.');
            }
            return view('admin.pages.auth.changePassword');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
