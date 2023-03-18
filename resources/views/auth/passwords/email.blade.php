@extends('layouts.app')

@section('content')
    <div class="h-screen flex items-center justify-center">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
            <div class="mb-4 font-bold text-xl">{{ __('Reset Password') }}</div>
            @if (session('status'))
                <div class="bg-green-100 text-green-800 border border-green-400 rounded mb-4 px-4 py-3"
                     role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form class="flex flex-col" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4">
                    <label for="email"
                           class="block text-gray-700 font-bold mb-2">{{ __('Email Address') }}</label>
                    <input id="email" type="email"
                           class="w-full px-4 py-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 border border-gray-400 rounded @error('email') border-red-500 @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between mb-0">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
