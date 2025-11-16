@extends('layouts.auth')

@section('title', 'Login')
@section('heading', 'Sign in to your account')

@section('content')
    <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="rounded-md shadow-sm -space-y-px">
            <div>
                <label for="email" class="sr-only">Email address</label>
                <input id="email" name="email" type="email" autocomplete="email" required 
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border-2 border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-knight-500 focus:border-knight-500 focus:z-10 sm:text-sm" 
                    placeholder="Email address" value="{{ old('email') }}">
            </div>
            <div>
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required 
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border-2 border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-knight-500 focus:border-knight-500 focus:z-10 sm:text-sm" 
                    placeholder="Password">
            </div>
        </div>

        @if ($errors->any())
            <div class="rounded-md bg-red-50 p-4">
                <div class="flex">
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            {{ $errors->first() }}
                        </h3>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" 
                    class="h-4 w-4 text-knight-600 focus:ring-knight-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-900">
                    Remember me
                </label>
            </div>
        </div>

        <div>
            <button type="submit" 
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-knight-600 hover:bg-knight-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-knight-500">
                Sign in
            </button>
        </div>

        <div class="text-center">
            <a href="{{ route('register') }}" class="text-sm text-knight-600 hover:text-knight-900">
                Don't have an account? Register
            </a>
        </div>
    </form>
@endsection

