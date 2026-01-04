<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        // Валідація вхідних даних
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        // Шукаємо користувача за логіном
        $user = User::where('login', $request->login)->first();

        // Перевірка пароля (безпечне порівняння через Hash)
        if ($user && Hash::check($request->password, $user->password)) {
            // Створюємо API-токен для сесії (Laravel Sanctum)
            $token = $user->createToken('admin-token')->plainTextToken;
            
            return response()->json([
                'token' => $token,
                'message' => 'Вхід успішний'
            ]);
        }

        // Якщо дані невірні
        return response()->json(['message' => 'Невірний логін або пароль'], 401);
    }

    public function logout(Request $request)
    {
        // Видаляємо токен при виході
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Вихід успішний']);
    }
}