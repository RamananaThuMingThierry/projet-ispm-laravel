<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'Validation_errors' => $validator->messages(),
            ]);
        }else{
       
            $user = User::where('email', $request->email)->first();

            if(!$user || !Hash::check($request->mot_de_passe, $user->mot_de_passe)){
                return response()->json([
                    'status' => 401,
                    'message' => 'Les champs sont invalides!',
                ]);

            }else{

                if($user->roles === 1) // 1 pour admin
                {
                    $role = "admin";
                    $token = $user->createToken($user->email.'_AdminToken', ['server:admin'])->plainTextToken;
                }else{
                    $role = "";
                    $token = $user->createToken($user->email.'_Token', [''])->plainTextToken;
                }
               
                return response()->json([
                    'status' => 200,
                    'username' => $user->pseudo,
                    'token' => $token,
                    'message' => 'Connexion avec succès!',
                    'role' => $role
                ]);
            }

            
        }
    }

    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'pseudo' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users',
            'mot_de_passe' => 'required|min:8',
        ]);

        if($validator->fails()){
            return response()->json([
                'Validation_errors' => $validator->messages(),
            ]);
        }else{
            $user = User::create([
                'pseudo' => $request->pseudo,
                'email' => $request->email,
                'mot_de_passe' => Hash::make($request->mot_de_passe)
            ]);

            $token = $user->createToken($user->email.'_Token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'username' => $user->pseudo,
                'token' => $token,
                'message' => 'Inscription effectué avec succès!',
            ]);
        }
    }

    public function logout(){
      //  auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => "Déconnexion effectuée avec succès!",
        ]);
    }
}
