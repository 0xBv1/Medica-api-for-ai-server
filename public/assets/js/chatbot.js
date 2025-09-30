// Modified Chatbox class with new MediaRecorder functionality and updated API endpoint
class Chatbox {
    constructor() {
        console.log("Chatbox constructor called");
        this.args = {
            openButton: document.querySelector(".chatbox__button"),
            chatBox: document.querySelector(".chatbox__support"),
            sendButton: document.querySelector(".send__button"),
            inputField: document.querySelector(".chatbox__input")
        };
        console.log("Chatbox args initialized:", this.args);

        this.state = false;
        this.messages = [];
        this.savedResponse = ""; // To store conversation history for the backend
        this.laravelApiBaseUrl = "/chatbot/"; // Updated API base URL
        this.csrfToken = document.querySelector("meta[name=\'csrf-token\']")?.getAttribute("content");
        console.log("CSRF Token:", this.csrfToken);

        this.mediaRecorder = null;
        this.audioChunks = [];
        this.isRecordingActive = false;

        try {
            this.validateDOMElements();
            this.clearInputField();
            this.initNewAudioManager();
            this.display(); // Call display to attach event listeners
        } catch (error) {
            console.error("Initialization error:", error);
        }
    }

    validateDOMElements() {
        console.log("validateDOMElements called");
        for (const [key, el] of Object.entries(this.args)) {
            if (!el) {
                console.error(`Missing required DOM element: ${key}`);
                throw new Error(`Missing required DOM element: ${key}`);
            }
        }
        console.log("DOM elements validated successfully");
    }

    display() {
        console.log("display called");
        const { openButton, chatBox, sendButton, inputField } = this.args;

        if (openButton) {
            console.log("Attaching click listener to openButton");
            openButton.addEventListener("click", () => this.toggleState(chatBox));
        }

        if (inputField) {
            console.log("Attaching keyup listener to inputField");
            inputField.addEventListener("keyup", ({ key }) => {
                console.log(`Key pressed: ${key}`);
                if (key === "Enter" && inputField.value.trim() !== "") {
                    console.log("Enter key pressed, calling onSendButton");
                    this.onSendButton(chatBox);
                }
            });

            inputField.addEventListener("input", () => {
                console.log("Input field value changed");
                if (!this.isRecordingActive) {
                    this.updateSendButtonIcon();
                }
            });
        }
        this.updateSendButtonIcon(); // Initial icon state
    }

    clearInputField() {
        console.log("clearInputField called");
        if (this.args.inputField) {
            this.args.inputField.value = "";
        }
    }

    toggleState(chatbox) {
        console.log("toggleState called");
        if (!chatbox) return;
        this.state = !this.state;
        console.log(`Chatbox state toggled to: ${this.state}`);
        if (this.state) {
            chatbox.style.visibility = "visible";
            chatbox.classList.add("chatbox--active");
        } else {
            chatbox.classList.remove("chatbox--active");
            setTimeout(() => {
                if (!this.state) {
                    chatbox.style.visibility = "hidden";
                }
            }, 400);
        }
    }

    updateSendButtonIcon() {
        console.log("updateSendButtonIcon called");
        const { sendButton, inputField } = this.args;
        if (!sendButton) return;

        if (this.isRecordingActive) {
            console.log("Setting stop icon");
            sendButton.innerHTML = 
                '<i class="fas fa-stop"></i>';
        } else if (inputField && inputField.value.trim() !== "") {
            console.log("Setting send icon");
            sendButton.innerHTML = 
                '<i class="fas fa-paper-plane"></i>';
        } else {
            console.log("Setting mic icon");
            sendButton.innerHTML = 
                '<i class="fas fa-microphone"></i>';
        }
    }

