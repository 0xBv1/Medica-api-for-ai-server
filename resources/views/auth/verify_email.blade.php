<x-auth title="Email Verification - Medica">
<div class="sign_container">
    <div class="sign_img">
      <img src="{{ asset('assets/images/Medica_icon_1.png') }}" alt="" onclick="window.location.href='{{ route('home') }}'">
    </div>
    <h2>Email Verification</h2>
    <p>We’ve sent a verification link to your email address. Please check your inbox and verify your account.</p>

    @if (session('status') == 'verification-link-sent')
      <p style="color: green; text-align:center; font-size: 14px;">A new verification link has been sent to your email.</p>
    @endif

    <form method="POST" action="{{ route('verification.resend') }}">
              @csrf
      <button class="sign_button" type="submit">Resend Verification Email</button>
    </form>

    <div class="sign_footer">
      Already verified? <a href="{{ route('home') }}">Go to Homepage</a>
    </div>
  </div>
</x-auth>