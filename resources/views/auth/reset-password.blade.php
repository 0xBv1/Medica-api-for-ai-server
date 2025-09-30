<x-auth title="Reset Password - Medica">
  
    <x-auth title="Reset Password - Medica">

        <div class="sign_container">
            <div class="sign_img">
                <img src={{ asset('assets/images/Medica_icon_1.png') }} alt="" onclick="window.location.href='{{ route('home') }}'" >
            </div>
            <h2>Reset Password</h2>
            <p>Enter your email to receive password reset instructions</p>
    
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">
    
                <div class="sign_input-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your New Password" required>
                </div>
    
                <div class="sign_input-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your New Password" required>
                </div>
    
                <button class="sign_button" type="submit">Reset Password</button>
            </form>
    
            <div class="sign_footer">
                Remembered it? <a href="{{ route('login') }}">Back to Sign In</a>
            </div>
        </div>
    
    </x-auth>
    

</x-auth>