    initNewAudioManager() {
        console.log("initNewAudioManager called");
        const { sendButton, inputField, chatBox } = this.args;
        if (!chatBox) {
            console.error("Chatbox support element not found.");
            return;
        }
        const chatboxMessagesContainer = chatBox.querySelector(".chatbox__messages > div");
        if (!sendButton || !chatboxMessagesContainer) {
            console.error("Required elements for voice recording not found.");
            return;
        }

        sendButton.addEventListener("click", async () => {
            console.log("Send button clicked");
            const inputText = inputField ? inputField.value.trim() : "";

            if (this.isRecordingActive) {
                console.log("Stopping recording");
                if (this.mediaRecorder && this.mediaRecorder.state === "recording") {
                    this.mediaRecorder.stop();
                }
            } else if (inputText !== "") {
                console.log("Sending text message");
                this.onSendButton(chatBox);
            } else {
                console.log("Starting recording");
                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    alert("Your browser does not support audio recording.");
                    this.updateSendButtonIcon();
                    return;
                }
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                    this.mediaRecorder = new MediaRecorder(stream);
                    this.audioChunks = [];

                    this.mediaRecorder.ondataavailable = event => {
                        console.log("Audio data available");
                        this.audioChunks.push(event.data);
                    };

                    this.mediaRecorder.onstart = () => {
                        console.log("Recording started");
                        this.isRecordingActive = true;
                        this.updateSendButtonIcon();
                        this.addTemporaryMessage(chatboxMessagesContainer, "Recording audio...");
                    };

                    this.mediaRecorder.onstop = async () => {
                        console.log("Recording stopped");
                        this.isRecordingActive = false;
                        this.updateSendButtonIcon();
                        this.removeTemporaryMessage(chatboxMessagesContainer, "Recording audio...");

                        const audioBlob = new Blob(this.audioChunks, { type: "audio/wav" });
                        stream.getTracks().forEach(track => track.stop());

                        if (this.audioChunks.length === 0) {
                            console.warn("No audio data recorded.");
                            this.addMessageToChat("Sam", "I didn't catch that. Could you please try again?", chatBox, false);
                            return;
                        }

                        try {
                            console.log("Processing audio...");
                            this.addTemporaryMessage(chatboxMessagesContainer, "Processing audio...");
                            const sttResponse = await this.speechToText(audioBlob);
                            this.removeTemporaryMessage(chatboxMessagesContainer, "Processing audio...");

                            const userTranscription = sttResponse.gemini_response;
                            // this.savedResponse = sttResponse.Saved_response;
                            console.log(`User transcription: ${userTranscription}`);

                            if (true) {
                                this.addMessageToChat("User", "record send ", chatBox, false);
                                this.addTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
                                const tttResponse = await this.textToText(userTranscription);
                                this.removeTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
                                // this.savedResponse = tttResponse.Saved_response;
                                this.addMessageToChat("Sam", tttResponse.gemini_response, chatBox, false, tttResponse.gemini_response);
                                this.speakText(tttResponse.gemini_response)

                            } else {
                                this.addMessageToChat("Sam", "I couldn't understand the audio. Please try again.", chatBox, false);
                            }
                        } catch (error) {
                            console.error("Error during speech processing:", error);
                            this.removeTemporaryMessage(chatboxMessagesContainer, "Processing audio...");
                            this.removeTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
                            this.addMessageToChat("Sam", `Sorry, an error occurred: ${error.message}`, chatBox, false);
                        }
                    };
                    this.mediaRecorder.start();
                } catch (err) {
                    console.error("Error accessing microphone:", err);
                    alert("Could not access microphone. Please ensure permission is granted.");
                    this.isRecordingActive = false;
                    this.updateSendButtonIcon();
                    this.addMessageToChat("Sam", "Error: Could not access microphone.", chatBox, false);
                }
            }
        });
    }

    addTemporaryMessage(container, text) {
        console.log(`Adding temporary message: ${text}`);
        const tempMsg = document.createElement("div");
        tempMsg.classList.add("messages__item", "messages__item--operator", "temporary-message");
        tempMsg.textContent = text;
        container.appendChild(tempMsg);
        container.scrollTop = container.scrollHeight;
    }

    removeTemporaryMessage(container, text) {
        console.log(`Removing temporary message: ${text}`);
        const messages = container.querySelectorAll(".temporary-message");
        messages.forEach(msg => {
            if (msg.textContent === text) {
                msg.remove();
            }
        });
    }

    onSendButton(chatbox) {
        console.log("onSendButton called");
        const textField = this.args.inputField;
        if (!textField) return;
        let text1 = textField.value.trim();
        if (text1 === "") return;

        this.clearInputField();
        this.updateSendButtonIcon();
        this.addMessageToChat("User", text1, chatbox, true);
        const chatboxMessagesContainer = chatbox.querySelector(".chatbox__messages > div");
        this.addTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
        this.textToText(text1).then(response => {
            this.removeTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
            // هنا نقوم فقط بإضافة الرسالة التي تحتوي على 'message' من response وليس 'Saved_response'
            if (response.gemini_response) {
                this.addMessageToChat("Sam", response.gemini_response, chatbox, false, response.gemini_response);
            }
        }).catch(error => {
            this.removeTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
            console.error("Error in textToText:", error);
            this.addMessageToChat("Sam", `Sorry, an error occurred: ${error.message}`, chatbox, false);
        });
    }

    async textToText(message) {
        console.log(`Sending text to text API: ${message}`);
        const url = `${this.laravelApiBaseUrl}text-to-text`;
        const payload = { message: message, Saved_response: this.savedResponse };
        try {
            const response = await fetch(url, {
                method: "POST",
                body: JSON.stringify(payload),
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": this.csrfToken
                }
            });
            if (!response.ok) {
                let errorData = { error: `HTTP error! status: ${response.status}` };
                try { errorData = await response.json(); } catch (e) { /* Ignore if not JSON */ }
                throw new Error(errorData.error || `Request failed with status ${response.status}`);
            }
            const data = await response.json();
            console.log("Received response from textToText API:", data);
            return data;
        } catch (error) {
            console.error("Error during textToText API request:", error);
            throw error;
        }
    }

    async speechToText(audioBlob) {
        console.log("Sending audio to speech-to-text API");
        const url = `${this.laravelApiBaseUrl}speech-to-text`;
        const formData = new FormData();
        formData.append("audiofile", audioBlob, "recording.wav");
        formData.append("Saved_response", this.savedResponse);

        try {
            const response = await fetch(url, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": this.csrfToken
                }
            });
            if (!response.ok) {
                let errorData = { error: `HTTP error! status: ${response.status}` };
                try { errorData = await response.json(); } catch (e) { /* Ignore if not JSON */ }
                throw new Error(errorData.error || `Request failed with status ${response.status}`);
            }
            const data = await response.json();
            console.log("Received response from speechToText API:", data);
            return data;
        } catch (error) {
            console.error("Error during speechToText API request:", error);
            throw error;
        }
    }
    
    addMessageToChat(name, message, chatbox, isUserMessage, botResponseTextForTTS) {
        console.log(`Adding message to chat: Sender=${name}, Message=${message}, isUser=${isUserMessage}`);
        this.messages.push({ name, message });
        this.updateChatText(chatbox, botResponseTextForTTS);
    }

    updateChatText(chatbox, botResponseTextForTTS) {
        console.log("Updating chat text");
        if (!chatbox) return;
        const chatMessagesContainer = chatbox.querySelector(".chatbox__messages > div");
        if (!chatMessagesContainer) return;

        chatMessagesContainer.innerHTML = "";
        this.messages.forEach((item, index) => {
            let messageDiv = document.createElement("div");
            messageDiv.classList.add("messages__item");
            messageDiv.classList.add(item.name === "Sam" ? "messages__item--visitor" : "messages__item--operator");
            messageDiv.textContent = item.message;
            chatMessagesContainer.appendChild(messageDiv);

            if (item.name === "Sam" && index === this.messages.length - 1 && botResponseTextForTTS) {
                let readButton = document.createElement("button");
                readButton.textContent = "🔊";
                readButton.classList.add("read-button");
                readButton.style.marginLeft = "10px";
                readButton.style.border = "none";
                readButton.style.background = "transparent";
                readButton.style.cursor = "pointer";
                readButton.setAttribute("aria-label", "Read message aloud");
                readButton.addEventListener("click", () => this.speakText(botResponseTextForTTS));
                messageDiv.appendChild(readButton);
            }
        });

        let lastMessageDiv = chatMessagesContainer.lastElementChild;
        if (lastMessageDiv) {
            lastMessageDiv.style.marginBottom = "30px";
        }

        setTimeout(() => {
            chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
        }, 100);
    }

    speakText(text) {
        console.log(`Speaking text: ${text}`);
        if (typeof speechSynthesis === 'undefined' || typeof SpeechSynthesisUtterance === 'undefined') {
            alert("Sorry, your browser does not support text-to-speech.");
            return;
        }
        if (speechSynthesis.speaking) {
            speechSynthesis.cancel();
        }
        let utterance = new SpeechSynthesisUtterance(text);
        speechSynthesis.speak(utterance);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const chatBox= new Chatbox();
});

