
var oldPasswordInput = document.getElementById("old-password");
var newPasswordInput = document.getElementById("new-password");
var profilePicture = document.getElementById("profile-picture");
var profilePictureInput = document.getElementById("profile-picture-input");

newPasswordInput.addEventListener("input", function() {
  if (newPasswordInput.value.trim() !== "") {
    oldPasswordInput.setAttribute("required", "true");
  } else {
    oldPasswordInput.removeAttribute("required");
  }
});

oldPasswordInput.addEventListener("input", function() {
  if (oldPasswordInput.value.trim() !== "") {
    newPasswordInput.setAttribute("required", "true");
  } else {
    newPasswordInput.removeAttribute("required");
  }
});

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
