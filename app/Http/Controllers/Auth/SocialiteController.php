<?php

// namespace App\Http\Controllers;

// use Exception;
// use Illuminate\Http\Request;
// use Laravel\Socialite\Facades\Socialite;
// use App\Models\User;
// use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\BaseController;



// class SocialiteController extends BaseController
// {
//     public function redirectToGoogle()
//     {
//         return Socialite::driver('google')->redirect();
//     }

//     public function handleGoogleCallback()
//     {
//         try {
//             $user = Socialite::driver('google')->user();
//             $finduser = User::where('social_id', $user->id)->first();
//             if ($finduser) {
//                 Auth::login($finduser);
//                 return response()->json($finduser);
//             } else {
//                 $newuser = User::create([
//                     'first_name' => $user->first_name,
//                     'last_name' => $user->last_name,
//                     'password' => $user->password,
//                     'email' => $user->email,
//                     'gender' => $user->gender,
//                     'date_of_borm' => $user->date_of_born,
//                     'google_id' => $user->id,
//                     'address' => $user->address,
//                     'mobile_number' => $user->mobile_number,

//                 ]);
//                 Auth::login($newuser);
//                 return response()->json($finduser);
//             }
//         } catch (Exception $e) {
//             dd($e->getMessage());
//         }
//     }
// }
