@extends('layouts.app')

@section('content')
    <div class="h-screen flex items-center justify-center">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
            <div class="mb-4 font-bold text-xl">{{ __('Verify Your Email Address') }}</div>
            <div class="p-6">
                @if (session('resent'))
                    <div class="bg-green-100 text-green-800 border-l-4 border-green-500 py-2 px-4 mb-4"
                         role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                <p class="mt-2">{{ __('If you did not receive the email') }},</p>
                <form class="inline-block" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit"
                            class="text-blue-500 hover:underline">{{ __('click here to request another') }}</button>
                    .
                </form>
            </div>
        </div>
    </div>
@endsection
