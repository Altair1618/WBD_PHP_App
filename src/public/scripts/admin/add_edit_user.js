var profilePicture = document.getElementById("profile-picture");
var profilePictureInput = document.getElementById("profile-picture-input");

profilePicture.addEventListener("click", function() {
  profilePictureInput.click();
})

function previewImage(uploader) {
  if (uploader.files && uploader.files[0]) {
    profilePicture.setAttribute("src", window.URL.createObjectURL(uploader.files[0]));
  }
}

profilePictureInput.addEventListener("change", function() {
  previewImage(this);
})
