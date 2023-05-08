<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class profileController extends Controller
{
      
public function index()
{
    return view('profile.profile');
}
public function viewProfile($id)
    {
        // Get the user by ID
        $user = User::findOrFail($id);

        // Increment the profile view count for this user
        $user->incrementProfileView();
      // Retrieve the profile view count for this user
       // $profileViews = $user->profileViews->count();

        // Pass the view count to the view
        $profileViews = $user->profileViews->groupBy(function($item){
            return $item->created_at->format('F Y');
        });
        
        return view('profile.profile', compact('user', 'profileViews'));

        //return view('profile', compact('profileViews'));
    }   

 
}