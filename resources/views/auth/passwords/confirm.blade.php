@extends('layouts.app')

@section('content')
    <div class="h-screen flex items-center justify-center">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
            <div class="mb-4 font-bold text-xl">{{ __('Confirm Password') }}</div>
            <div class="mb-4">{{ __('Please confirm your password before continuing.') }}</div>
            <form method="POST" class="flex flex-col" action="{{ route('password.confirm') }}">
                @csrf
                <div class="mb-4">
                    <label for="password"
                           class="block text-gray-700 font-bold mb-2">{{ __('Password') }}</label>
                    <input id="password" type="password"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                           name="password" required autocomplete="current-password">
                    @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        {{ __('Confirm Password') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                           href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
