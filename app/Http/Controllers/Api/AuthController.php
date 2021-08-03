<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'app_id' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:255',
            'app_name' => 'required|string',
        ]);

        if ($validator->fails())
            return $this->sendError('Ошибка валидации', $validator->errors(), 400);

        $data = $validator->valid();
        $app = User::where('app_id', $request->app_id)->first();

        if (!$app || !Hash::check($data['password'], $app->password))
            return $this->sendError('Ошибка авторизации', null, 401);

        $token = $app->createToken($data['app_name'])->plainTextToken;

        return $this->sendResponse($token, 'Приложение успешно авторизовано');
    }
}
