// function uploadImage(model,id2) {

//     var image_input = document.getElementById(id2);
//     var id = model
//     if (!image_input.files.length) {
//         alert("Please select an image!");
//         return;
//     }

//     var formData = new FormData();
//     formData.append("image", image_input.files[0]);

//     var xhr = new XMLHttpRequest();

//     xhr.onreadystatechange = function () {
//         if (xhr.readyState === 4) {
//             if (xhr.status === 200) {
//                 document.getElementById("response").innerHTML = xhr.responseText;
//             } else {
//                 alert("Error uploading image: " + xhr.status);
//             }
//         }
//     };

//     xhr.open("POST", "backend/upload.php?id=" + id, true);
//     xhr.send(formData);
// }
