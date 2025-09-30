
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
//         this.savedResponse = "";
//         this.laravelApiBaseUrl = "/chatbot/";
//         this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//         this.mediaRecorder = null;
//         this.audioChunks = [];
//         this.isRecordingActive = false;

//         try {
//             this.validateDOMElements();
//             this.clearInputField();
//             this.initNewAudioManager();
//             this.display();
//         } catch (error) {
//             console.error("Initialization error:", error);
//         }
//     }

//     // validateDOMElements() {
//     //     for (const [key, el] of Object.entries(this.args)) {
//     //         if (!el) {
//     //             throw new Error(`Missing required DOM element: ${key}`);
//     //         }
//     //     }
//     // }

//     display() {
//         const { openButton, chatBox, sendButton, inputField } = this.args;

//         openButton.addEventListener("click", () => this.toggleState(chatBox));

//         inputField.addEventListener("keyup", ({ key }) => {
//             if (key === "Enter" && inputField.value.trim() !== "") {
//                 this.onSendButton(chatBox);
//             }
//         });

//         inputField.addEventListener("input", () => {
//             if (!this.isRecordingActive) {
//                 this.updateSendButtonIcon();
//             }
//         });

//         this.updateSendButtonIcon();
//     }

//     clearInputField() {
//         this.args.inputField.value = "";
//     }

//     toggleState(chatbox) {
//         this.state = !this.state;
//         chatbox.style.visibility = this.state ? "visible" : "hidden";
//         chatbox.classList.toggle("chatbox--active", this.state);
//     }

//     updateSendButtonIcon() {
//         const { sendButton, inputField } = this.args;

//         if (this.isRecordingActive) {
//             sendButton.innerHTML = '<i class="fas fa-stop"></i>';
//         } else if (inputField.value.trim() !== "") {
//             sendButton.innerHTML = '<i class="fas fa-paper-plane"></i>';
//         } else {
//             sendButton.innerHTML = '<i class="fas fa-microphone"></i>';
//         }
//     }

//     initNewAudioManager() {
//         const { sendButton, inputField, chatBox } = this.args;
//         const messagesContainer = chatBox.querySelector(".chatbox__messages > div");

//         sendButton.addEventListener("click", async () => {
//             const inputText = inputField.value.trim();

//             if (this.isRecordingActive && this.mediaRecorder?.state === "recording") {
//                 this.mediaRecorder.stop();
//                 return;
//             }

//             if (inputText !== "") {
//                 this.onSendButton(chatBox);
//                 return;
//             }

//             if (!navigator.mediaDevices?.getUserMedia) {
//                 alert("Your browser does not support audio recording.");
//                 return;
//             }

//             try {
//                 const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
//                 this.mediaRecorder = new MediaRecorder(stream);
//                 this.audioChunks = [];

//                 this.mediaRecorder.ondataavailable = e => this.audioChunks.push(e.data);
//                 this.mediaRecorder.onstart = () => {
//                     this.isRecordingActive = true;
//                     this.updateSendButtonIcon();
//                     this.addTemporaryMessage(messagesContainer, "Recording audio...");
//                 };
//                 this.mediaRecorder.onstop = () => this.processRecordedAudio(stream, messagesContainer, chatBox);

//                 this.mediaRecorder.start();
//             } catch (err) {
//                 console.error("Microphone access error:", err);
//                 alert("Microphone access denied.");
//             }
//         });
//     }

//     addTemporaryMessage(container, text) {
//         const tempMsg = document.createElement("div");
//         tempMsg.className = "messages__item messages__item--operator temporary-message";
//         tempMsg.textContent = text;
//         container.appendChild(tempMsg);
//         container.scrollTop = container.scrollHeight;
//     }

//     removeTemporaryMessage(container, text) {
//         container.querySelectorAll(".temporary-message").forEach(msg => {
//             if (msg.textContent === text) msg.remove();
//         });
//     }

//     async processRecordedAudio(stream, messagesContainer, chatBox) {
//         this.isRecordingActive = false;
//         this.updateSendButtonIcon();
//         this.removeTemporaryMessage(messagesContainer, "Recording audio...");

//         stream.getTracks().forEach(track => track.stop());

//         if (this.audioChunks.length === 0) {
//             console.warn("No audio data recorded.");
//             this.addMessageToChat("Sam", "I didn't catch that. Could you please try again?", chatBox, false);
//             return;
//         }