// // Chatbox class modified for Laravel integration
// class Chatbox {
//     constructor() {
//         this.args = {
//             openButton: document.querySelector(".chatbox__button"),
//             chatBox: document.querySelector(".chatbox__support"),
//             sendButton: document.querySelector(".send__button"),
//             inputField: document.querySelector(".chatbox__input")
//         };

//         this.state = false;
//         this.messages = [];
//         this.savedResponse = ""; // To store conversation history for the backend
//         // API base URL will be relative to the Laravel app's domain, assuming routes are like /chatbot/action
//         this.laravelApiBaseUrl = "/chatbot/"; 
//         this.csrfToken = document.querySelector("meta[name='csrf-token']")?.getAttribute("content");

//         this.mediaRecorder = null;
//         this.audioChunks = [];
//         this.isRecordingActive = false;

//         if (this.args.inputField) {
//             this.clearInputField();
//         }
//         this.initNewAudioManager();
//         this.display();
//     }

//     display() {
//         const { openButton, chatBox, sendButton, inputField } = this.args;

//         if (openButton) {
//             openButton.addEventListener("click", () => this.toggleState(chatBox));
//         }

//         if (inputField) {
//             inputField.addEventListener("keyup", ({ key }) => {
//                 if (key === "Enter" && inputField.value.trim() !== "") {
//                     this.onSendButton(chatBox);
//                 }
//             });

