@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center">Sign Up</h2>

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf

        <!-- Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name') }}" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required
            />
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Field -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required
            />
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Field -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required
            />
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password Field -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required
            />
            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Role Selection -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <div class="mt-2 space-y-2">
                <label class="inline-flex items-center">
                    <input 
                        type="radio" 
                        name="role" 
                        value="admin" 
                        class="text-indigo-600 border-gray-300 focus:ring-indigo-500" 
                        {{ old('role') === 'admin' ? 'checked' : '' }}
                        required
                    />
                    <span class="ml-2 text-gray-700">Admin</span>
                </label>
                <label class="inline-flex items-center">
                    <input 
                        type="radio" 
                        name="role" 
                        value="kasir" 
                        class="text-indigo-600 border-gray-300 focus:ring-indigo-500" 
                        {{ old('role') === 'kasir' ? 'checked' : '' }}
                        required
                    />
                    <span class="ml-2 text-gray-700">Kasir</span>
                </label>
            </div>
            @error('role')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button 
                type="submit" 
                class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                Create User
            </button>
        </div>
    </form>
</div>
@endsection
