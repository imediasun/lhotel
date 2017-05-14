<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Support\Facades\Auth;
class FacebookController extends Controller
{


    use AuthenticatesUsers;
    protected $redirectTo = '/home';
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $socialUser = Socialite::driver('facebook')->user();
        $data=[
        'facebook_id' => $socialUser->getId(),
        'name' => $socialUser->name,
        'email' => $socialUser->getEmail(),
        'password'=> 'default'
        ];
        $user= User::where('facebook_id',$data['facebook_id'])->first();

        if(is_null ($user)){
           //Создание нового пользователя
            $user=new User($data);
            $user->save();
            //здесь можно отправить письмо спаролем default ЗАРЕГИЛСЯ!!
        }
        Auth::login($user,true);
        return redirect($this->redirectPath());

        // $user->token;
    }
}