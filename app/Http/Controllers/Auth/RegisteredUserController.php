<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $nome = $request->input('busca');

        // Verifica se foi fornecido um nome na consulta
        if ($nome) {
            // Filtra os funcionários pelo nome fornecido
            $funcionarios = User::where('name', 'like', '%' . $nome . '%')->get();
        } else {
            // Caso não tenha sido fornecido um nome, retorna todos os funcionários
            $funcionarios = User::all();
        }
        return view('funcionario/funcionario', compact('funcionarios'));
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('funcionario.index', absolute: false));
    }

    public function deleteUser($id): RedirectResponse
    {

        if(!$user = User::find($id))
            return redirect()->route('funcionario.index');

        $user->active = 0;
        $user->save();
        return redirect()->back()->with('success', 'Status atualizado com sucesso.');
    }


}
