<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Toegevoegd
use App\Models\User;

class AuthController extends Controller
{

    // For registering new users into the Users table
    public function register(Request $req) {

        // validate user
        $rules = [
            'name' => "required|string",
            'email' => "required|string|email|unique:users", // Toegevoegd 'email' validatie
            'password' => "required|string|min:6"
        ];
        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Create new user in users table
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        $token = $user->createToken('Personal Access Token')->plainTextToken;
        $response = ['user' => $user, 'token' => $token];
        return response()->json($response, 200);
    }

    // For verifying a login by a user
    public function login(Request $req) {
        
        // Validate inputs
        $rules = [
            "email" => "required|string|email", // Toegevoegd 'email' validatie
            "password" => "required|string"
        ];

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Find user email in user table
        $user = User::where("email", $req->email)->first();

        // If user email found and password is correct
        if ($user && Hash::check($req->password, $user->password)) {
            $token = $user->createToken("Personal Access Token")->plainTextToken;
            $response = ["user" => $user, "token" => $token];
            return response()->json($response, 200);
        }

        $response = ["message" => "Incorrect email or password"];
        return response()->json($response, 400);
    }
}
