@extends('layouts.app')

@section('content')
    <div class="h-screen flex items-center justify-center">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
            <div class="mb-4 font-bold text-xl">{{ __('Login') }}</div>
            <form method="POST" class="flex flex-col" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email"
                           class="block text-gray-700 text-sm font-bold mb-2">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-input @error('email') border-red-500 @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password"
                           class="block text-gray-700 text-sm font-bold mb-2">{{ __('Password') }}</label>
                    <input id="password" type="password"
                           class="form-input @error('password') border-red-500 @enderror" name="password"
                           required autocomplete="current-password">

                    @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 flex flex-row items-center">
                    <input class="mr-2 leading-tight" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="text-gray-700 text-sm font-bold" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <button type="submit"
                        class="mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </form>
        </div>
    </div>
@endsection
