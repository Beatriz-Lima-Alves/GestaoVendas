<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-green-bk">
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-green-bk">
    <div>
        <h1 class="t-40 text-center text-white">Recupere a sua senha</h1>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-green-sb text-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="mb-4 text-sm text-white">
            {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um link de redefinição de senha por e-mail que permitirá que você escolha uma nova') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-white"/>
                <x-text-input id="email" class="block mt-1 w-full text-black" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="purple-button" style="background-color: #64B83E">
                    {{ __('Resetar a senha') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
