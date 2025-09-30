<x-auth title="Sign Up - Medica">
  <div class="sign_container">
    <div class="sign_img">
      <img src="{{ asset('assets/images/Medica_icon_1.png') }}" alt="Medica Logo" onclick="window.location.href='{{ route('home') }}'">
    </div>
    <h2>Create Account</h2>

    <button class="sign_google-btn" onclick="window.location.href='{{ route('google.login') }}'">
      <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" x="0px" y="0px" viewBox="0 0 48 48"
        enable-background="new 0 0 48 48" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
                c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
                c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
                C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
                c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
        <path fill="#1976D2"
          d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571
                c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
      </svg>
      Continue with Google
    </button>
    <div class="sign_divider">Continue with</div>

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
      </ul>
    </div>
  @endif

    <form action="{{ route('register') }}" method="POST" class="sign_form">
      @csrf
      <div class="sign_input-group">
        <label for="name">User Name</label>
        <input type="text" id="name" name="name" placeholder="Please enter your Name" required>
      </div>
      <div class="sign_input-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your Email" required>
      </div>
      <div class="sign_input-group">
        <label for="password">Create Password</label>
        <div style="position: relative;">
          <input type="password" id="password" name="password" placeholder="Enter Password" required>
          <span class="sign_toggle-password" onclick="togglePassword('password', this)" title="Show/Hide Password">
            <svg id="eye-icon" stroke="currentColor" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="1em"
              width="1em" viewBox="0 0 640 512">
              <path
                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zM633.82 458.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45z" />
            </svg>
          </span>
        </div>
      </div>
      <div class="sign_input-group">
        <label for="password_confirmation">Repeat Password</label>
        <div style="position: relative;">
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat Password"
            required>
          <span class="sign_toggle-password" onclick="togglePassword('password_confirmation', this)"
            title="Show/Hide Password">
            <svg id="eye-icon" stroke="currentColor" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="1em"
              width="1em" viewBox="0 0 640 512">
              <path
                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zM633.82 458.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45z" />
            </svg>
          </span>
        </div>
      </div>
      <button class="sign_button" type="submit">Sign Up</button>
    </form>

    <div class="sign_footer">
      Already have an account? <a href="{{ route('login') }}">Log in</a> </div>

  </div>
  


      <script>
        const eyeOpenIcon = `
          <svg stroke="#0ea5e9" fill="#0ea5e9" stroke-width="0" viewBox="0 0 576 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
            <path d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"/>
          </svg>`;
      
        const eyeClosedIcon = `
          <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 640 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
            <path d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45z"/>
          </svg>`;
      
        function togglePassword(inputId, iconSpan) {
          const input = document.getElementById(inputId);
          const isHidden = input.type === "password";
          input.type = isHidden ? "text" : "password";
          iconSpan.innerHTML = isHidden ? eyeOpenIcon : eyeClosedIcon;
        }
      </script>
      
    </x-auth>