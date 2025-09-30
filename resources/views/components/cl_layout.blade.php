<!DOCTYPE html>

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
    <link rel="stylesheet" href={{ asset('/../assets/css/main.css') }} />
    <link rel="stylesheet" href={{ asset('/../assets/css/utilities.css') }} />
    <!--Normalize.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- icon -->
    <link rel="icon" type="image/x-icon" href={{ asset('/../assets/images/Medica_icon_1.png') }}>
    <!-- html2pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <style>
        /* Reset & base */
            {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #3a4e70;
            /*display: flex;
      flex-direction: column;*/
            align-items: center;
            /*padding: 2rem;*/
            transition: all 0.3s ease;
        }

        .Cancer_Treatment {
            margin-bottom: 2rem;
            font-size: 3rem;
            color: #1f3552;
            font-weight: bold;
            text-align: center;
            transition: all 0.3s ease;
        }

        /* Form Card */
        .Treatment_card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            max-width: 900px;
            width: 100%;
            margin-bottom: 2rem;
            animation: fadeIn 0.8s ease-in;
            /*border: 1px solid #d1d8e0;*/
            margin: auto;
        }

        .Treatment_card label {
            display: block;
            margin-bottom: .5rem;
            font-weight: 600;
            color: #1d3557;
        }

        .Treatment_card input,
        .Treatment_card select {
            width: 100%;
            padding: .75rem;
            margin-bottom: 1.25rem;
            /*font-size: 14px;*/
            border: 1px solid #d1d8e0;
            border-radius: .5rem;
            transition: border-color .3s, box-shadow .3s ease;
        }

        .Treatment_card select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") no-repeat right 1rem center/1rem 1rem;
            cursor: pointer;
        }

        .Treatment_card input:focus,
        .Treatment_card select:focus {
            color: #212529;
            background-color: #fff;
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
        }

        .Treatment_btn {
            display: inline-block;
            padding: .75rem 1.5rem;
            background-color: #458ff6;
            color: #fff;
            border: none;
            border-radius: .75rem;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
            ;
            width: 100%;
            text-align: center;
        }

        .Treatment_btn:hover {
            background: #2c7ef0;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .Cancer_Treatment {
                font-size: 2.5rem;
            }

            .Treatment_card {
                padding: 2rem;
            }

            .Treatment_btn {
                width: 100%;
            }
        }

        1body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .btn {
            padding: 10px 20px;
            background-color: #458ff6;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin: 10px;
            font-size: 18px;
        }

        .download_btn {
            margin: 10px auto;
            margin-top: 40px;
            padding: 10px 20px;
            background-color: #F2F2F2;
            color: #000;
            border: 1px solid #A6A6A6;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .download_btn img {
            width: 1.7rem;
        }

        .report-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .report-modal-content {
            background: white;
            padding: 40px 30px;
            border-radius: 10px;
            max-width: 700px;
            width: 80%;
            margin: 0 auto;
            position: relative;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .close-report {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 26px;
            cursor: pointer;
            color: #888;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .report-header h2 {
            color: #458ff6;
        }

        .report-header small {
            color: gray;
            font-size: 20px;
        }

        .report-logo svg {
            width: 60px;
            height: 60px;
        }

        .report-title {
            color: #4a4a4a;
            font-size: 18px;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        .report-table {
            width: 100%;
            font-size: 16px;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .report-table td {
            padding: 8px 4px;
            vertical-align: top;
        }

        .report-expected-level {
            margin-top: 20px;
            background: #f9f9f9;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            font-size: 20px;
            color: #e63946;
            font-weight: bold;
            border: 2px solid #ddd;
        }

        .report-footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #aaa;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <!-- header -->
        <header class="header" style="min-height: 15vh;"> <!-- هنا الإرتفاع ده 21 وهمى-->
            <nav class="navbar" style="padding: 35px 0 35px 0;">
                <div class="container">
                    <div class="navbar-content d-flex justify-content-between align-items-center">
                        <div class="brand-and-toggler d-flex align-items-center justify-content-between">
                            <a href="../../" class="navbar-brand d-flex align-items-center">
                                <span><img src={{ asset('/../assets/images/Medica_icon_2.png') }} alt=""
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
                                <!-- Home with dropdown menu -->
                                <li class="nav-item position-relative">
                                    <a href="{{route('home')}}" class="nav-link  text-white text-nowrap">Home</a>
                
                                </li>
                                <li class="nav-item">
                                    <a href="Check.php" class="nav-link text-white text-nowrap">Health Check</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('Cancer_Treatment_Recommender')}}" class="nav-link nav-active text-white text-nowrap">Cancer Treatment Recommender</a>
                                </li>
                                <li class="nav-item">
                                {{-- contact_us --}}
                                    <a href="{{route('contact_us')}}" class="nav-link text-white text-nowrap">Contact Us</a>
                                </li>
                                <li class="nav-item">
                                    {{-- contact_us --}}
                                        <a href="{{route('about_us')}}" class="nav-link text-white text-nowrap">About Us</a>
                                    </li>
                                <li class="nav-item position-relative">
                                    @if(Auth::check())
                                        <div class="avatar-wrapper d-flex align-items-center justify-content-center" onclick="toggleUserMenu()">
                                            <img src="https://i.pravatar.cc/150?img=12" class="user-avatar">
                                            <div class="user-dropdown" id="userMenu">
                                                <a href="{{route('profile')}}">Profile</a>
                                                <a href="{{route('logout')}}">Logout</a>
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ route('login') }}" class="nav-link text-white text-nowrap me-3 d-flex align-items-center">
                                            Sign In |
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="1em" viewBox="0 0 448 512" style="margin-left: 6px;" width="1em">
                                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zM313.6 288h-16.7c-22.2 10.3-46.7 16-72.9 16s-50.7-5.7-72.9-16h-16.7C78.8 288 0 366.8 0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48 0-97.2-78.8-176-174.4-176z"/>
                                            </svg>
                                        </a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="pulse_Animate chatbox__button">
                <div class="pulse">
                    <img src={{ asset('/../assets/images/chatbot.png') }} alt="">
                    <span style="--i:0;"></span>
                </div>
            </div>
        </header>
        <!-- end of header -->
        <div class="container">
            <div class="chatbox">
                <div class="chatbox__support">
                    <div class="chatbox__header">
                        <div class="chatbox__image--header">
                            <img src="https://img.icons8.com/color/48/000000/circled-user-male-skin-type-5--v1.png"
                                alt="image">
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


        {{ $slot}}
    </div>
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
            <img src={{ asset('/../assets/images/element-img-4.png') }} alt="">
        </div>
        <div class="footer-element-2">
            <img src={{ asset('/../assets/images/element-img-5.png') }} alt="">
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
    <script src={{ asset('assets/js/scroll.js') }}></script>
    <!-- chatbot js -->
    <script src={{ asset('assets/js/chatbot.js')}}></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- chatbot js -->
    <!-- <script src={{ asset('assets/js/uploader.js') }}"></script> -->
    <!-- ajax upload img.js -->
    <script src={{ asset('assets/js/startbtn.js') }}></script>
    <script>
        const userMenu = document.getElementById('userMenu');
        const avatarWrapper = document.querySelector('.avatar-wrapper');

        function toggleUserMenu() {
            const isVisible = userMenu.style.display === 'block';
            userMenu.style.display = isVisible ? 'none' : 'block';
        }

        document.addEventListener('click', function (event) {
            if (!avatarWrapper.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.style.display = 'none';
            }
        });
    </script>
    <script>

        document.getElementById("patient-form").addEventListener("submit", async function (e) {
            e.preventDefault();
            console.log("Form submitted");
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            const age = parseInt(document.getElementById("age").value);
            const gender = document.getElementById("gender").value;
            const cancer = document.getElementById("Cancer Type").value;
            const stage = document.getElementById("stage").value;
            const mutation = document.getElementById("Gene Mutation").value;

            // Basic JS Validation
            if (isNaN(age) || age < 0 || age > 120) {
                alert("Please enter a valid age between 0 and 120.");
                return;
            }
            if (!gender || !cancer || !stage || !mutation) {
                alert("All fields are required.");
                return;
            }

            // If validation passes, send to PHP controller
            const formData = new FormData();
            formData.append("Age", age);
            formData.append("Gender", gender);
            formData.append("Cancer_Type", cancer);
            formData.append("Stage", stage);
            formData.append("Gene_Mutation", mutation);
            formData.append("_token", csrfToken);

            try {
                console.log("Sending data to server...");
                // Send data to server
                console.log(formData);
                const response = await fetch("{{route('ct.predict')}}", {
                    method: "POST",
                    body: formData

                });

                const result = await response.json();

                if (result.error) {
                    alert("Server Error: " + result.error);
                } else {
                    const data = result.prediction_details;
                    console.log(data);

                    document.getElementById('report-patient-name').innerText = data.patient_name;
                    document.getElementById('report-date').innerText = data.date;
                    document.getElementById('report-age').innerText = data.age;
                    document.getElementById('report-gender').innerText = data.gender;
                    document.getElementById('report-cancer').innerText = data.cancer_type;

                    document.getElementById('report-treatment-summary').innerText =
                        `- ${data.treatment} | Expected Response: ${data.expected_response} | Probability: ${data.response_prob}`;

                    document.getElementById('report-side-effects').innerText = data.side_effects;
                    document.getElementById('report-survival').innerText = data.survival_months;
                    document.getElementById('report-risk').innerText = data.risk;

                    // Show modal
                    document.getElementById('report-modal').style.display = 'flex';
                    // Close report button
                    document.getElementById('close-report-modal').addEventListener('click', () => {
                        document.getElementById('report-modal').style.display = 'none';
                    });

                    // Download pdf button
                    document.getElementById('download-pdf').addEventListener('click', () => {
                        const element = document.getElementById('report-area');
                        const downloadBtn = document.getElementById('download-pdf');
                        const closeBtn = document.getElementById('close-report-modal');

                        downloadBtn.style.display = 'none';
                        closeBtn.style.display = 'none';

                        const opt = {
                            margin: 0,
                            filename: 'Patient_Report.pdf',
                            image: { type: 'jpeg', quality: 1 },
                            html2canvas: { scale: 4, useCORS: true },
                            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                        };

                        html2pdf()
                            .set(opt)
                            .from(element)
                            .save()
                            .then(() => {
                                downloadBtn.style.display = 'flex';
                                closeBtn.style.display = 'block';
                            })
                            .catch((error) => {
                                console.error('Error generating PDF:', error);
                                downloadBtn.style.display = 'flex';
                                closeBtn.style.display = 'block';
                            });
                    });
                }

            } catch (err) {
                console.error(err);
                alert("Failed to contact server.");
            }
        });


    </script>
</body>

</html>