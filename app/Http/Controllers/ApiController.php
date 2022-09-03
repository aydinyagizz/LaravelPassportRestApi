<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function login(Request $request)
    {
//        $email = $request->json()->email;
        $email = $request->email;
        $password = $request->password;

        //attemp; eşleştireceği alanları istiyor olacak.
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            //Login olan kullanıcının bilgilerini alıyoruz.
            $user = Auth::user();

            //kullanıcıya özel token oluşturma. Token oluştururken içine herhangi bir isimde verebiliriz createToken('Login') gibi.
            $success['token'] = $user->createToken('Login')->accessToken;


            return response()->json([
                'success' => $success
            ], 200);


        }

        return response()->json([
            'error' => 'Unauthorized'
        ], 401);

    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->authUserToken()->delete();

            return response()->json(['message' => 'Success Logout.'],200);
        }
        return response()->json([
            'error' => 'Unauthorized'
        ], 401);
    }
}
