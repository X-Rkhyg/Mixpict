const dropArea = document.getElementById("drop-area");
const chooseFile = document.getElementById("foto");
const imgPreview = document.getElementById("img-preview");

chooseFile.addEventListener("change", function () {
    getImgData();
});

function getImgData() {
    const files = chooseFile.files[0];
    if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
        imgPreview.style.display = "block";
        imgPreview.innerHTML = '<img src="' + this.result + '" />';
    });    
    }
}

dropArea.addEventListener("dragover", function (e) {
    e.preventDefault();
});
dropArea.addEventListener("drop", function (e) {
    e.preventDefault();
    chooseFile.files = e.dataTransfer.files;
    getImgData();
});