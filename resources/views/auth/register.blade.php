@extends('layouts.app')

@section('content')
    <div class="h-screen flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-5 rounded-lg lg:rounded-l-none">
            <h3 class="pt-4 text-2xl text-center">{{ __('Register') }}</h3>
            <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                        {{ __('Name') }}
                    </label>
                    <input
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autocomplete="name"
                        autofocus
                    />
                    @error('name')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                        {{ __('Email Address') }}
                    </label>
                    <input
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                    />
                    @error('email')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                        {{ __('Password') }}
                    </label>
                    <input
                        class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                    />
                    @error('password')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="password-confirm">
                        {{ __('Confirm Password') }}
                    </label>
                    <input
                        class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="password-confirm"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                </div>
                <div class="flex justify-center mt-4">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
