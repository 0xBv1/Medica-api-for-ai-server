<x-layout title="Cancer Check">

    <main>
        
        <div class="doctor_card">

            <div class="doctor_header">
                <div class="doctor_header-icon"></div>
                <div class="doctor_card_content">
                    <h1><img src="{{ asset('/../assets/images/beaker.png') }}" alt="test tube"
                            style="vertical-align: middle;width: 12%;display: inline-block;"> Let's start your
                        <span style="display:block;">smart cancer check</span>
                        <p>Please select the type of cancer you want to check for. <br> Our AI will help you
                            with a quick pre-check.</p>
                    </h1>
                </div>
                <img src="{{ asset('/../assets/images/Doctor.png') }}" alt="Doctor" class="doctor_avatar" />
                
            </div>

            <!-- ######################################################################################################################## -->
            <div class="option-list">
                <div class="select-box">

                    <select id="option-selector">
                        <option value="">Choose Cancer</option>
                        <option value="option1">Brain Tuomer </option>
                        <option value="option2">Skin Caner </option>
                        <option value="option3">Histopathologic</option>
                        <option value="option4">Lung Caner </option>
                        <option value="option5">Breast Caner  </option>
                        <option value="option6">Kidney Caner </option>
                        <option value="option7">Oral Caner </option>
                        <option value="option8">Thyroid Caner </option>
                        <option value="option9">Prostate Caner </option>
                        <option value="option10">Colorectal Cancer </option>
                    </select>

                </div>

                <!-- Option 1: Brain Tuomer done-->
                <div id="option1-content" class="option-content" style="display:none;">
                    <form method="post" class="container wrapper" id="brain">
                        @csrf
                        <header>Medica Uploader File</header>
                        <div id="drop-area1" onclick="triggerFileInput(1)" class="drop-area">
                            <input type="file" id="file-input1" multiple accept="image/*" style="display:none;">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>
                                Choose images from your files, <br> &emsp;&emsp;&ensp; or drag & drop here
                            </p>

                        </div>
                        <div id="image-display1" class="figure"></div>
                         <div id="response1">
                        </div> 
 
                    </form>
                </div>

                <!-- Option 2: Skin Caner done -->
                <div id="option2-content" class="option-content" style="display:none;">
                    <form method="post" class="container wrapper">
                        @csrf
                        <header>Medica Uploader File</header>
                        <div id="drop-area2" onclick="triggerFileInput(2)" class="drop-area">
                            <input type="file" id="file-input2" accept="image/*" style="display:none;">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>
                                Choose images from your files, <br> &emsp;&emsp;&ensp; or drag & drop here
                            </p>
                        </div>
                        <div id="image-display2" class="figure"></div>
                        <div id="response2">
                            <!-- Image and result will be displayed here -->
                        </div>

                    </form>

                </div>

                <!-- Option 3: Histopathologic Caner -->
                <div id="option3-content" class="option-content" style="display:none;">
                    <div class="container wrapper">
                        <header>Medica Uploader File</header>
                        <div id="drop-area3" onclick="triggerFileInput(3)" class="drop-area">
                            <input type="file" id="file-input3" accept="image/*" style="display:none;">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>
                                Choose images from your files, <br> &emsp;&emsp;&ensp; or drag & drop here
                            </p>
                        </div>
                        <div id="image-display3" class="figure"></div>

                    </div>
                </div>

                <!-- Option 4: Lung Caner done(Choose Upload Photo or Disease Symptoms) -->
                <div id="option4-content" class="option-content" style="display:none;">
                    <div class="option_button">
                        <button onclick="toggleOptionAction(4, 'upload')">Upload a Photo</button>
                        <button onclick="toggleOptionAction(4, 'symptoms')">Choose Disease Symptoms</button>
                    </div>
                    <!-- Upload Photo Section for Option 4 -->
                    <div id="upload-photo4" class="container wrapper" style="display:none;">
                        <header>Medica Uploader File</header>
                        <div id="drop-area4" onclick="triggerFileInput(4)" class="drop-area">
                            <input type="file" id="file-input4" accept="image/*" style="display:none;">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>
                                Choose images from your files, <br> &emsp;&emsp;&ensp; or drag & drop here
                            </p>
                        </div>
                        <div id="image-display4" class="figure"></div>

                        <div id="response4">
                            <!-- Image and result will be displayed here -->
                        </div>
                        
                    </div>

                    <!-- Disease Symptoms Section for Option 4 -->
                    <div id="disease-symptoms4" class="regist_container" style="display:none;">
                        <div class="title">Enter Disease Symptoms</div>
                        <form id="symptoms-form" class="lung_form">
                            @csrf


                            <div class="symptom-option">
                                <label>1. Gender:</label>
                                Male<input type="radio" name="gender" value="1" required>
                                Female<input type="radio" name="gender" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>2. Age:</label>
                                <input type="number" name="age" min="1" max="120" required>
                            </div>

                            <div class="symptom-option">
                                <label>3. Smoking:</label>
                                Yes<input type="radio" name="smoking" value="1" required>
                                No<input type="radio" name="smoking" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>4. Yellow Fingers:</label>
                                Yes<input type="radio" name="yellow_fingers" value="1" required>
                                No<input type="radio" name="yellow_fingers" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>5. Anxiety:</label>
                                Yes<input type="radio" name="anxiety" value="1" required>
                                No<input type="radio" name="anxiety" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>6. Peer Pressure:</label>
                                Yes<input type="radio" name="peer_pressur" value="1" required>
                                No<input type="radio" name="peer_pressur" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>7. Chronic Disease:</label>
                                Yes<input type="radio" name="chronic_disease" value="1" required>
                                No<input type="radio" name="chronic_disease" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>8. Fatigue:</label>
                                Yes<input type="radio" name="fatigue" value="1" required>
                                No<input type="radio" name="fatigue" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>9. Allergy:</label>
                                Yes<input type="radio" name="allergy" value="1" required>
                                No<input type="radio" name="allergy" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>10. Wheezing:</label>
                                Yes<input type="radio" name="wheezing" value="1" required>
                                No<input type="radio" name="wheezing" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>11. Alcohol Consumption:</label>
                                Yes<input type="radio" name="alcohol_consumption" value="1" required>
                                No<input type="radio" name="alcohol_consumption" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>12. Coughing:</label>
                                Yes<input type="radio" name="coughing" value="1" required>
                                No<input type="radio" name="coughing" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>13. Shortness of Breath:</label>
                                Yes<input type="radio" name="shortness_of_breath" value="1" required>
                                No<input type="radio" name="shortness_of_breath" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>14. Swallowing Difficulty:</label>
                                Yes<input type="radio" name="swallowing_difficulty" value="1" required>
                                No<input type="radio" name="swallowing_difficulty" value="0">
                            </div>

                            <div class="symptom-option">
                                <label>15. Chest Pain:</label>
                                Yes<input type="radio" name="chest_pain" value="1" required>
                                No<input type="radio" name="chest_pain" value="0">
                            </div>


                            <div id="response444">
                                <!-- Image and result will be displayed here -->
                            </div>

                        </form>

                    </div>
                </div>
                <!-- Option 5: breast Caner (Choose Upload Photo or Disease Symptoms) -->
                <div id="option5-content" class="option-content" style="display:none;">
                    <div class="option_button">
                        <button onclick="toggleOptionAction(5, 'upload')">Upload a Photo</button>
                        <button onclick="toggleOptionAction(5, 'symptoms')">Choose Disease Symptoms</button>
                    </div>
                    <!-- Upload Photo Section for Option 5 -->
                    <div id="upload-photo5" class="container wrapper" style="display:none;">
                        <header>Medica Uploader File</header>
                        <div id="drop-area5" onclick="triggerFileInput(5)" class="drop-area">
                            <input type="file" id="file-input5" accept="image/*" style="display:none;">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>
                                Choose images from your files, <br> &emsp;&emsp;&ensp; or drag & drop here
                            </p>
                        </div>
                        <div id="image-display5" class="figure"></div>
                        <div id="response5">
                            <!-- Image and result will be displayed here -->
                        </div>

                    </div>

                    <!-- Disease Symptoms Section for Option 5 -->

                    <div id="disease-symptoms5" class="regist_container" style="display:none;">
                        <div class="title">Enter Disease Symptoms</div>
                        <!-- <h4>Enter Disease Symptoms</h4> -->
                        <div class="regist_content">
                            <form action="" id="breast-form" method="post">
                                @csrf
                                <div class="user-details">
                                    <!-- Input for Mean radius -->
                                    <div class="regist_input_box">
                                        <span class="details">Mean radius</span>
                                        <input type="number" step="any" placeholder="Enter Mean radius"
                                            name="Mean radius" required>
                                    </div>
                                    <!-- Input for Mean texture -->
                                    <div class="regist_input_box">
                                        <span class="details">Mean texture</span>
                                        <input type="number" step="any" placeholder="Enter Mean texture"
                                            name="Mean texture" required>
                                    </div>
                                    <!-- Input for Mean perimeter -->
                                    <div class="regist_input_box">
                                        <span class="details">Mean perimeter</span>
                                        <input type="number" step="any" placeholder="Enter Mean perimeter"
                                            name="Mean perimeter" required>
                                    </div>
                                    <!-- Input for Mean area -->
                                    <div class="regist_input_box">
                                        <span class="details">Mean area</span>
                                        <input type="number" step="any" placeholder="Enter Mean area" name="Mean area"
                                            required>
                                    </div>
                                    <!-- Input for Mean smoothness -->
                                    <div class="regist_input_box">
                                        <span class="details">Mean smoothness</span>
                                        <input type="number" step="any" placeholder="Enter Mean smoothness"
                                            name="Mean smoothness" required>
                                    </div>
                                    <!-- Input for Mean compactness -->
                                    <div class="regist_input_box">
                                        <span class="details">Mean compactness</span>
                                        <input type="number" step="any" placeholder="Enter Mean compactness"
                                            name="Mean compactness" required>
                                    </div>
                                    <!-- Input for Mean concavity -->
                                    <div class="regist_input_box">
                                        <span class="details">Mean concavity</span>
                                        <input type="number" step="any" placeholder="Enter Mean concavity"
                                            name="Mean concavity" required>
                                    </div>
                                    <!-- Input for Mean concave points -->
                                    <div class="regist_input_box">
                                        <span class="details">Mean concave points</span>
                                        <input type="number" step="any" placeholder="Enter Mean concave points"
                                            name="Mean concave points" required>
                                    </div>
                                    <!-- Input for Mean symmetry -->
                                    <div class="regist_input_box">
                                        <span class="details">Mean symmetry</span>
                                        <input type="number" step="any" placeholder="Enter Mean symmetry"
                                            name="Mean symmetry" required>
                                    </div>
                                    <!-- Input for Mean fractal dimension -->
                                    <div class="regist_input_box">
                                        <span class="details">Mean fractal dimension</span>
                                        <input type="number" step="any" placeholder="Enter Mean fractal dimension"
                                            name="Mean fractal dimension" required>
                                    </div>
                                    <!-- Input for Radius error -->
                                    <div class="regist_input_box">
                                        <span class="details">Radius error</span>
                                        <input type="number" step="any" placeholder="Enter Radius error"
                                            name="Radius error" required>
                                    </div>
                                    <!-- Input for Texture error -->
                                    <div class="regist_input_box">
                                        <span class="details">Texture error</span>
                                        <input type="number" step="any" placeholder="Enter Texture error"
                                            name="Texture error" required>
                                    </div>
                                    <!-- Input for Perimeter error -->
                                    <div class="regist_input_box">
                                        <span class="details">Perimeter error</span>
                                        <input type="number" step="any" placeholder="Enter Perimeter error"
                                            name="Perimeter error" required>
                                    </div>
                                    <!-- Input for Area error -->
                                    <div class="regist_input_box">
                                        <span class="details">Area error</span>
                                        <input type="number" step="any" placeholder="Enter Area error" name="Area error"
                                            required>
                                    </div>
                                    <!-- Input for Smoothness error -->
                                    <div class="regist_input_box">
                                        <span class="details">Smoothness error</span>
                                        <input type="number" step="any" placeholder="Enter Smoothness error"
                                            name="Smoothness error" required>
                                    </div>
                                    <!-- Input for Compactness error -->
                                    <div class="regist_input_box">
                                        <span class="details">Compactness error</span>
                                        <input type="number" step="any" placeholder="Enter Compactness error"
                                            name="Compactness error" required>
                                    </div>
                                    <!-- Input for  Concavity error-->
                                    <div class="regist_input_box">
                                        <span class="details">Concavity error</span>
                                        <input type="number" step="any" placeholder="Enter Concavity error"
                                            name="Concavity error" required>
                                    </div>
                                    <!-- Input for Concave points error -->
                                    <div class="regist_input_box">
                                        <span class="details">Concave points error</span>
                                        <input type="number" step="any" placeholder="Enter Concave points error"
                                            name="Concave points error" required>
                                    </div>
                                    <!-- Input for Symmetry error -->
                                    <div class="regist_input_box">
                                        <span class="details">Symmetry error</span>
                                        <input type="number" step="any" placeholder="Enter Symmetry error"
                                            name="Symmetry error" required>
                                    </div>
                                    <!-- Input for Fractal dimension error -->
                                    <div class="regist_input_box">
                                        <span class="details">Fractal dimension error</span>
                                        <input type="number" step="any" placeholder="Enter Fractal dimension error"
                                            name="Fractal dimension error" required>
                                    </div>
                                    <!-- Input for Worst radius -->
                                    <div class="regist_input_box">
                                        <span class="details">Worst radius</span>
                                        <input type="number" step="any" placeholder="Enter Worst radius"
                                            name="Worst radius" required>
                                    </div>
                                    <!-- Input for Worst texture -->
                                    <div class="regist_input_box">
                                        <span class="details">Worst texture</span>
                                        <input type="number" step="any" placeholder="Enter Worst texture"
                                            name="Worst texture" required>
                                    </div>
                                    <!-- Input for Worst perimeter -->
                                    <div class="regist_input_box">
                                        <span class="details">Worst perimeter</span>
                                        <input type="number" step="any" placeholder="Enter Worst perimeter"
                                            name="Worst perimeter" required>
                                    </div>
                                    <!-- Input for Worst area -->
                                    <div class="regist_input_box">
                                        <span class="details">Worst area</span>
                                        <input type="number" step="any" placeholder="Enter Worst area" name="Worst area"
                                            required>
                                    </div>
                                    <!-- Input for Worst smoothness -->
                                    <div class="regist_input_box">
                                        <span class="details">Worst smoothness</span>
                                        <input type="number" step="any" placeholder="Enter Worst smoothness"
                                            name="Worst smoothness" required>
                                    </div>
                                    <!-- Input for Worst compactness -->
                                    <div class="regist_input_box">
                                        <span class="details">Worst compactness</span>
                                        <input type="number" step="any" placeholder="Enter Worst compactness"
                                            name="Worst compactness" required>
                                    </div>
                                    <!-- Input for Worst concavity -->
                                    <div class="regist_input_box">
                                        <span class="details">Worst concavity</span>
                                        <input type="number" step="any" placeholder="Enter Worst concavity"
                                            name="Worst concavity" required>
                                    </div>
                                    <!-- Input for Worst concave points -->
                                    <div class="regist_input_box">
                                        <span class="details">Worst concave points</span>
                                        <input type="number" step="any" placeholder="Enter Worst concave points"
                                            name="Worst concave points" required>
                                    </div>
                                    <!-- Input for Worst symmetry -->
                                    <div class="regist_input_box">
                                        <span class="details">Worst symmetry</span>
                                        <input type="number" step="any" placeholder="Enter Worst symmetry"
                                            name="Worst symmetry" required>
                                    </div>
                                    <!-- Input for Worst fractal dimension -->
                                    <div class="regist_input_box">
                                        <span class="details">Worst fractal dimension</span>
                                        <input type="number" step="any" placeholder="Enter Worst fractal dimension"
                                            name="Worst fractal dimension" required>
                                    </div>

                                </div>
                    
                                <div id="responseb">
                                    <!-- Image and result will be displayed here -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Option 6: Kidney Caner done -->
                <div id="option6-content" class="option-content" style="display:none;">
                    <div class="container wrapper">
                        <header>Medica Uploader File</header>
                        <div id="drop-area6" onclick="triggerFileInput(6)" class="drop-area">
                            <input type="file" id="file-input6" accept="image/*" style="display:none;">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>
                                Choose images from your files, <br> &emsp;&emsp;&ensp; or drag & drop here
                            </p>
                        </div>
                        <div id="image-display6" class="figure"></div>
                        <div id="response6">
                            <!-- Image and result will be displayed here -->
                        </div>
          
                    </div>
                </div>

                <!-- Option 7: Oral Caner done -->
                <div id="option7-content" class="option-content" style="display:none;">
                    <form method="post" class="container wrapper">
                        @csrf
                        <header>Medica Uploader File</header>
                        <div id="drop-area7" onclick="triggerFileInput(7)" class="drop-area">
                            <input type="file" id="file-input7" accept="image/*" style="display:none;">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>
                                Choose images from your files, <br> &emsp;&emsp;&ensp; or drag & drop here
                            </p>
                        </div>
                        <div id="image-display7" class="figure"></div>
                        <div id="response7">
                            <!-- Image and result will be displayed here -->
                        </div>


                    </form>
                </div>

                <!-- Option 8: Thyroid Cancer (Disease Symptoms) -->
                <div id="option8-content" class="option-content" style="display:none;">
                    <!-- Disease Symptoms Section for Option 8 -->
                    <div id="disease-symptoms8" class="regist_container">
                        <div class="title">Enter Disease Symptoms</div>
                        <div class="regist_content">
                            <form action="" method="post" id="cancer-prediction-form">
                                @csrf
                                <div class="user-details">
                                    <!-- Input for Age -->
                                    <div class="regist_input_box">
                                        <span class="details">Age</span>
                                        <input type="number" name="age" placeholder="Enter Age" required>
                                    </div>
                                    <!-- Input for Gender -->
                                    <div class="regist_input_box">
                                        <span class="details">Gender</span>
                                        <select name="gender">
                                            <option value="Gender" disabled selected hidden>Choose Gender
                                            </option>
                                            <option value="1">Male</option>
                                            <option value="0">Female</option>
                                        </select>
                                    </div>
                                    <!-- Input for Smoking -->
                                    <div class="regist_input_box">
                                        <span class="details">Smoking</span>
                                        <select name="smoking">
                                            <option value="" disabled selected hidden>Choose Smoking</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <!-- Input for History of Smoking -->
                                    <div class="regist_input_box">
                                        <span class="details">History of Smoking</span>
                                        <select name="history_of_smoking">
                                            <option value="" disabled selected hidden>Choose History of Smoking
                                            </option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <!-- Input for History of Radiotherapy -->
                                    <div class="regist_input_box">
                                        <span class="details">History of Radiotherapy</span>
                                        <select name="history_of_radiotherapy">
                                            <option value="" disabled selected hidden>Choose History of
                                                Radiotherapy
                                            </option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <!-- Input for Thyroid Function -->
                                    <div class="regist_input_box">
                                        <span class="details">Thyroid Function</span>
                                        <select name="thyroid_function">
                                            <option value="" disabled selected hidden>Choose Thyroid Function
                                            </option>
                                            <option value="0">Normal</option>
                                            <option value="1">Abnormal</option>
                                        </select>
                                    </div>
                                    <!-- Input for Physical Examination -->
                                    <div class="regist_input_box">
                                        <span class="details">Physical Examination</span>
                                        <select name="physical_examination">
                                            <option value="" disabled selected hidden>Choose Physical
                                                Examination
                                            </option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <!-- Input for Adenopathy -->
                                    <div class="regist_input_box">
                                        <span class="details">Adenopathy</span>
                                        <select name="adenopathy">
                                            <option value="" disabled selected hidden>Choose Adenopathy</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <!-- Input for Pathology -->
                                    <div class="regist_input_box">
                                        <span class="details">Pathology</span>
                                        <input type="number" name="pathology" placeholder="Enter Pathology" required>
                                    </div>
                                    <!-- Input for Focality -->
                                    <div class="regist_input_box">
                                        <span class="details">Focality</span>
                                        <select name="focality">
                                            <option value="" disabled selected hidden>Choose Focality</option>
                                            <option value="0">Unifocal</option>
                                            <option value="1">Multifocal</option>
                                        </select>
                                    </div>
                                    <!-- Input for Risk -->
                                    <div class="regist_input_box">
                                        <span class="details">Risk</span>
                                        <select name="risk">
                                            <option value="" disabled selected hidden>Choose Risk</option>
                                            <option value="0">Low</option>
                                            <option value="1">Intermediate</option>
                                            <option value="2">High</option>
                                        </select>
                                    </div>
                                    <!-- Input for Tumor size classification -->
                                    <div class="regist_input_box">
                                        <span class="details">Tumor size classification</span>
                                        <input type="number" name="tumor_size_classification" placeholder="Enter Tumor size classification"
                                            required>
                                    </div>
                                    <!-- Input for Lymph node involvement -->
                                    <div class="regist_input_box">
                                        <span class="details">Lymph node involvement</span>
                                        <input type="number" name="lymph_node_involvement" placeholder="Enter Lymph node involvement"
                                            required>
                                    </div>
                                    <!-- Input for Metastasis -->
                                    <div class="regist_input_box">
                                        <span class="details">Metastasis</span>
                                        <input type="number" name="metastasis" placeholder="Enter Metastasis" required>
                                    </div>
                                    <!-- Input for Stage -->
                                    <div class="regist_input_box">
                                        <span class="details">Stage</span>
                                        <select name="stage">
                                            <option value="" disabled selected hidden>Choose Stage</option>
                                            <option value="0">I</option>
                                            <option value="1">II</option>
                                            <option value="2">III</option>
                                            <option value="3">IV</option>
                                        </select>
                                    </div>
                                    <!-- Input for Response -->
                                    <div class="regist_input_box">
                                        <span class="details">Response</span>
                                        <select name="response">
                                            <option value="" disabled selected hidden>Choose Response</option>
                                            <option value="0">Excellent</option>
                                            <option value="1">Indeterminate</option>
                                            <option value="2">Biochemical Incomplete</option>
                                            <option value="3">Structural Incomplete</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="response4441">
                                    <!-- Image and result will be displayed here -->
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- Option 9: prostate Cancer -->
                <div id="option9-content" class="option-content" style="display:none;">
                    <!-- Disease Symptoms Section for Option 9 -->
                    <div id="disease-symptoms9" class="regist_container">
                        <div class="title">Enter Disease Symptoms</div>
                        <div class="regist_content">
                            <form action="" method="post" id="cancer-prediction-prostate-form">
                                @csrf
                                <div class="user-details">
                                    <!-- Input for Radius -->
                                    <div class="regist_input_box">
                                        <span class="details">Radius</span>
                                        <input type="number" name="Radius" placeholder="Enter Radius" required>
                                    </div>
                                    <!-- Input for Area -->
                                    <div class="regist_input_box">
                                        <span class="details">Area</span>
                                        <input type="number" name="Area" placeholder="Enter Area" required>
                                    </div>
                                    <!-- Input for Smoothness -->
                                    <div class="regist_input_box">
                                        <span class="details">Smoothness</span>
                                        <input type="number" name="Smoothness" step="any" placeholder="Enter Smoothness"
                                            required>
                                    </div>
                                    <!-- Input for Compactness -->
                                    <div class="regist_input_box">
                                        <span class="details">Compactness</span>
                                        <input type="number" name="Compactness" step="any"
                                            placeholder="Enter Compactness" required>
                                    </div>
                                    <!-- Input forSymmetry -->
                                    <div class="regist_input_box">
                                        <span class="details">Symmetry</span>
                                        <input type="number" name="Symmetry" placeholder="Enter Symmetry" required>
                                    </div>
                                </div>

                                <div id="response441">
                                    <!-- Image and result will be displayed here -->
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- Option 10: Colorectal Cancer (Disease Symptoms)-->
                <div id="option10-content" class="option-content" style="display:none;">
                    <form method="post" class="container wrapper">
                        @csrf
                        <header>Medica Uploader File</header>
                        <div id="drop-area10" onclick="triggerFileInput(10)" class="drop-area">
                            <input type="file" id="file-input10" accept="image/*" style="display:none;">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>
                                Choose images from your files, <br> &emsp;&emsp;&ensp; or drag & drop here
                            </p>
                        </div>
                        <div id="image-display10" class="figure"></div>
                        <div id="response10">
                            <!-- Image and result will be displayed here -->
                        </div>
                    </form>
                </div>



            </div>
            <div class="report-body">

                {{-- <button class="report-btn" id="make-report-btn">Make Report</button> --}}
            
                <div class="report-modal" id="report-modal">
                    <div class="report-modal-content" id="report-area">
                        <span class="close-report" id="close-report-modal">&times;</span>
            
                        <!-- Report Start -->
                        <div class="report-header">
                            <div>
                                <h2>Medica <small>Application</small></h2>
                            </div>
                            <div class="report-logo">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
    
                                    <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#0084FF" stroke="none">
                                        <path d="M2079 4671 l-24 -19 -5 -601 -5 -601 -495 286 c-272 158 -507 291 -521 297 -62 24 -69 15 -309 -401 -124 -213 -226 -399 -228 -413 -2 -15 1 -36 7 -47 6 -11 240 -152 520 -313 281 -162 510 -296 510 -299 0 -3 -223 -133 -497 -290 -273 -157 -507 -295 -519 -307 -13 -12 -23 -34 -23 -49 0 -35 432 -786 468 -815 18 -14 35 -19 53 -15 14 3 252 136 529 295 277 160 505 291 507 291 1 0 3 -268 3 -595 l0 -596 25 -24 24 -25 459 0 c438 0 461 1 483 19 l24 19 5 601 5 602 511 -296 c297 -171 522 -295 537 -295 14 0 34 8 45 18 35 30 462 783 462 815 0 16 -10 37 -23 50 -12 12 -246 150 -519 307 -274 157 -497 287 -497 290 0 3 223 133 497 290 273 157 507 295 520 307 12 13 22 34 22 50 0 23 -239 452 -435 780 -21 36 -64 58 -94 48 -12 -3 -247 -137 -522 -296 -276 -159 -503 -289 -505 -289 -2 0 -4 268 -4 595 l0 596 -25 24 -24 25 -459 0 c-438 0 -461 -1 -483 -19z m831 -766 l0 -626 25 -24 c15 -16 36 -25 54 -25 22 0 183 88 553 301 287 166 529 304 538 306 10 2 24 -13 41 -44 15 -27 92 -161 172 -300 l146 -252 -507 -292 c-615 -354 -578 -331 -586 -365 -16 -64 -14 -65 497 -360 265 -153 507 -293 539 -311 l56 -33 -165 -287 c-91 -159 -171 -294 -178 -301 -10 -11 -107 41 -542 292 -575 332 -580 334 -622 280 -21 -26 -21 -35 -21 -650 l0 -624 -350 0 -350 0 0 624 c0 615 0 624 -21 650 -42 53 -47 51 -618 -279 -291 -168 -533 -305 -537 -305 -10 1 -347 585 -344 597 1 4 238 144 528 311 290 167 535 312 545 324 9 11 17 29 17 39 0 54 -16 65 -557 376 -293 170 -533 312 -533 317 0 11 318 566 335 584 11 12 106 -40 543 -292 574 -331 579 -333 621 -280 21 26 21 35 21 650 l0 624 350 0 350 0 0 -625z"></path>
                                    </g>
                                </svg>                        
                            </div>
                        </div>
                        <!-- Patient Data -->
                        <table class="report-table">
                            <tr>
                                <td><b>Patient Name:</b><span id="Patient_Name"></span></td>
                                <td><b>Date:</b> <span id="report-date"></span></td>
                            </tr>
                            <tr>
                                <td><b>Patient Age:</b> <span id="Patient_Age"></span></td>
                                <td><b>Gender:</b> <span id="Patient_Gender"></span></td>
                            </tr>
                            <tr>
                                <td><b>Diagnosis Check:</b> <span id="Diagnosis_Check"></span></td>
                            </tr>
                        </table>
                        
                        <div class="report-title">Medical Check</div>
            {{-- add image in report --}}
                        <div class="report-image">
                            <img id="report-image" src="" alt="Uploaded Image">
                        </div>
                        <!-- Report content -->
                        <table class="report-table" id="report-content">

                            
                        </table>
            
                        <div class="report-expected-level">
                            Expected Level: <span id="report-expected-level"></span>
                        </div>
            
                        <div class="report-footer">
                            Medica Application | www.Medica.com
                        </div>
            
                        <button id="download-pdf" class="download_report">
                            <img src="{{ asset('/../assets/images/adobe.png') }}" alt="adobeicon_here">
                            Download Pdf
                        </button>
            
                        <!-- Report End -->
                    </div>
                </div>
            </div>
            <div id="loader" style="display: none;">
                <div class="spinner">

                </div>
            </div>
        

            <div class="cancer_result" id="diagnosis-result" style="display: none;">
                <h4 id="result-text" style="font-family: Poppins, sans-serif;text-align: center; margin-top:20px">
                    <!-- Here the Result will change automatically -->
                </h4>
                <div class="d-flex align-items-center justify-content-center services-main-btn" style="margin-top: 2%;">
                    <!--<a id="learn-more-link" href="#" target="_blank">-->
                    <!--    <button type="button" class="btn btn-primary-outline">Learn more</button>-->
                    <!--</a>-->
                </div>
        </div>
            <button id="start-diagnosis" class="doctor_button">Start Diagnosis</button>

        <!-- #####################################################-->
        <!--########################### Content ##################-->
        <!-- #####################################################-->


    </main>

    <script>
        // Show content for the selected option
        document.getElementById("option-selector").addEventListener("change", function () {
            var selectedOption = this.value;

            // Hide all content sections first
            var contentSections = document.querySelectorAll(".option-content");
            contentSections.forEach(function (section) {
                section.style.display = "none";
            });

            // Show the content of the selected option
            if (selectedOption) {
                document.getElementById(selectedOption + "-content").style.display = "block";
            }

            // Ensure Option 8 and Option 9 always display the disease symptoms section
            if (selectedOption === "option8") {
                document.getElementById("disease-symptoms8").style.display = "block";
            } else {
                document.getElementById("disease-symptoms8").style.display = "none";
            }

            if (selectedOption === "option9") {
                document.getElementById("disease-symptoms9").style.display = "block";
            } else {
                document.getElementById("disease-symptoms9").style.display = "none";
            }

            // Ensure Options 10, 11, and 12 display the image upload section instead of disease symptoms
            if (selectedOption === "option10" || selectedOption === "option11" || selectedOption === "option12") {
                document.getElementById("upload-photo" + selectedOption.replace("option", "")).style.display = "block"; // Ensure image upload is visible
            }
        });

        // Function to trigger file input selection
        function triggerFileInput(option) {
            document.getElementById("file-input" + option).click();
        }

        // Handle image file selection or drag-and-drop for all options (Now includes 10, 11, 12)
        for (let i = 1; i <= 12; i++) {
            let fileInput = document.getElementById("file-input" + i);
            let dropArea = document.getElementById("drop-area" + i);

            if (fileInput) {
                fileInput.addEventListener("change", function (event) {
                    handleFileSelect(event, i);
                });
            }

            if (dropArea) {
                dropArea.addEventListener("dragover", function (event) {
                    handleDragOver(event);
                });

                dropArea.addEventListener("drop", function (event) {
                    handleFileDrop(event, i);
                });
            }
        }

        // Handle file selection
        function handleFileSelect(event, option) {
            event.preventDefault();
            var file = event.target.files[0];
            if (file) {
                displayImage(file, option);
            }
        }

        // Handle drag and drop functionality
        function handleDragOver(event) {
            event.preventDefault();
            event.stopPropagation();
            event.dataTransfer.dropEffect = "copy";
        }

        function handleFileDrop(event, option) {
            event.preventDefault();
            event.stopPropagation();
            var file = event.dataTransfer.files[0];
            if (file) {
                displayImage(file, option);
            }
        }

        // Function to display the selected image
        function displayImage(file, option) {
            var reader = new FileReader();
            reader.onload = function (event) {
                var image = new Image();
                image.src = event.target.result;
                image.alt = "Uploaded Image";
                document.getElementById("image-display" + option).innerHTML = "";
                document.getElementById("image-display" + option).appendChild(image);
            };
            reader.readAsDataURL(file);
        }

        // Toggle between upload photo or disease symptoms selection
        function toggleOptionAction(option, action) {
            if (action === 'upload') {
                document.getElementById("upload-photo" + option).style.display = "block";
                document.getElementById("disease-symptoms" + option).style.display = "none";
            } else if (action === 'symptoms') {
                document.getElementById("upload-photo" + option).style.display = "none";
                document.getElementById("disease-symptoms" + option).style.display = "block";
            }
        }

        // Option 4 - Disease Symptoms (Yes/No) event listeners


        symptoms.forEach(symptom => {
            letYesBtn = document.getElementById(symptom + "-yes");
            letNoBtn = document.getElementById(symptom + "-no");

            if (yesBtn) {
                YesBtn.addEventListener("change", function () {
                    console.log(symptom.replace("-", " ") + ":Yes");
                });
            }

            if (noBtn) {
                NoBtn.addEventListener("change", function () {
                    console.log(symptom.replace("-", " ") + ":No");
                });
            }
        });
        //////////////////////////////////////////////////////////////////////////
        // Function to upload image


    </script>

{{-- <script>

    // open report button
   
        document.getElementById('report-modal').style.display = 'flex';
        const today = new Date();
        document.getElementById('report-date').innerText =
            today.getDate() + '-' + (today.getMonth() + 1) + '-' + today.getFullYear();
    
    
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
</script> --}}

</x-layout>