//             inputField.addEventListener("input", () => {
//                 if (!this.isRecordingActive) {
//                     this.updateSendButtonIcon();
//                 }
//             });
//         }
//         this.updateSendButtonIcon();
//     }

//     clearInputField() {
//         if (this.args.inputField) {
//             this.args.inputField.value = "";
//         }
//     }

//     toggleState(chatbox) {
//         if (!chatbox) return;
//         this.state = !this.state;
//         if (this.state) {
//             chatbox.style.visibility = "visible";
//             chatbox.classList.add("chatbox--active");
//         } else {
//             chatbox.classList.remove("chatbox--active");
//             setTimeout(() => {
//                 if (!this.state) {
//                     chatbox.style.visibility = "hidden";
//                 }
//             }, 400);
//         }
//     }

//     updateSendButtonIcon() {
//         const { sendButton, inputField } = this.args;
//         if (!sendButton) return;

//         if (this.isRecordingActive) {
//             sendButton.innerHTML = '<i class="fas fa-stop"></i>';
//         } else if (inputField && inputField.value.trim() !== "") {
//             sendButton.innerHTML = '<i class="fas fa-paper-plane"></i>';
//         } else {
//             sendButton.innerHTML = '<i class="fas fa-microphone"></i>';
//         }
//     }

//     initNewAudioManager() {
//         const { sendButton, inputField, chatBox } = this.args;
//         if (!chatBox) {
//             console.error("Chatbox support element not found.");
//             return;
//         }
//         const chatboxMessagesContainer = chatBox.querySelector(".chatbox__messages > div");
//         if (!sendButton || !chatboxMessagesContainer) {
//             console.error("Required elements for voice recording not found.");
//             return;
//         }

//         sendButton.addEventListener("click", async () => {
//             const inputText = inputField ? inputField.value.trim() : "";

//             if (this.isRecordingActive) {
//                 if (this.mediaRecorder && this.mediaRecorder.state === "recording") {
//                     this.mediaRecorder.stop();
//                 }
//             } else if (inputText !== "") {
//                 this.onSendButton(chatBox);
//             } else {
//                 if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
//                     alert("Your browser does not support audio recording.");
//                     this.updateSendButtonIcon();
//                     return;
//                 }
//                 try {
//                     const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
//                     this.mediaRecorder = new MediaRecorder(stream);
//                     this.audioChunks = [];

//                     this.mediaRecorder.ondataavailable = event => {
//                         this.audioChunks.push(event.data);
//                     };

