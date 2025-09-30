<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Patient Report Improved</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <style>
        .report-body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
/* 
        .btn {
            padding: 10px 20px;
            background-color: #458ff6;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin: 10px;
            font-size: 18px;
        } */

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
    </style>
</head>

<div class="report-body">

    <button class="report-btn" id="make-report-btn">Make Report</button>

    <div class="report-modal" id="report-modal">
        <div class="report-modal-content" id="report-area">
            <span class="close-report" id="close-report-modal">&times;</span>

            <!-- Report Start -->
            <div class="report-header">
                <div>
                    <h2>Medica <small>Application</small></h2>
                </div>
                <div class="report-logo">
                    <!-- <img src="Medica_icon_1.svg" alt="Healthcare Logo"> -->
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">

                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#0084FF" stroke="none">
                            <path d="M2079 4671 l-24 -19 -5 -601 -5 -601 -495 286 c-272 158 -507 291 -521 297 -62 24 -69 15 -309 -401 -124 -213 -226 -399 -228 -413 -2 -15 1 -36 7 -47 6 -11 240 -152 520 -313 281 -162 510 -296 510 -299 0 -3 -223 -133 -497 -290 -273 -157 -507 -295 -519 -307 -13 -12 -23 -34 -23 -49 0 -35 432 -786 468 -815 18 -14 35 -19 53 -15 14 3 252 136 529 295 277 160 505 291 507 291 1 0 3 -268 3 -595 l0 -596 25 -24 24 -25 459 0 c438 0 461 1 483 19 l24 19 5 601 5 602 511 -296 c297 -171 522 -295 537 -295 14 0 34 8 45 18 35 30 462 783 462 815 0 16 -10 37 -23 50 -12 12 -246 150 -519 307 -274 157 -497 287 -497 290 0 3 223 133 497 290 273 157 507 295 520 307 12 13 22 34 22 50 0 23 -239 452 -435 780 -21 36 -64 58 -94 48 -12 -3 -247 -137 -522 -296 -276 -159 -503 -289 -505 -289 -2 0 -4 268 -4 595 l0 596 -25 24 -24 25 -459 0 c-438 0 -461 -1 -483 -19z m831 -766 l0 -626 25 -24 c15 -16 36 -25 54 -25 22 0 183 88 553 301 287 166 529 304 538 306 10 2 24 -13 41 -44 15 -27 92 -161 172 -300 l146 -252 -507 -292 c-615 -354 -578 -331 -586 -365 -16 -64 -14 -65 497 -360 265 -153 507 -293 539 -311 l56 -33 -165 -287 c-91 -159 -171 -294 -178 -301 -10 -11 -107 41 -542 292 -575 332 -580 334 -622 280 -21 -26 -21 -35 -21 -650 l0 -624 -350 0 -350 0 0 624 c0 615 0 624 -21 650 -42 53 -47 51 -618 -279 -291 -168 -533 -305 -537 -305 -10 1 -347 585 -344 597 1 4 238 144 528 311 290 167 535 312 545 324 9 11 17 29 17 39 0 54 -16 65 -557 376 -293 170 -533 312 -533 317 0 11 318 566 335 584 11 12 106 -40 543 -292 574 -331 579 -333 621 -280 21 26 21 35 21 650 l0 624 350 0 350 0 0 -625z"/>
                        </g>
                    </svg>
                </div>
            </div>

            <!-- Patient Data -->
            <table class="report-table">
                <tr>
                    <td><b>Patient Name:</b> John Petter Alan</td>
                    <td><b>Date:</b> <span id="report-date"></span></td>
                </tr>
                <tr>
                    <td><b>Patient Age:</b> 44</td>
                    <td><b>Gender:</b> Male</td>
                </tr>
                <tr>
                    <td><b>Diagnosis Check:</b> Lung Cancer</td>
                </tr>
            </table>

            <div class="report-title">Medical Check</div>

            <!-- Report content -->
            <table class="report-table">
                <tr>
                    <td>Smoking:</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>Yellow fingers:</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>Anxiety:</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>Chronic disease:</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>Fatigue:</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>Allergy:</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>Coughing:</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>Shortness of breath:</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>Swallowing difficulty:</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>Chest pain:</td>
                    <td>No</td>
                </tr>
            </table>

            <div class="report-expected-level">
                Expected Level: High Risk
            </div>

            <div class="report-footer">
                Medica Application | www.Medica.com
            </div>

            <button id="download-pdf" class="download_report">
                <img src="adobe.png" alt="adobeicon_here">
                Download Pdf
            </button>
            <!-- Report End -->
        </div>
    </div>

</div>

</html>
