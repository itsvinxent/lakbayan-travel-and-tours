//selecting all required elements
let dropArea = document.querySelector(".drag-area"), olddropArea = dropArea.innerHTML;
let fileinput = $('<input/>').attr('type', 'file').attr('name', 'payment-proof').attr("id", "payment-proof").attr("style", "display: none;");

let file; //this is a global variable and we'll use it inside multiple functions

$(".file-upload .drag-area").on("click", "button", function() {
    $(".file-upload input").trigger('click'); //if user click on the button then the input also clicked
})

$(".file-upload").on("change", "input[type='file']", function () {
    file = null;
    //getting user select file and [0] this means if user select multiple files then we'll select only the first one
    file = this.files[0];
    // dropArea.classList.add("active");
    $(".drag-area").addClass("active");
    showFile(); //calling function
});
//If user Drag File Over DropArea
$(".file-upload").on("dragover", ".drag-area", function (event) {
    event.preventDefault(); //preventing from default behaviour
    event.stopPropagation();
    $(".drag-area").addClass("active");
    $(".drag-area header").text("Release to Upload File");
});
//If user leave dragged File from DropArea
$(".file-upload").on("dragleave", ".drag-area", function () {
    $(".drag-area").removeClass("active");
    $(".drag-area header").text("Drag & Drop to Upload File");
});
//If user drop File on DropArea
$(".file-upload .drag-area").on("drop", function (event) {
    file = null;
    event.preventDefault(); //preventing from default behaviour
    //getting user select file and [0] this means if user select multiple files then we'll select only the first one
    file = event.originalEvent.dataTransfer.files[0];
    showFile(); //calling function
});

function showFile() {
    let fileType = file.type; //getting selected file type
    let validExtensions = ["image/jpeg", "image/jpg", "image/png"]; //adding some valid image extensions in array
    if (validExtensions.includes(fileType)) { //if user selected file is an image file
        let fileReader = new FileReader(); //creating new FileReader object
        fileReader.onload = () => {
            let fileURL = fileReader.result; //passing user file source in fileURL variable

            let imgTag = `<img src="${fileURL}" alt="image">`; //creating an img tag and passing user selected file source inside src attribute
            let removeImage = `<div class="remove-image" style="background-color: #ED2939;">Remove Image</div>`;
            
            $('.drag-area').empty()
            $('.drag-area').html(imgTag + removeImage); //adding that created img tag inside dropArea container
    
            $(".drag-area .remove-image").on("click", function () {
                $('#payment-proof').remove();
                $(".drag-area").removeClass("active");
                $(".drag-area").empty();
                $(".drag-area").html(olddropArea);
                $("#upForm .file-upload").append(fileinput);
                file = undefined;

                $('#payment-proof')[0].value = '';

            });
        }
        fileReader.readAsDataURL(file);
    } else {
        alert("This is not an Image File!");
        // dropArea.classList.remove("active");
        $(".drag-area").removeClass("active");
        $(".drag-area header").text("Drag & Drop to Upload File");
    }
}
