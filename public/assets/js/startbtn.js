document.getElementById("start-diagnosis").addEventListener("click", function () {
    const selectedOption = document.getElementById("option-selector").value;
    if (!selectedOption) {
        alert("Please select a cancer type first.");
        return;
    }

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const modelMap = {
        'option1': 'brain', 'option2': 'skin', 'option3': 'Histopathologic',
        'option4': 'lung', 'option5': 'breast', 'option6': 'kidney',
        'option7': 'oral', 'option10': 'colon'
    };

    // Handle different option types
    if (["option1", "option2", "option3", "option6", "option7", "option10"].includes(selectedOption)) {
        handleImageOnly(selectedOption, token, modelMap);
    } else if (["option8", "option9"].includes(selectedOption)) {
        handleSymptomsOnly(selectedOption, token);


    } else if (["option4", "option5"].includes(selectedOption)) {
        handleMixedOptions(selectedOption, token, modelMap);
    } else {
        alert("This cancer type is not yet supported.");
    }
});
function speakDiagnosis(prediction, confidence) {
    const speech = new SpeechSynthesisUtterance();
    speech.text = `The diagnosis is ${prediction}. Confidence level is ${confidence} . 
    To learn more about this type of cancer, please click the Learn More link below.`;
    speech.lang = "en-US";
    speech.pitch = 1;
    speech.rate = 1;
    window.speechSynthesis.speak(speech);
}

function handleImageOnly(selectedOption, token, modelMap) {
    const optionNumber = selectedOption.replace('option', '');
    const fileInput = document.getElementById(`file-input${optionNumber}`);

    if (!fileInput?.files[0]) {
        alert("Please upload an image for diagnosis.");
        return;
    }

    const loader = document.getElementById("loader");
    const resultDiv = document.getElementById("diagnosis-result");
    const resultText = document.getElementById("result-text");

    loader.style.display = "block";
    resultDiv.style.display = "none";

    const formData = new FormData();
    formData.append("image", fileInput.files[0]);
    formData.append("id", modelMap[selectedOption]);

    fetch("/upload-image", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": token },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        loader.style.display = "none";
        console.log('API Response:', data);
    
        const responseData = data.saved_record;
        if (responseData) {
            document.getElementById('Patient_Name').innerHTML = responseData.patient_name || 'Not Available';
            document.getElementById('Patient_Age').innerHTML = responseData.patient_age || 'Not Available';
            document.getElementById('Patient_Gender').innerHTML = responseData.gender || 'Not Available';
            document.getElementById('Diagnosis_Check').innerHTML = responseData.diagnosis_check || 'Not Available';
            document.getElementById('report-expected-level').innerHTML = responseData.expected_level || 'Not Available';
    
            document.getElementById('report-content').innerHTML = `
                <tr><td>Confidence:</td><td>${responseData.confidence ?? 'Not Available'}</td></tr>
                ${responseData.advise ? `<tr><td>Advice:</td><td>${responseData.advise}</td></tr>` : ''}
            `;
    
            document.getElementById('report-image').src = '/storage/' + responseData.image_path;
    
            const today = new Date();
            document.getElementById('report-date').innerText = `${today.getDate()}-${today.getMonth() + 1}-${today.getFullYear()}`;
    
            document.getElementById('report-modal').style.display = 'flex';
    
            document.getElementById('close-report-modal').addEventListener('click', () => {
                document.getElementById('report-modal').style.display = 'none';
            });
    
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
        } else {
            alert("No data returned from the server.");
        }
    })
    .catch(error => {
        loader.style.display = "none";
        alert("Error: " + error.message);
    });
}

