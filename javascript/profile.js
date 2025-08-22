const uploader = document.getElementById("uploadProfile");
const profilePics = document.getElementById("profilePic");

uploader.addEventListener("change", function () {
  const file = this.files[0];
  if (file) {
    let reader = new FileReader();
    reader.onload = function (e) {
      profilePics.src = e.target.result; // show preview
    };
    reader.readAsDataURL(file);
  }
});
const coverUploader = document.getElementById("uploadCoverProfile");
const profileCoverPics = document.getElementById("profileCover");

coverUploader.addEventListener("change", function () {
  const file = this.files[0];
  if (file) {
    let reader = new FileReader();
    reader.onload = function (e) {
      profileCoverPics.src = e.target.result; // show preview
    };
    reader.readAsDataURL(file);
  }
});