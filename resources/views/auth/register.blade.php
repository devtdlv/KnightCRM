@extends('layouts.auth')

@section('title', 'Register')
@section('heading', 'Create your account')

@section('content')
    <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" name="name" type="text" required 
                    class="mt-1 appearance-none relative block w-full px-3 py-2 border-2 border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-knight-500 focus:border-knight-500 sm:text-sm" 
                    placeholder="Your name" value="{{ old('name') }}">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input id="email" name="email" type="email" autocomplete="email" required 
                    class="mt-1 appearance-none relative block w-full px-3 py-2 border-2 border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-knight-500 focus:border-knight-500 sm:text-sm" 
                    placeholder="Email address" value="{{ old('email') }}">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required 
                    class="mt-1 appearance-none relative block w-full px-3 py-2 border-2 border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-knight-500 focus:border-knight-500 sm:text-sm" 
                    placeholder="Password">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                    class="mt-1 appearance-none relative block w-full px-3 py-2 border-2 border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-knight-500 focus:border-knight-500 sm:text-sm" 
                    placeholder="Confirm password">
            </div>
        </div>

        <div>
            <button type="submit" 
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-knight-600 hover:bg-knight-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-knight-500">
                Register
            </button>
        </div>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-knight-600 hover:text-knight-900">
                Already have an account? Sign in
            </a>
        </div>
    </form>
@endsection