function handleSymptomsOnly(selectedOption, token) {
    const endpoints = {
        'option8': { url: '/predict_thyroid_cancer', responseId: 'response4441' },
        'option9': { url: '/predict_prostate_cancer', responseId: 'response441' }
    };

    const { url, responseId } = endpoints[selectedOption];
    const form = document.querySelector(`#${selectedOption}-content form`);
    const jsonData = Object.fromEntries(new FormData(form).entries());

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify(jsonData)
    })
        .then(response => response.json())
        .then(data => {
            console.log('API Response:', data);  // Check the API response

            if (data && data.prediction) {
                const responseData = data.prediction;

                // Set values
                document.getElementById('Patient_Name').innerHTML = responseData.patient_name || 'Not Available';
                document.getElementById('Patient_Age').innerHTML = responseData.patient_age || 'Not Available';
                document.getElementById('Patient_Gender').innerHTML = responseData.gender || 'Not Available';
                document.getElementById('Diagnosis_Check').innerHTML = responseData.diagnosis_check || 'Not Available';
                document.getElementById('report-expected-level').innerHTML = responseData.expected_level || 'Not Available';

                // Handle diagnosis check for cancer types
                if (responseData.diagnosis_check === 'Prostate Cancer') {
                    document.getElementById('report-content').innerHTML = `
                    <tr><td>radius:</td><td>${responseData.radius || 'Not Available'}</td></tr>
                    <tr><td>area:</td><td>${responseData.area || 'Not Available'}</td></tr>
                    <tr><td>smoothness:</td><td>${responseData.smoothness || 'Not Available'}</td></tr>
                    <tr><td>compactness:</td><td>${responseData.compactness || 'Not Available'}</td></tr>
                    <tr><td>symmetry:</td><td>${responseData.symmetry || 'Not Available'}</td></tr>
                `;
                } else if (responseData.diagnosis_check === 'Thyroid Cancer') {
                    document.getElementById('report-content').innerHTML = `
                    <tr><td>Age:</td><td>${responseData.age || 'Not Available'}</td></tr>
                    <tr><td>Gender:</td><td>${responseData.gender === '1' ? 'Male' : 'Female'}</td></tr>
                    <tr><td>Smoking:</td><td>${responseData.smoking === '1' ? 'Yes' : 'No'}</td></tr>
                    <tr><td>History of Smoking:</td><td>${responseData.history_of_smoking === '1' ? 'Yes' : 'No'}</td></tr>
                    <tr><td>History of Radiotherapy:</td><td>${responseData.history_of_radiotherapy === '1' ? 'Yes' : 'No'}</td></tr>
                    <tr><td>Thyroid Function:</td><td>${responseData.thyroid_function === '0' ? 'Normal' : 'Abnormal'}</td></tr>
                    <tr><td>Physical Examination:</td><td>${responseData.physical_examination === '1' ? 'Yes' : 'No'}</td></tr>
                    <tr><td>Adenopathy:</td><td>${responseData.adenopathy === '1' ? 'Yes' : 'No'}</td></tr>
                    <tr><td>Pathology:</td><td>${responseData.pathology || 'Not Available'}</td></tr>
                    <tr><td>Focality:</td><td>${responseData.focality === '0' ? 'Unifocal' : 'Multifocal'}</td></tr>
                    <tr><td>Risk:</td><td>${responseData.risk === '0' ? 'Low' : responseData.risk === '1' ? 'Intermediate' : 'High'}</td></tr>
                    <tr><td>T (Tumor size):</td><td>${responseData.tumor_size_classification || 'Not Available'}</td></tr>
                    <tr><td>N (Lymph node involvement):</td><td>${responseData.lymph_node_involvement || 'Not Available'}</td></tr>
                    <tr><td>M (Metastasis):</td><td>${responseData.metastasis || 'Not Available'}</td></tr>
                    <tr><td>Stage:</td><td>${responseData.stage}</td></tr>
                    <tr><td>Response:</td><td>${responseData.response}</td></tr>

                `;
                }
            } else {
                document.getElementById(responseId).innerHTML = "Error: No prediction data available.";
            }

            document.getElementById('report-modal').style.display = 'flex';
            const today = new Date();
            document.getElementById('report-date').innerText = `${today.getDate()}-${today.getMonth() + 1}-${today.getFullYear()}`;

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
        })
        .catch(error => {
            document.getElementById(responseId).innerHTML = "Error: " + error.message;
        });
}


function handleMixedOptions(selectedOption, token, modelMap) {
    const optionNumber = selectedOption.replace('option', '');
    const imageSection = document.getElementById(`upload-photo${optionNumber}`);
    const symptomSection = document.getElementById(`disease-symptoms${optionNumber}`);

    if (imageSection.style.display === 'block') {
        handleImageUpload(selectedOption, token, modelMap, optionNumber);
    } else if (symptomSection.style.display === 'block') {
        handleSymptomsSubmission(selectedOption, token, optionNumber);
    } else {
        alert("Please select either image upload or symptoms.");
    }
}

