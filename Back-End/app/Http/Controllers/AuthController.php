<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'city' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:trainers',
            'password' => 'required|string|min:4'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('username') && str_contains($errors->first('username'), 'already been taken')) {
                return response()->json([
                    'Não foi possível realizar seu cadastro na Pokédex devido ao seu cadastro já existir, prossiga para o login na sua Pokédex'], 422);
            }
            if ($errors->has('birthdate') && !str_contains($errors->first('birthdate'), 'required')) {
                return response()->json(['message' => 'Não foi possível realizar seu cadastro na Pokédex devido a informações conflitantes de tipos de dados'], 422);
            }


            return response()->json(['message' => 'Não foi possível realizar seu cadastro na Pokédex devido à falta de informações'], 422);
        }

        $trainer = Trainer::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'city' => $request->city,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Treinador, você foi registrado com sucesso na sua Pokédex',
            'data' => $trainer
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(['message' => 'Treinador, faltam dados para podermos autenticar você na sua Pokédex'], 422);
        }

        $trainer = Trainer::where('username', $request->username)->first();

        if (!$trainer || !Hash::check($request->password, $trainer->password)) {
            return response()->json([
                'message' => 'Treinador, parece que seus dados estão incorretos, confira e tente novamente'
            ], 401);
        }

        $token = $trainer->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login efetuado com sucesso!',
            'token' => $token,
            'token_type' => 'Bearer',
        ], 200);

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Treinador, você foi desconectado!'], 200);
    }

    public function trainerData(Request $request)
    {
        $trainer = $request->user();

        return response()->json([
            'name' => $trainer->name,
            'lastname' => $trainer->lastname,
            'birthdate' => $trainer->birthdate,
            'city' => $trainer->city,
            'username' => $trainer->username,
        ], 200);
    }
}
