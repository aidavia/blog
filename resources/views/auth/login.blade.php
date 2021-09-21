@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto py-20 px-4 sm:px-6 lg:px-8">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            <div class="rounded-md shadow-sm space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <div class="mt-1">
                        <x-input id="email"
                                 placeholder="your@email.com"
                                 type="email"
                                 name="email"
                                 :value="old('email')"
                                 required autofocus
                        />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <x-label for="password" :value="__('Password')" />
                    <div class="mt-1">
                        <x-input id="password"
                                 type="password"
                                 name="password"
                                 required
                                 autocomplete="current-password"
                        />
                    </div>
                </div>
            </div>
            <x-button>
                {{ __('Log in') }}
            </x-button>
        </form>
    </div>
@endsection