//         const audioBlob = new Blob(this.audioChunks, { type: "audio/wav" });
//         this.addTemporaryMessage(messagesContainer, "Processing audio...");

//         try {
//             const sttResponse = await this.speechToText(audioBlob);
//             this.removeTemporaryMessage(messagesContainer, "Processing audio...");

//             const userText = sttResponse.gemini_response;
//             this.savedResponse = sttResponse.Saved_response;

//             if (userText?.trim()) {
//                 this.addMessageToChat("User", userText, chatBox, false);
//                 this.addTemporaryMessage(messagesContainer, "Sam is thinking...");
//                 const tttResponse = await this.textToText(userText);
//                 this.removeTemporaryMessage(messagesContainer, "Sam is thinking...");

//                 this.savedResponse = tttResponse.Saved_response;
//                 this.addMessageToChat("Sam", tttResponse.gemini_response, chatBox, true);
//             } else {
//                 this.addMessageToChat("Sam", "I couldn't understand the audio. Please try again.", chatBox, false);
//             }
//         } catch (error) {
//             console.error("Speech processing error:", error);
//             this.removeTemporaryMessage(messagesContainer, "Processing audio...");
//             this.removeTemporaryMessage(messagesContainer, "Sam is thinking...");
//             this.addMessageToChat("Sam", `Error: ${error.message}`, chatBox, false);
//         }
//     }

//     onSendButton(chatbox) {
//         const text = this.args.inputField.value.trim();
//         if (!text) return;

//         this.clearInputField();
//         this.updateSendButtonIcon();
//         this.addMessageToChat("User", text, chatbox, false);

//         const messagesContainer = chatbox.querySelector(".chatbox__messages > div");
//         this.addTemporaryMessage(messagesContainer, "Sam is thinking...");

//         this.textToText(text)
//             .then(response => {
//                 this.removeTemporaryMessage(messagesContainer, "Sam is thinking...");
//                 this.savedResponse = response.Saved_response;
//                 this.addMessageToChat("Sam", response.gemini_response, chatbox, true);
//             })
//             .catch(error => {
//                 this.removeTemporaryMessage(messagesContainer, "Sam is thinking...");
//                 console.error("Text-to-text error:", error);
//                 this.addMessageToChat("Sam", `Error: ${error.message}`, chatbox, false);
//             });
//     }

//     async textToText(message) {
//         const response = await fetch(`${this.laravelApiBaseUrl}text-to-text`, {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json",
//                 "X-CSRF-TOKEN": this.csrfToken
//             },
//             body: JSON.stringify({ message, Saved_response: this.savedResponse })
//         });

//         if (!response.ok) {
//             const errorData = await response.json().catch(() => ({ error: `HTTP error: ${response.status}` }));
//             throw new Error(errorData.error);
//         }

//         return response.json();
//     }

//     async speechToText(audioBlob) {
//         const formData = new FormData();
//         formData.append("audiofile", audioBlob, "recording.wav");
//         formData.append("Saved_response", this.savedResponse);

//         const response = await fetch(`${this.laravelApiBaseUrl}speech-to-text`, {
//             method: "POST",
//             headers: {
//                 "X-CSRF-TOKEN": this.csrfToken
//             },
//             body: formData
//         });

//         if (!response.ok) {
//             const errorData = await response.json().catch(() => ({ error: `HTTP error: ${response.status}` }));
//             throw new Error(errorData.error);
//         }

//         return response.json();
//     }

//     addMessageToChat(sender, message, chatBox, isUser, rawResponse = null) {
//         const container = chatBox.querySelector(".chatbox__messages > div");
//         const msg = document.createElement("div");
//         msg.className = `messages__item ${isUser ? "messages__item--visitor" : "messages__item--operator"}`;
//         msg.textContent = message;
//         if (rawResponse) msg.dataset.fullResponse = rawResponse;
//         container.appendChild(msg);
//         container.scrollTop = container.scrollHeight;
//     }
// }

// // Debug usage tip:
// window.chatbox = new Chatbox(); // to manually inspect and test from browser console
// // 













                                const tttResponse = await this.textToText(userTranscription);
                                this.removeTemporaryMessage(chatboxMessagesContainer, "Sam is thinking...");
                                // this.savedResponse = tttResponse.Saved_response;
                                this.addMessageToChat("Sam", tttResponse.gemini_response, chatBox, false, tttResponse.gemini_response);
                                this.speakText(tttResponse.gemini_response)