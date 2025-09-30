<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css -->
    <link rel="stylesheet" href={{ asset('assets/css/main.css') }} />
    <link rel="stylesheet" href={{ asset('assets/css/utilities.css') }} />
    <link rel="stylesheet" href={{ asset('assets/css/gpt2.css') }} />
    <link rel="stylesheet" href={{ asset('assets/css/article.css') }} />
    <!-- normalize.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- icon -->
    <link rel="icon" type="image/x-icon" href={{ asset('assets/images/Medica_icon_1.png') }}>
</head>

<body>
    <div class="page-wrapper">
        <!-- Start of header -->
  
        <header class="header" style="min-height: 15vh;"> 
            <nav class="navbar" style="padding: 35px 0 35px 0;">
                <div class="container">
                    <div class="navbar-content d-flex justify-content-between align-items-center">
                        <div class="brand-and-toggler d-flex align-items-center justify-content-between">
                            <a href="../../" class="navbar-brand d-flex align-items-center">
                                <span><img src={{ asset('assets/images/Medica_icon_2.png') }} alt=""
                                        style="width: 45px;"></span>
                                <span class="brand-text fw-7">Medica</span>
                            </a>
                            <button type="button" class="d-none navbar-show-btn">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                        <div class="navbar-box">
                            <button type="button" class="navbar-hide-btn">
                                <i class="fas fa-times"></i>
                            </button>
                            <ul class="navbar-nav d-flex align-items-center">
                                <li class="nav-item">
                                    <a href="/" class="nav-link text-white text-nowrap">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/#Cancerous_diseases"
                                        class="nav-link text-white text-nowrap">Cancers</a>
                                </li>
                                <li class="nav-item">
                                    <a href="Check.php" class="nav-link text-white nav-active text-nowrap">Check</a>
                                </li>
                                <li class="nav-item">
                                    <a href=" /#mobile_app" class="nav-link text-white text-nowrap">Mobile
                                        App</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/#about_section" class="nav-link text-white text-nowrap">About
                                        us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="pulse_Animate chatbox__button">
                <div class="pulse">
                    <img src={{ asset('assets/images/chatbot.png') }} alt="">
                    <!--style="float: left; position:fixed;"-->
                    <span style="--i:0;"></span>
                </div>
            </div>
        </header>
        <!-- End of header -->

        <!--####################################################################################################-->
        <!-- aout chatbot -->
        <div class="container">
            <div class="chatbox">
                <div class="chatbox__support">
                    <div class="chatbox__header">
                        <div class="chatbox__image--header">
                            <img src="https://img.icons8.com/color/48/000000/circled-user-male-skin-type-5--v1.png" alt="image">
                        </div>
                        <div class="chatbox__content--header">
                            <h4 class="chatbox__heading--header">Chat support</h4>
                            <p class="chatbox__description--header">Hi. My name is Sam. How can I help you?</p>
                        </div>
                    </div>
                    <div class="chatbox__messages">
                        <div></div>
                    </div>
                    <!-- Footer -->
                    <div class="chatbox__footer">
                        <input type="text" class="chatbox__input" placeholder="Write a message...">
                        <button class="send__button">
                            <i class="fa fa-microphone"></i> <!-- أيقونة الميكروفون -->
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- End Chatboot -->
        <!--####################################################################################################-->
        {{$slot}}
        <!-- Start of footer -->
<!-- Start of footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-list d-grid text-white">
                <div class="footer-item">
                    <a href="" class="navbar-brand d-flex align-items-center">
                        <span><img src={{ asset('assets/images/Medica_icon_2.png') }} alt=""
                                style="width: 45px;"></span>
                        <span class="brand-text fw-7">Medica</span>
                    </a>
                    <p class="text-white">Medica provides progressive, and affordable healthcare, accessible
                        on
                        mobile and online for everyone</p>
                    <p class="text-white copyright-text">&copy; Medica PTY LTD 2024. All rights reserved.
                    </p>
                </div>

                <div class="footer-item">
                    <h3 class="footer-item-title">Company</h3>
                    <ul class="footer-links">
                        <li><a href=" #about_section">About</a></li>
                        <li><a href="#">Find a doctor</a></li>
                        <li><a href=" #mobile_app">mobile app</a></li>
                    </ul>
                </div>

                <div class="footer-item">
                    <h3 class="footer-item-title">Region</h3>
                    <ul class="footer-links">
                        <li><a href="#">Germany</a></li>
                        <li><a href="#">USA</a></li>
                        <li><a href="#">Hongkong</a></li>
                        <li><a href="#">Canada</a></li>
                    </ul>
                </div>

                <div class="footer-item">
                    <h3 class="footer-item-title">Help</h3>
                    <ul class="footer-links">
                        <li><a href="#">Help center</a></li>
                        <li><a href="#">Contact support</a></li>
                        <li><a href="#">Instructions</a></li>
                        <li><a href="#">How it works</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-element-1">
        <img src={{ asset('assets/images/element-img-4.png') }} alt="">
    </div>
    <div class="footer-element-2">
        <img src={{ asset('assets/images/element-img-5.png') }} alt="">
    </div>
</footer>
<!-- End of footer -->



<!-- jquery cdn -->
<script src="https://code.jquery.com/jquery-3.6.4.js"
    integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<!-- owl carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- custom js -->
<script src={{ asset('assets/js/script.js') }}></script>
<!-- scroll js -->
<!-- <script src={{ asset('assets/js/scroll.js') }}
"></script> -->
<!-- chatbot js -->
<script src={{ asset('assets/js/chatbot.js') }}></script>
<!-- chatbot js -->
{{-- <-- <script src={{ asset('assets/js/uploader.js') }}  --}}



<script src="{{ asset('assets/js/startbtn.js') }}"></script>
</body>

</html>