<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if ($user) {
            return view('admin.profile.index', compact('user'));
        }

        return redirect()->route('admin');
    }

    public function save(Request $request)
    {
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);
        if ($user) {
            $data = $request->only([
                'name', 'email', 'password', 'password_confirmation'
            ]);

            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:100']
            ]);

            // alterando nome
            $user->name = $data['name'];

            // alteração do email
            // verificando se o email foi realmente alterado
            if ($user->email != $data['email']) {
                // se sim, verificando se o email já existe
                $hasEmail = User::where('email', $data['email'])->get();
                // se não existir, nós alteramos
                if (count($hasEmail) === 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique', ['attribute' => 'email']));
                }
            }

            // alteração de senha
            if (!empty($data['password'])) {
                if (strlen($data['password']) >= 4) {
                    if ($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', __('validation.confirmed', ['attribute' => 'password']));
                    }
                } else {
                    $validator->errors()->add('password', __('validation.min.string', ['attribute' => 'password', 'min' => 4]));
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('profile', $loggedId)
                    ->withErrors($validator);
            }

            $user->update();

            return redirect()->route('profile')
                ->with('warning', 'Informações alteradas com sucesso!');
        }

        return redirect()->route('profile');
    }
}
