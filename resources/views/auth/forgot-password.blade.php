@extends('layouts.auth')

@section('title', 'Forgot Password')
@section('heading', 'Forgot your password?')
@section('subheading', 'No problem. Enter your email and we’ll send a reset link.')

@section('content')
    @if (session('status'))
        <div class="rounded-md bg-green-50 p-4 text-green-700 text-sm">
            {{ session('status') }}
        </div>
    @endif
    <form class="mt-8 space-y-6" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
            <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}"
                class="mt-1 block w-full px-3 py-2 border-2 border-gray-300 rounded-md focus:border-knight-500 focus:ring-knight-500">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit"
                class="w-full px-4 py-2 bg-knight-600 text-white rounded-md hover:bg-knight-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-knight-500">
                Email Password Reset Link
            </button>
        </div>
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-knight-600 hover:text-knight-900">Back to sign in</a>
        </div>
    </form>
@endsection


