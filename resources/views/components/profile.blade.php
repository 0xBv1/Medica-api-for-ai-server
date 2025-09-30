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
    <link rel="stylesheet" href={{ asset('/../assets/css/gpt2.css') }} />
    <!--Normalize.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- icon -->
    <link rel="icon" type="image/x-icon" href={{ asset('/../assets/images/Medica_icon_1.png') }}>
    <!-- html2pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .page-wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;

        }

        .main {
            flex-grow: 1;
            /* لملء المساحة المتبقية بين الهيدر والفوتر */
            padding: 20px;
            min-height: 100%;
            /* ضمان أن المحتوى يملأ المساحة المتاحة بين الهيدر والفوتر */
        }

        .container.wrapper {
            margin-bottom: 2.5rem;

        }

        /*######################################################*/
        .doctor_card {
            background: #fff;
            padding: 2.5rem;
            margin: auto;
            margin-top: 3%;
            border-radius: 20px;
            /*box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);*/
            max-width: 80%;
            /*text-align: center;*/
        }

        .doctor_card h1 {
            font-size: 2.8rem;
            margin-bottom: 0.5rem;
            color: #222;
        }

        .doctor_card h1 span {
            color: #1e60e7;
        }

        .doctor_card_content p {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            text-align: left;
            font-weight: normal;
        }

        .doctor_select {
            width: 20%;
            /*padding: 0.75rem;*/
            font-size: 1rem;
            border-radius: 10px;
            border: 1px solid #ccc;
            /*margin-bottom: 1.5rem;*/
            /*===> comment it */
            /*text-align: center;*/
        }

        .doctor_button {
            width: 20%;
            padding: 0.75rem 2rem;
            background-color: #458ff6;
            color: white;
            /*font-size: 1rem;*/
            font-size: 18px;
            font-weight: 500;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: auto;
            margin-top: 1rem;
        }

        .doctor_button:hover {
            background-color: #2c7ef0;
        }

        .doctor_tip {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #555;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            opacity: 0.85;
        }

        .doctor_avatar {
            width: 20%;
            /*height: 80px;*/
            border-radius: 50%;
            margin-left: 1rem;
        }

        .doctor_header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.2rem;
        }

        .doctor_header-icon {
            font-size: 2rem;
            margin-right: 0.75rem;
        }

        /*######################################################*/

        /* ضبط عرض جميع الحقول بشكل موحد */
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            /* يجعل جميع الحقول بنفس العرض */
            padding: 10px;
            font-size: 16px;
            box-sizing: border-box;
            /* يمنع التغير في الحجم بسبب الـ padding والـ border */
        }

        /* ترتيب الحقول داخل شبكة متناسقة */
        .user-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* عمودين متساويين */
            gap: 15px;
            /* مسافة بين الحقول */
        }

        /* ضبط أزرار الاختيار (Yes/No) */
        input[type="radio"] {
            margin-right: 5px;
        }

        .report-body {
            font-family: 'Segoe UI', sans-serif;
        }

        .report-btn {
            padding: 10px 20px;
            background-color: #458ff6;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin: 10px;
            font-size: 18px;
        }

        .download_report {
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

        .download_report img {
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
        /*body {
            background-color: #f8f9fa;
            font-family: 'Mulish', sans-serif;
            margin: 0;
            padding: 0;
        }*/

        .profile-container {
            max-width: 960px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .text-center {
            text-align: center;
        }

        /*.mb-3 {
            margin-bottom: 1rem;
        }*/

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .py-5 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .profile-section {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        .with-bullets{
            list-style: disc;
            padding-left: 20px; /* مهم علشان تظهر العلامة */          
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: auto;
            margin-bottom: 1rem;
        }

        .profile-upload-btn {
            display: inline-block;
            font-size: 0.875rem;
            font-weight: 400;
            color: #0d6efd;
            background-color: transparent;
            border: .09rem solid #0d6efd;
            padding: 0.375rem 0.75rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
            /*border: solid .09rem;*/
            /*border-radius: 5px;*/
        }

        .profile-upload-btn:hover {
            background-color: #0d6efd;
            color: #fff;
            transition: .5s;
            border: 1px solid #0d6efd;
        }

        .profile-upload-btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.7875rem;
        }

        /*.profile-upload-btn-outline-primary {
          background-color: transparent;
          border-color: #0d6efd;
          color: #0d6efd;
        }*/

        /*.profile-upload-btn {
          margin-top: 10px;
          border: solid .09rem;
          border-radius: 5px;
        }*/

        .profile-note {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 1rem;
        }

        .profile-section-title {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .profile-info-label {
            font-weight: 500;
            color: #333;
        }

        /* Grid system simulation */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -12px;
            margin-left: -12px;
        }

        .col-md-4,
        .col-md-8,
        .col-sm-4,
        .col-sm-8 {
            padding-right: 12px;
            padding-left: 12px;
            box-sizing: border-box;
        }

        .col-md-4 {
            width: 33.3333%;
        }

        .col-md-8 {
            width: 66.6666%;
        }

        .col-sm-4 {
            width: 33.3333%;
        }

        .col-sm-8 {
            width: 66.6666%;
        }

        @media (max-width: 768px) {

            .col-md-4,
            .col-md-8,
            .col-sm-4,
            .col-sm-8 {
                width: 100%;
            }
        }
            /* Reset & base */
    /* {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }*/

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
            /* Team Section Specifics */
            .team-section {
            background-color: #f8f9fa; /* Light grey background */
        }
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        .team-member-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            padding: 30px 25px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .team-member-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
        }
        .team-member-card img {
            width: 124px;
  height: 130px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 22px;
  border: 5px solid #fff;
  box-shadow: 0 0 15px rgba(0,0,0,0.1);
  margin-left: 29%;
  margin-right: 29%;

        }
        .team-member-card h4 {
            font-size: 1.4rem; /* 22px */
            font-weight: 700;
            color: #1f2b6c;
            margin-bottom: 8px;
        }
        .team-member-card .role {
            font-size: 0.95rem; /* 15px */
            color: #458ff6;
            margin-bottom: 15px;
            font-weight: 500;
        }
        .team-member-card .bio {
            font-size: 0.9rem; /* 14px */
            color: #7d7987;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .team-member-card .social-links a {
            color: #1f2b6c;
            margin: 0 10px;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }
        .team-member-card .social-links a:hover {
            color: #458ff6;
        }
          /* General Section Styling */
          .page-section {
            padding: 60px 0;
        }
        .title-box {
            text-align: center;
            margin-bottom: 40px;
        }
        .title-box-name {
            font-size: 2.8rem; /* 45px */
            font-weight: 700;
            color: #000; /* As per .services .title-box-name */
            margin-bottom: 15px;
            line-height: 1.2;
        }
        .title-separator {
            width: 56px;
            height: 2px;
            background-color: #000;
            margin: 0 auto 25px auto;
            border-radius: 5px;
        }
        .text, .title-box-text {
            font-size: 1.1rem; /* 18px */
            line-height: 1.7;
            color: #7d7987; /* As per .services .title-box-text */
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .content-section h2 {
             font-size: 2rem; /* Slightly smaller for sub-sections */
             font-weight: 700;
             color: #1f2b6c;
             margin-bottom: 10px;
             text-align: left;
        }
        .content-section .title-separator {
            margin: 0 0 20px 0; /* Align left */
            background-color: #458ff6;
            height: 3px;
        }
        .content-section p {
            text-align: left;
            color: #7d7987;
            font-size: 1rem;
            line-height: 1.8;
        }

        .page-wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .main {
            flex-grow: 1;
            padding: 20px 0; /* Adjusted padding */
        }

        .container {
             width: 100%;
             padding-right: 15px;
             padding-left: 15px;
             margin-right: auto;
             margin-left: auto;
        }
        @media (min-width: 576px) { .container { max-width: 540px; } }
        @media (min-width: 768px) { .container { max-width: 720px; } }
        @media (min-width: 992px) { .container { max-width: 960px; } }
        @media (min-width: 1200px) { .container { max-width: 1140px; } }
/* modern_profile_styles.css */

/* --- Google Font Import --- */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

/* --- CSS Variables --- */
:root {
    --primary-color: #4A90E2; /* Modern Blue */
    --secondary-color: #50E3C2; /* Teal Accent */
    --accent-color: #F2C94C; /* Yellow Accent for attention */
    --background-color: #F4F7F6; /* Light Gray */
    --card-background-color: #FFFFFF;
    --text-color: #333333;
    --text-light-color: #555555;
    --border-color: #DDE2E1;
    --shadow-color: rgba(0, 0, 0, 0.1);
    --font-family-main: 'Poppins', sans-serif;
    --border-radius-small: 4px;
    --border-radius-medium: 8px;
    --border-radius-large: 12px;
    --spacing-unit: 8px;
}

/* --- General Styles --- */
body {
    font-family: var(--font-family-main);
    background-color: var(--background-color);
    color: var(--text-color);
    line-height: 1.6;
    margin: 0;
    padding: 0;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.profile-container {
    max-width: 1000px;
    margin: calc(var(--spacing-unit) * 4) auto;
    padding: calc(var(--spacing-unit) * 2);
    width: 90%;
}

h1, h2, h3, h4, h5, h6 {
    font-weight: 600;
    color: var(--primary-color);
    margin-top: 0;
    margin-bottom: calc(var(--spacing-unit) * 2);
}

h2.text-center {
    color: var(--text-color); /* Override for specific heading */
}

/* --- Profile Section Modernization --- */
.profile-section {
    background-color: var(--card-background-color);
    padding: calc(var(--spacing-unit) * 3);
    border-radius: var(--border-radius-large);
    box-shadow: 0 4px 12px var(--shadow-color);
    margin-bottom: calc(var(--spacing-unit) * 4);
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.profile-section:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
}

.profile-section-title {
    font-size: 1.5rem; /* Increased size */
    font-weight: 600; /* Semibold */
    color: var(--primary-color);
    margin-bottom: calc(var(--spacing-unit) * 2.5);
    padding-bottom: var(--spacing-unit);
    border-bottom: 2px solid var(--secondary-color);
    display: inline-block; /* To make border only as long as text */
}

/* --- Profile Image --- */
.profile-img {
    width: 150px; /* Slightly larger */
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto calc(var(--spacing-unit) * 2) auto; /* Centered */
    border: 4px solid var(--secondary-color);
    box-shadow: 0 2px 8px var(--shadow-color);
}

/* --- Button Unification & Modernization --- */
.btn-modern { /* Base class for all modern buttons */
    display: inline-block;
    font-family: var(--font-family-main);
    font-weight: 500;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: calc(var(--spacing-unit) * 1.25) calc(var(--spacing-unit) * 2.5); /* 10px 20px */
    font-size: 1rem; /* 16px */
    border-radius: var(--border-radius-medium);
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    text-decoration: none; /* Remove underline from <a> tags styled as buttons */
}

.btn-modern-primary {
    color: #fff;
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-modern-primary:hover {
    background-color: #3a7bc8; /* Darker shade of primary */
    border-color: #3a7bc8;
    box-shadow: 0 2px 8px rgba(74, 144, 226, 0.4);
}

.btn-modern-secondary {
    color: var(--primary-color);
    background-color: transparent;
    border-color: var(--primary-color);
}

.btn-modern-secondary:hover {
    color: #fff;
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-modern-accent {
    color: var(--text-color);
    background-color: var(--accent-color);
    border-color: var(--accent-color);
}

.btn-modern-accent:hover {
    background-color: #e0b840; /* Darker shade of accent */
    border-color: #e0b840;
    box-shadow: 0 2px 8px rgba(242, 201, 76, 0.4);
}

/* Apply to existing buttons - map old classes or replace in HTML */
.profile-upload-btn { /* Replace with .btn-modern .btn-modern-secondary */
    /* For now, let's just re-style it */
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--primary-color);
    background-color: transparent;
    border: 1px solid var(--primary-color);
    padding: calc(var(--spacing-unit) * 0.75) calc(var(--spacing-unit) * 1.5);
    border-radius: var(--border-radius-medium);
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: var(--spacing-unit);
}

.profile-upload-btn:hover {
    background-color: var(--primary-color);
    color: #fff;
}

.doctor_button, .Treatment_btn, .report-btn { /* Grouping similar buttons */
    /* These should ideally use .btn-modern .btn-modern-primary */
    padding: calc(var(--spacing-unit) * 1.25) calc(var(--spacing-unit) * 3);
    background-color: var(--primary-color);
    color: white;
    font-size: 1rem;
    font-weight: 500;
    border: none;
    border-radius: var(--border-radius-medium);
    cursor: pointer;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    display: block; /* Or inline-block depending on context */
    margin: var(--spacing-unit) auto; /* Example, adjust as needed */
    text-align: center;
}

.doctor_button:hover, .Treatment_btn:hover, .report-btn:hover {
    background-color: #3a7bc8; /* Darker primary */
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.download_report {
    /* This button has an icon, style accordingly */
    padding: calc(var(--spacing-unit) * 1.25) calc(var(--spacing-unit) * 2);
    background-color: var(--background-color);
    color: var(--text-color);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-medium);
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: var(--spacing-unit);
    margin: calc(var(--spacing-unit) * 3) auto;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.download_report:hover {
    background-color: #e8ebea;
    border-color: #c8cccb;
}

.download_report img {
    width: 1.5rem; /* Adjust as needed */
    height: 1.5rem;
}


/* --- Profile Info --- */
.profile-info-label {
    font-weight: 600; /* Semibold */
    color: var(--text-light-color);
    margin-bottom: calc(var(--spacing-unit) * 0.5); /* Add some space below label */
}

.profile-section .row .col-sm-8 { /* Value part */
    color: var(--text-color);
    font-weight: 400;
}

.profile-section .row.mb-3 {
    margin-bottom: calc(var(--spacing-unit) * 2) !important; /* Standardize margin */
    padding-bottom: calc(var(--spacing-unit) * 2);
    border-bottom: 1px dashed var(--border-color); /* Subtle separator */
}
.profile-section .row.mb-3:last-child {
    border-bottom: none; /* No border for the last item */
    margin-bottom: 0 !important;
    padding-bottom: 0;
}


/* --- Form Elements Modernization --- */
input[type="text"],
input[type="number"],
input[type="email"],
input[type="password"],
select,
textarea {
    width: 100%;
    padding: calc(var(--spacing-unit) * 1.5); /* 12px */
    font-size: 1rem; /* 16px */
    font-family: var(--font-family-main);
    color: var(--text-color);
    background-color: #fff; /* Ensure background is white */
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-medium);
    box-sizing: border-box;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

input[type="text"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
select:focus,
textarea:focus {
    border-color: var(--primary-color);
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25); /* Primary color focus ring */
}

select {
    appearance: none; /* Remove default arrow */
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23333333' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(var(--spacing-unit) * 1.5) center; /* Position arrow */
    background-size: 1em;
    padding-right: calc(var(--spacing-unit) * 4); /* Space for arrow */
}

/* --- Lists Modernization (Smart Suggestions, Platform Activity) --- */
.profile-section ul.with-bullets {
    list-style: none; /* Remove default bullets */
    padding-left: 0;
    margin-top: var(--spacing-unit);
}

.profile-section ul.with-bullets li {
    padding: calc(var(--spacing-unit) * 1.5) 0; /* Add padding */
    padding-left: calc(var(--spacing-unit) * 3.5); /* Space for custom icon */
    position: relative;
    font-size: 1rem;
    color: var(--text-light-color);
    border-bottom: 1px solid var(--border-color); /* Separator */
}

.profile-section ul.with-bullets li:last-child {
    border-bottom: none; /* No border for the last item */
}

.profile-section ul.with-bullets li::before {
    content: '\2713'; /* Checkmark icon (Unicode) or use FontAwesome */
    position: absolute;
    left: var(--spacing-unit);
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary-color); /* Teal accent for icon */
    font-weight: bold;
    font-size: 1.2rem;
}

/* --- Table Modernization (Predictions History) --- */
.table-responsive {
    margin-top: calc(var(--spacing-unit) * 2);
    overflow-x: auto; /* Ensure horizontal scroll on small screens */
}

.table {
    width: 100%;
    margin-bottom: var(--spacing-unit);
    color: var(--text-color);
    border-collapse: collapse; /* Cleaner look */
}

.table th,
.table td {
    padding: calc(var(--spacing-unit) * 1.5); /* 12px */
    vertical-align: top;
    border-top: 1px solid var(--border-color);
    text-align: left; /* Align text left by default */
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid var(--primary-color); /* Stronger header underline */
    background-color: #E9F1FA; /* Light blue background for header */
    color: var(--primary-color);
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase; /* Uppercase headers */
    letter-spacing: 0.5px;
}

.table tbody tr:nth-of-type(odd) {
    background-color: rgba(74, 144, 226, 0.04); /* Subtle striping for odd rows */
}

.table tbody tr:hover {
    background-color: rgba(74, 144, 226, 0.08); /* Hover effect */
}

.table-bordered th,
.table-bordered td {
    border: 1px solid var(--border-color);
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.03);
}

/* --- Card Modernization (doctor_card, Treatment_card) --- */
.doctor_card, .Treatment_card {
    background-color: var(--card-background-color);
    padding: calc(var(--spacing-unit) * 3.5);
    margin: calc(var(--spacing-unit) * 4) auto;
    border-radius: var(--border-radius-large);
    box-shadow: 0 5px 15px var(--shadow-color);
    max-width: 800px;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.doctor_card:hover, .Treatment_card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.doctor_card h1, .Treatment_card .Cancer_Treatment {
    font-size: 1.8rem;
    color: var(--primary-color);
    margin-bottom: calc(var(--spacing-unit) * 2.5);
    text-align: center;
}

.doctor_card h1 span {
    color: var(--secondary-color);
}

.Treatment_card label {
    display: block;
    margin-bottom: var(--spacing-unit);
    font-weight: 500;
    color: var(--text-light-color);
}

/* --- Responsiveness --- */
@media (max-width: 768px) {
    .profile-container {
        margin: calc(var(--spacing-unit) * 2) auto;
        padding: var(--spacing-unit);
    }

    .profile-section {
        padding: calc(var(--spacing-unit) * 2);
    }

    .profile-img {
        width: 120px;
        height: 120px;
    }

    .profile-section .row, .user-details {
        flex-direction: column;
    }

    .profile-section .row [class*="col-"], .user-details > div {
        width: 100% !important;
        margin-bottom: calc(var(--spacing-unit) * 2);
    }
    .profile-section .row [class*="col-"]:last-child, .user-details > div:last-child {
        margin-bottom: 0;
    }

    .doctor_card, .Treatment_card {
        padding: calc(var(--spacing-unit) * 2.5);
        margin: calc(var(--spacing-unit) * 2) auto;
    }

    .doctor_button, .Treatment_btn, .report-btn {
        width: 100%;
        padding: calc(var(--spacing-unit) * 1.5) calc(var(--spacing-unit) * 2);
    }

    .table thead {
        display: none;
    }
    .table, .table tbody, .table tr, .table td {
        display: block;
        width: 100%;
    }
    .table tr {
        margin-bottom: var(--spacing-unit);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-medium);
    }
    .table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
        border-top: none;
        border-bottom: 1px solid var(--border-color);
    }
    .table td:last-child {
        border-bottom: none;
    }
    .table td::before {
        content: attr(data-label);
        position: absolute;
        left: var(--spacing-unit);
        width: calc(50% - var(--spacing-unit) * 2);
        padding-right: var(--spacing-unit);
        font-weight: 600;
        text-align: left;
        color: var(--primary-color);
    }
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
                                    <a href="{{route('home')}}" class="nav-link nav-active text-white text-nowrap">Home</a>
                
                                </li>
                                <li class="nav-item">
                                    <a href="Check.php" class="nav-link text-white text-nowrap">Health Check</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('Cancer_Treatment_Recommender')}}" class="nav-link text-white text-nowrap">Cancer Treatment Recommender</a>
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

</body>

</html>