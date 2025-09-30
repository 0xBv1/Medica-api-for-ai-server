<x-auth title="Forgot Password - Medica">
    <div class="sign_container">
        <div class="sign_img">
            <img src="{{ asset('assets/images/Medica_icon_1.png') }}" alt=""
                onclick="window.location.href='{{ route('home') }}'">
        </div>
        <h2>Forgot Your Password?</h2>
        <p>Enter your email to receive password reset instructions</p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="sign_input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your Email" required>
                @error('email')
                    <small style="color: red">{{ $message }}</small>
                @enderror
            </div>

            <button class="sign_button" type="submit">Send Reset Link</button>
        </form>

        <div class="sign_footer">
            Remembered it? <a href="{{ route('login') }}">Back to Sign In</a>
        </div>
    </div>
</x-auth>