function handleImageUpload(selectedOption, token, modelMap, optionNumber) {
    const fileInput = document.getElementById(`file-input${optionNumber}`);
    if (!fileInput?.files[0]) {
        alert("Please upload an image.");
        return;
    }

    const formData = new FormData();
    formData.append("image", fileInput.files[0]);
    formData.append("id", modelMap[selectedOption]);

    fetch("/upload-image", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": token },
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById(`response${optionNumber}`).innerHTML = data;
        })
        .catch(error => alert("Error: " + error.message));
}

function handleSymptomsSubmission(selectedOption, token, optionNumber) {
    const endpoints = {
        'option4': { url: '/predict_lung_cancer', responseId: 'response444' },
        'option5': { url: '/predict_breast_cancer', responseId: 'responseb' }
    };

    const { url, responseId } = endpoints[selectedOption];
    const form = document.querySelector(`#disease-symptoms${optionNumber} form`);
    const jsonData = Object.fromEntries(new FormData(form).entries());
    console.log('Form Data:', jsonData);  // Check the form data
    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify(jsonData)
    })
    .then(response => response.json())
    .then(data => {
        if (data && data.prediction) {
            const responseData = data.prediction;
            console.log('API Response:', responseData);  // Check the API response

            // Set values
            document.getElementById('Patient_Name').innerHTML = responseData.patient_name || 'Not Available';
            document.getElementById('Patient_Age').innerHTML = responseData.patient_age || 'Not Available';
            document.getElementById('Patient_Gender').innerHTML = responseData.gender || 'Not Available';
            document.getElementById('Diagnosis_Check').innerHTML = responseData.diagnosis_check || 'Not Available';
            document.getElementById('report-expected-level').innerHTML = responseData.expected_level || 'Not Available';

            // Handle diagnosis check for cancer types
            if (responseData.diagnosis_check === 'Breast Cancer') {
                document.getElementById('report-content').innerHTML = `
                    <tr><td>Mean Radius:</td><td>${responseData.mean_radius}</td></tr>
                    <tr><td>Mean Texture:</td><td>${responseData.mean_texture}</td></tr>
                    <tr><td>Mean Perimeter:</td><td>${responseData.mean_perimeter}</td></tr>
                    <tr><td>Mean Area:</td><td>${responseData.mean_area}</td></tr>
                    <tr><td>Mean Smoothness:</td><td>${responseData.mean_smoothness}</td></tr>
                    <tr><td>Mean Compactness:</td><td>${responseData.mean_compactness}</td></tr>
                    <tr><td>Mean Concavity:</td><td>${responseData.mean_concavity}</td></tr>
                    <tr><td>Mean Concave Points:</td><td>${responseData.mean_concave_points}</td></tr>
                    <tr><td>Mean Symmetry:</td><td>${responseData.mean_symmetry}</td></tr>
                    <tr><td>Mean Fractal Dimension:</td><td>${responseData.mean_fractal_dimension}</td></tr>
                    
                    <tr><td>Radius Error:</td><td>${responseData.radius_error}</td></tr>
                    <tr><td>Texture Error:</td><td>${responseData.texture_error}</td></tr>
                    <tr><td>Perimeter Error:</td><td>${responseData.perimeter_error}</td></tr>
                    <tr><td>Area Error:</td><td>${responseData.area_error}</td></tr>
                    <tr><td>Smoothness Error:</td><td>${responseData.smoothness_error}</td></tr>
                    <tr><td>Compactness Error:</td><td>${responseData.compactness_error}</td></tr>
                    <tr><td>Concavity Error:</td><td>${responseData.concavity_error}</td></tr>
                    <tr><td>Concave Points Error:</td><td>${responseData.concave_points_error}</td></tr>
                    <tr><td>Symmetry Error:</td><td>${responseData.symmetry_error}</td></tr>
                    <tr><td>Fractal Dimension Error:</td><td>${responseData.fractal_dimension_error}</td></tr>
                    
                    <tr><td>Worst Radius:</td><td>${responseData.worst_radius}</td></tr>
                    <tr><td>Worst Texture:</td><td>${responseData.worst_texture}</td></tr>
                    <tr><td>Worst Perimeter:</td><td>${responseData.worst_perimeter}</td></tr>
                    <tr><td>Worst Area:</td><td>${responseData.worst_area}</td></tr>
                    <tr><td>Worst Smoothness:</td><td>${responseData.worst_smoothness}</td></tr>
                    <tr><td>Worst Compactness:</td><td>${responseData.worst_compactness}</td></tr>
                    <tr><td>Worst Concavity:</td><td>${responseData.worst_concavity}</td></tr>
                    <tr><td>Worst Concave Points:</td><td>${responseData.worst_concave_points}</td></tr>
                    <tr><td>Worst Symmetry:</td><td>${responseData.worst_symmetry}</td></tr>
                    <tr><td>Worst Fractal Dimension:</td><td>${responseData.worst_fractal_dimension}</td></tr>
                `;

            }else if (responseData.diagnosis_check === 'Lung Cancer') {
                document.getElementById('report-content').innerHTML = `
                <tr><td>Gender:</td><td>${responseData.gender}</td></tr>
                <tr><td>Age:</td><td>${responseData.age}</td></tr>
                <tr><td>Smoking:</td><td>${responseData.smoking}</td></tr>
                <tr><td>Yellow Fingers:</td><td>${responseData.yellow_fingers}</td></tr>
                <tr><td>Anxiety:</td><td>${responseData.anxiety}</td></tr>
                <tr><td>Peer Pressure:</td><td>${responseData.peer_pressure}</td></tr>
                <tr><td>Chronic Disease:</td><td>${responseData.chronic_disease}</td></tr>
                <tr><td>Fatigue:</td><td>${responseData.fatigue}</td></tr>
                <tr><td>Allergy:</td><td>${responseData.allergy}</td></tr>
                <tr><td>Wheezing:</td><td>${responseData.wheezing}</td></tr>
                <tr><td>Alcohol Consumption:</td><td>${responseData.alcohol_consumption}</td></tr>
                <tr><td>Coughing:</td><td>${responseData.coughing}</td></tr>
                <tr><td>Shortness of Breath:</td><td>${responseData.shortness_of_breath}</td></tr>
                <tr><td>Swallowing Difficulty:</td><td>${responseData.swallowing_difficulty}</td></tr>
                <tr><td>Chest Pain:</td><td>${responseData.chest_pain}</td></tr>
  
            `;
            } else {
                document.getElementById(responseId).innerHTML = "Error: No prediction data available.";
            }

            document.getElementById('report-modal').style.display = 'flex';
            const today = new Date();
            document.getElementById('report-date').innerText = `${today.getDate()}-${today.getMonth() + 1}-${today.getFullYear()}`;

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
}})
    .catch(error => {
        document.getElementById(responseId).innerHTML = "Error: " + error.message;
    });
}