//                     this.mediaRecorder.onstart = () => {
//                         this.isRecordingActive = true;
//                         this.updateSendButtonIcon();
//                         this.addTemporaryMessage(chatboxMessagesContainer, "Recording audio...");
//                     };

//                     this.mediaRecorder.onstop = async () => {
//                         this.isRecordingActive = false;
//                         this.updateSendButtonIcon();
//                         this.removeTemporaryMessage(chatboxMessagesContainer, "Recording audio...");

//                         const audioBlob = new Blob(this.audioChunks, { type: "audio/wav" });
//                         stream.getTracks().forEach(track => track.stop());

//                         if (this.audioChunks.length === 0) {
//                             console.warn("No audio data recorded.");
//                             this.addMessageToChat("Sam", "I didn't catch that. Could you please try again?", chatBox, false);
//                             return;
//                         }

//                         try {
//                             this.addTemporaryMessage(chatboxMessagesContainer, "Processing audio...");
//                             const sttResponse = await this.speechToText(audioBlob);
//                             this.removeTemporaryMessage(chatboxMessagesContainer, "Processing audio...");

//                             // Assuming Laravel controller returns the same structure as the Python API
//                             const userTranscription = sttResponse.gemini_response;
//                             this.savedResponse = sttResponse.Saved_response;

//                             if (userTranscription && userTranscription.trim() !== "") {
//                                 this.addMessageToChat("User", userTranscription, chatBox, true);
//                                 this.addTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
//                                 const tttResponse = await this.textToText(userTranscription);
//                                 this.removeTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
//                                 this.savedResponse = tttResponse.Saved_response;
//                                 this.addMessageToChat("Sam", tttResponse.gemini_response, chatBox, false, tttResponse.gemini_response);
//                             } else {
//                                 this.addMessageToChat("Sam", "I couldn't understand the audio. Please try again.", chatBox, false);
//                             }
//                         } catch (error) {
//                             console.error("Error during speech processing:", error);
//                             this.removeTemporaryMessage(chatboxMessagesContainer, "Processing audio...");
//                             this.removeTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
//                             this.addMessageToChat("Sam", `Sorry, an error occurred: ${error.message}`, chatBox, false);
//                         }
//                     };
//                     this.mediaRecorder.start();
//                 } catch (err) {
//                     console.error("Error accessing microphone:", err);
//                     alert("Could not access microphone. Please ensure permission is granted.");
//                     this.isRecordingActive = false;
//                     this.updateSendButtonIcon();
//                     this.addMessageToChat("Sam", "Error: Could not access microphone.", chatBox, false);
//                 }
//             }
//         });
//     }

//     addTemporaryMessage(container, text) {
//         const tempMsg = document.createElement("div");
//         tempMsg.classList.add("messages__item", "messages__item--operator", "temporary-message");
//         tempMsg.textContent = text;
//         container.appendChild(tempMsg);
//         container.scrollTop = container.scrollHeight;
//     }

//     removeTemporaryMessage(container, text) {
//         const messages = container.querySelectorAll(".temporary-message");
//         messages.forEach(msg => {
//             if (msg.textContent === text) {
//                 msg.remove();
//             }
//         });
//     }

//     onSendButton(chatbox) {
//         const textField = this.args.inputField;
//         if (!textField) return;
//         let text1 = textField.value.trim();
//         if (text1 === "") return;

//         this.clearInputField();
//         this.updateSendButtonIcon();
//         this.addMessageToChat("User", text1, chatbox, true);
//         const chatboxMessagesContainer = chatBox.querySelector(".chatbox__messages > div");

//         this.addTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
//         this.textToText(text1).then(response => {
//             this.removeTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
//             this.savedResponse = response.Saved_response;
//             this.addMessageToChat("Sam", response.gemini_response, chatbox, false, response.gemini_response);
//         }).catch(error => {
//             this.removeTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
//             console.error("Error in textToText:", error);
//             this.addMessageToChat("Sam", `Sorry, an error occurred: ${error.message}`, chatbox, false);
//         });
//     }

