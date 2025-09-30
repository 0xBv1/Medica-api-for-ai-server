<x-layout title="Contact Us">

    <div class="contact_us_container">
        <div class="contact_us_left">
            <h1><span>Not sure where to start?</span><br><strong class="contact_us_highlight">We’re here to
                    help.</strong></h1>
            <div class="contact_us_info">
                <svg class="clock_svg" width="84" height="81" viewBox="0 0 84 81" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M42.0026 0.0532227C19.0859 0.0532227 0.335938 18.1718 0.335938 40.3167C0.335938 62.4615 19.0859 80.5801 42.0026 80.5801C64.9193 80.5801 83.6693 62.4615 83.6693 40.3167C83.6693 18.1718 64.9193 0.0532227 42.0026 0.0532227ZM59.5026 57.2273L37.8359 44.343V20.1849H44.0859V41.1219L62.8359 51.993L59.5026 57.2273Z"
                        fill="#201E3A"></path>
                </svg>
                <p>Leave your details, and the Medica team will get back to you within 24 hours with personalized
                    support and accurate AI-powered medical analysis.</p>
            </div>
        </div>
        <div class="contact_us_right">

            <form id="contact_us_quote-form" method="POST" action="{{route('contact_us')}}" 
            >
                @csrf
                <input type="text" name="name" placeholder="Enter your name" required maxlength="255">

                <input type="email" name="email" placeholder="Enter your work mail address" required maxlength="255">

                <input type="tel" name="phone" placeholder="Enter your phone number" required pattern="^[0-9]{11}$"
                    title="Phone number must be exactly 11 digits">

                <input type="hidden" name="hp" value="">

                <textarea name="message" placeholder="Explain your problem here." rows="6" required
                    maxlength="2000"></textarea>

                <button type="submit">Send to us</button>
            </form>


        </div>
    </div>




    <script src={{ asset('assets/js/contactus.js') }}></script>

</x-layout>