p@extends('layouts.auth')

@section('title', 'Verify Email')
@section('heading', 'Verify your email')
@section('subheading', "Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you.")

@section('content')
    @if (session('message'))
        <div class="rounded-md bg-green-50 p-4 text-green-700 text-sm">
            {{ session('message') }}
        </div>
    @endif
    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full px-4 py-2 bg-knight-600 text-white rounded-md hover:bg-knight-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-knight-500">
                Resend Verification Email
            </button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2">
                Log Out
            </button>
        </form>
    </div>
@endsection