//     async textToText(message) {
//         const url = `${this.laravelApiBaseUrl}text-to-text`; // Updated to Laravel route
//         const payload = { message: message, Saved_response: this.savedResponse };
//         try {
//             const response = await fetch(url, {
//                 method: "POST",
//                 body: JSON.stringify(payload),
//                 headers: {
//                     "Content-Type": "application/json",
//                     "X-CSRF-TOKEN": this.csrfToken
//                 }
//             });
//             if (!response.ok) {
//                 let errorData = { error: `HTTP error! status: ${response.status}` };
//                 try { errorData = await response.json(); } catch (e) { /* Ignore if not JSON */ }
//                 throw new Error(errorData.error || `Request failed with status ${response.status}`);
//             }
//             const data = await response.json();
//             return data;
//         } catch (error) {
//             console.error("Error during textToText API request:", error);
//             throw error;
//         }
//     }

//     async speechToText(audioBlob) {
//         const url = `${this.laravelApiBaseUrl}speech-to-text`; // Updated to Laravel route
//         const formData = new FormData();
//         formData.append("audiofile", audioBlob, "recording.wav");
//         formData.append("Saved_response", this.savedResponse);
//         // CSRF token is typically not needed for FormData POSTs if session is cookie-based and SameSite is handled, 
//         // but if your Laravel setup strictly requires it for all POSTs, you might need to append it to formData as well.
//         // formData.append("_token", this.csrfToken); // Or handle it as per your Laravel setup for file uploads.

//         try {
//             const response = await fetch(url, {
//                 method: "POST",
//                 body: formData,
//                 headers: {
//                     // "Content-Type": "multipart/form-data" is set automatically by browser for FormData
//                     "X-CSRF-TOKEN": this.csrfToken // Add CSRF token for file uploads too
//                 }
//             });
//             if (!response.ok) {
//                 let errorData = { error: `HTTP error! status: ${response.status}` };
//                 try { errorData = await response.json(); } catch (e) { /* Ignore if not JSON */ }
//                 throw new Error(errorData.error || `Request failed with status ${response.status}`);
//             }
//             const data = await response.json();
//             return data;
//         } catch (error) {
//             console.error("Error during speechToText API request:", error);
//             throw error;
//         }
//     }
    
//     addMessageToChat(name, message, chatbox, isUserMessage, botResponseTextForTTS) {
//         this.messages.push({ name, message });
//         this.updateChatText(chatbox, botResponseTextForTTS);
//     }

//     updateChatText(chatbox, botResponseTextForTTS) {
//         if (!chatbox) return;
//         const chatMessagesContainer = chatbox.querySelector(".chatbox__messages > div");
//         if (!chatMessagesContainer) return;

//         chatMessagesContainer.innerHTML = "";
//         this.messages.forEach((item, index) => {
//             let messageDiv = document.createElement("div");
//             messageDiv.classList.add("messages__item");
//             messageDiv.classList.add(item.name === "Sam" ? "messages__item--visitor" : "messages__item--operator");
//             messageDiv.textContent = item.message;
//             chatMessagesContainer.appendChild(messageDiv);

//             if (item.name === "Sam" && index === this.messages.length - 1 && botResponseTextForTTS) {
//                 let readButton = document.createElement("button");
//                 readButton.textContent = "🔊";
//                 readButton.classList.add("read-button");
//                 readButton.style.marginLeft = "10px";
//                 readButton.style.border = "none";
//                 readButton.style.background = "transparent";
//                 readButton.style.cursor = "pointer";
//                 readButton.setAttribute("aria-label", "Read message aloud");
//                 readButton.addEventListener("click", () => this.speakText(botResponseTextForTTS));
//                 messageDiv.appendChild(readButton);
//             }
//         });

//         let lastMessageDiv = chatMessagesContainer.lastElementChild;
//         if (lastMessageDiv) {
//             lastMessageDiv.style.marginBottom = "30px";
//         }

//         setTimeout(() => {
//             chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
//         }, 100);
//     }

//     speakText(text) {
//         if (typeof speechSynthesis === 'undefined' || typeof SpeechSynthesisUtterance === 'undefined') {
//             alert("Sorry, your browser does not support text-to-speech.");
//             return;
//         }
//         if (speechSynthesis.speaking) {
//             speechSynthesis.cancel();
//         }
//         let utterance = new SpeechSynthesisUtterance(text);
//         speechSynthesis.speak(utterance);
//     }
// }

// document.addEventListener('DOMContentLoaded', () => {
//     const chatbox = new Chatbox();
// });

