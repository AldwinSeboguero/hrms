<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use App\Models\Employee;
class GoogleController extends Controller
{
    public function googlepage()
    {
        return Socialite::driver('google')->stateless()->redirect();

    }
    public function googlecallback()
    {
        // try {

      
            // dd(Socialite::driver('google')->stateless()->user()->id);

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('email', $user->email)->first();

    

            if($finduser)



            {

       

                Auth::login($finduser);

      

                return redirect()->intended('dashboard');

       

            }



            else



            {
                 $finduser = Employee::where('email_address', $user->email)->first();
                 if($finduser)



                    {

            

                        Auth::login($finduser);

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,


                    'password' => encrypt('$2y$12$BOw4aPmkN.hT3KEV0zwAAOzfZ/JAhSnhWx9wcFqaam9pkfDsIEpui')

                ]);

      
$newUser->assignRole('user');
                Auth::login($newUser);


                        return redirect()->intended('/'); 

            

                    }

                // $newUser = User::create([

                //     'name' => $user->name,

                //     'email' => $user->email,

                //     'google_id'=> $user->id,

                //     'password' => encrypt('123456dummy')

                // ]);

      

                // Auth::login($newUser);

      

                return redirect()->intended('notregister');

            }

      

        // } catch (Exception $e) {

        //     dd($e->getMessage());

        // }
    }
}
