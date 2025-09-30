<x-auth title="Password Reset Sent - Medica">


    <div class="sign_container">
        <div class="sign_img">
            <img src="{{ asset('assets/images/Medica_icon_1.png') }}" alt=""
                onclick="window.location.href='{{ route('home') }}'">
        </div>
        <div class="max-w-md mx-auto p-4 bg-white shadow-xl rounded-xl text-center">
            <h2 class="text-2xl font-semibold mb-4">Check your email</h2>
            <p>We've sent a password reset link to your email address. Please check your inbox.</p>
            <a href="{{ route('login') }}" class="mt-4 inline-block text-blue-600 hover:underline">Back to Login</a>
        </div>


    </div>

    </x-layout>