function handleImageOnly(selectedOption, token, modelMap) {
    const fileInput = document.getElementById(`file-input${optionNumber}`);
    if (!fileInput?.files[0]) {
        alert("Please upload an image for diagnosis."); // Message translated
        return;
    }

    const file = fileInput.files[0];
    const allowedTypes = ["image/jpeg", "image/png"]; // Explicitly excludes SVG
    const maxSize = 5 * 1024 * 1024; // 5MB

    if (!allowedTypes.includes(file.type)) {
        // Alert specifically if SVG is attempted
        if (file.type === "image/svg+xml") {
             alert("Invalid file type: SVG files are not allowed due to security risks. Please upload a valid image file (JPEG, PNG, GIF, WebP).");
        } else {
             alert("Invalid file type. Please upload an image file (JPEG, PNG, GIF, WebP).");
        }
        return;
    }
    if (file.size > maxSize) {
        alert("File size is too large. The maximum allowed size is 5MB.");
        return;
    }

    const loader = document.getElementById("loader");
    const resultDiv = document.getElementById("diagnosis-result"); // This div seems unused after initial hide
    const resultText = document.getElementById("result-text"); // This element seems unused
    const reportModal = document.getElementById("report-modal");

    if(loader) loader.style.display = "block";
    if (resultDiv) resultDiv.style.display = "none"; // Check if element exists
    if (reportModal) reportModal.style.display = "none"; // Hide previous report if any

    const formData = new FormData();
    formData.append("image", file);
    formData.append("id", modelMap[selectedOption]);

    fetch("/upload-image", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": token }, // CSRF token included
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            // Handle HTTP errors (e.g., 404, 500)
            throw new Error(`Server responded with status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if(loader) loader.style.display = "none";
        console.log("API Response:", data);

        const responseData = data.saved_record;
        if (responseData) {
            // Security: Use textContent instead of innerHTML to prevent XSS
            safelySetTextContent("Patient_Name", responseData.patient_name);
            safelySetTextContent("Patient_Age", responseData.patient_age);
            safelySetTextContent("Patient_Gender", responseData.gender);
            safelySetTextContent("Diagnosis_Check", responseData.diagnosis_check);
            safelySetTextContent("report-expected-level", responseData.expected_level);

            // Security: Build report content safely using textContent
            const reportContentEl = document.getElementById("report-content");
            if (reportContentEl) {
                reportContentEl.innerHTML = ""; // Clear previous content
                addSafeTableRow(reportContentEl, "Confidence", responseData.confidence);
                if (responseData.advise) {
                    addSafeTableRow(reportContentEl, "Advice", responseData.advise); // Assume advice is safe text
                }
            }

            // Security: Ensure the image path is safe (server-side validation preferred)
            // CRITICAL: Also block potentially malicious data: URLs, especially for SVGs.
            const reportImageEl = document.getElementById("report-image");
            if (reportImageEl && data.saved_record.image_path) {
                const imagePath = String(data.saved_record.image_path);

                // Block data: URLs entirely as a precaution, especially SVG which can contain scripts.
                if (imagePath.toLowerCase().startsWith("data:")) {
                    console.error("Security Alert: data: URL detected and blocked for image source:", imagePath.substring(0, 100) + "..."); // Log prefix
                    reportImageEl.alt = "Invalid image source (data: URL blocked)";
                    reportImageEl.src = ""; // Clear potentially harmful src
                    reportImageEl.style.display = "none";
                // Basic check for path traversal or unexpected protocols (relative paths might be okay depending on context, but absolute /public/ is expected here)
                } else if (imagePath.startsWith("/") || imagePath.includes("..")) {
                     console.error("Invalid image path received:", imagePath);
                     reportImageEl.alt = "Invalid image path";
                     reportImageEl.src = ""; // Clear potentially harmful src
                     reportImageEl.style.display = "none";
                } else {
                     // Assuming server provides a safe relative path within /public/
                     reportImageEl.src = "/public/" + imagePath;
                     reportImageEl.alt = "Report Image"; // Add alt text
                     reportImageEl.style.display = "block"; // Ensure image is visible
                }
            } else if (reportImageEl) {
                 reportImageEl.alt = "Image Not Available";
                 reportImageEl.src = "";
                 reportImageEl.style.display = "none"; // Hide if no image
            }

            const today = new Date();
            safelySetTextContent("report-date", `${today.getDate()}-${today.getMonth() + 1}-${today.getFullYear()}`);

            if (reportModal) reportModal.style.display = "flex";

            // Manage event listeners to avoid leaks
            const closeBtn = document.getElementById("close-report-modal");
            const downloadBtn = document.getElementById("download-pdf");

            const closeHandler = () => {
                if (reportModal) reportModal.style.display = "none";
            };
            const downloadHandler = () => {
                const element = document.getElementById("report-area");
                if (!element || !downloadBtn || !closeBtn) return;

                // Temporarily hide buttons
                downloadBtn.style.display = "none";
                closeBtn.style.display = "none";

                const opt = {
                    margin: 0,
                    filename: "Patient_Report.pdf",
                    image: { type: "jpeg", quality: 1 },
                    // Security: Ensure 'report-area' content is safe before exporting
                    // Since we use textContent above, the content should generally be safe.
                    html2canvas: { scale: 4, useCORS: true, logging: false }, // Disable logging for cleaner console
                    jsPDF: { unit: "mm", format: "a4", orientation: "portrait" }
                };

                html2pdf()
                    .set(opt)
                    .from(element)
                    .save()
                    .then(() => {
                        // Show buttons again
                        downloadBtn.style.display = "flex";
                        closeBtn.style.display = "block";
                    })
                    .catch((error) => {
                        console.error("Error generating PDF:", error); // Log detailed error
                        alert("An error occurred while generating the PDF. Please try again."); // User-friendly message
                        // Show buttons again even on failure
                        downloadBtn.style.display = "flex";
                        closeBtn.style.display = "block";
                    });
            };

            // Remove old listeners before adding new ones (to prevent multiple attachments)
            if (closeBtn) {
                closeBtn.removeEventListener("click", closeHandler);
                closeBtn.addEventListener("click", closeHandler);
            }
            if (downloadBtn) {
                downloadBtn.removeEventListener("click", downloadHandler);
                downloadBtn.addEventListener("click", downloadHandler);
            }

        } else {
            alert("No data returned from the server."); // Message translated
        }
    })
    .catch(error => {
        if(loader) loader.style.display = "none";
        console.error("Fetch Error:", error); // Log detailed error
        alert("An error occurred while processing your request: " + error.message); // More specific user message
    });
}
