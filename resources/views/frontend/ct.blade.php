<x-cl_layout title="Cancer Treatment Recommender">

    <h1 class="Cancer_Treatment">Cancer Treatment Recommender</h1>
    <form id="patient-form" class="Treatment_card" action="" method="POST">
        @csrf
      <label for="age">Age</label>
      <input type="number" id="age" name="Age" placeholder="Please enter your age" min="0" max="120" required />
  
      <label for="gender">Gender</label>
      <select id="gender" name="Gender" required>
        <option value="" disabled selected>Select Gender</option>
        <option>Male</option>
        <option>Female</option>
      </select>
  
      <label for="cancer">Cancer Type</label>
      <!-- <input type="text" id="cancer" name="Cancer_Type" placeholder="Please enter Cancer Type" required /> -->
      <select id="Cancer Type" name="Cancer Type" required>
        <option value="" disabled selected>Select Cancer Type </option>
        <option>Brain Tumor</option>
        <option>Skin Cancer</option>
        <option>Soft Tissue Sarcoma</option>
        <option>Lung Cancer</option>
        <option>Breast Cancer</option>
        <option>Kidney Cancer</option>
        <option>Oral Cancer</option>
        <option>Thyroid Cancer</option>
        <option>Prostate Cancer</option>
        <option>Colorectal Cancer</option>
        <option>Leukemia</option>
      </select>
  
      <label for="stage">Stage</label>
      <select id="stage" name="Stage" required>
        <option value="" disabled selected>Select Stage</option>
        <option>I</option>
        <option>II</option>
        <option>III</option>
        <option>IV</option>
      </select>
      
      <label for="mutation">Gene Mutation</label>
      <!-- <input type="text" id="mutation" name="Gene_Mutation" placeholder="Please enter Gene Mutation" required /> -->
      <select id="Gene Mutation" name="Gene Mutation" required>
        <option value="" disabled selected>Select Gene Mutation</option>
        <option>APC</option>
        <option>ATM</option>
        <option>BCR-ABL1</option>
        <option>BRAF</option>
        <option>BRCA1</option>
        <option>BRCA2</option>
        <option>CDK4</option>
        <option>CDKN2A</option>
        <option>EGFR</option>
        <option>HER2</option>
        <option>IDH1</option>
        <option>JAK2</option>
        <option>KRAS</option>
        <option>MDM2</option>
        <option>MGMT</option>
        <option>NRAS</option>
        <option>PBRM1</option>
        <option>PIK3CA</option>
        <option>RET</option>
        <option>TP53</option>
        <option>VHL</option>
      </select>
  
      <button type="submit" id="make-report-btn" class="Treatment_btn">Get Recommendations</button>
    </form>
  
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
              <td><b>Patient Name:</b> <span id="report-patient-name"></span></td>
              <td><b>Date:</b> <span id="report-date"></span></td>
          </tr>
          <tr>
              <td><b>Patient Age:</b> <span id="report-age"></span></td>
              <td><b>Gender:</b> <span id="report-gender"></span></td>
          </tr>
          <tr>
              <td><b>Diagnosis Check:</b> <span id="report-cancer"></span></td>
          </tr>
        </table>

        <div class="report-title">Medical Check</div>

        <!-- Report content -->
        <table class="report-table">                
          <h3>Recommended Treatments (by expected response)</h3>
          <tr>
              <td id="report-treatment-summary"></td>
          </tr>
        </table>
        <table>
          <h3>Detailed Predictions for Top Treatment</h3>
          <tr>
              <td>-  Side Effects Prediction: <span id="report-side-effects"></span></td>
          </tr>
          <tr>
              <td>-  Predicted Survival Time (months): <span id="report-survival"></span></td>
          </tr>
          <tr>
              <td>-  Risk Assessment: <span id="report-risk"></span></td>
          </tr>
        </table>

          <div class="report-footer">
              Medica Application | www.Medica.com
          </div>

          <button id="download-pdf" class="download_btn">
              <img src="{{ asset('/../assets/images/adobe.png') }}" alt="adobeicon_here">
              Download Pdf
          </button>
          <!-- Report End -->
      </div>
  </div>

   
</x-cl_layout>