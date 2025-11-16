@extends('layouts.auth')

@section('title', 'Reset Password')
@section('heading', 'Reset your password')

@section('content')
    <form class="mt-8 space-y-6" method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
            <input id="email" name="email" type="email" required value="{{ old('email', $request->email) }}"
                class="mt-1 block w-full px-3 py-2 border-2 border-gray-300 rounded-md focus:border-knight-500 focus:ring-knight-500">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">New password</label>
            <input id="password" name="password" type="password" required
                class="mt-1 block w-full px-3 py-2 border-2 border-gray-300 rounded-md focus:border-knight-500 focus:ring-knight-500">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                class="mt-1 block w-full px-3 py-2 border-2 border-gray-300 rounded-md focus:border-knight-500 focus:ring-knight-500">
        </div>
        <div>
            <button type="submit"
                class="w-full px-4 py-2 bg-knight-600 text-white rounded-md hover:bg-knight-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-knight-500">
                Reset Password
            </button>
        </div>
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-knight-600 hover:text-knight-900">Back to sign in</a>
        </div>
    </form>
@endsection


