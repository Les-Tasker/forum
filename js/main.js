function boop() {
  var element = document.getElementById("upload-form-id");
  element.classList.add("animate");
}
function boop2() {
  var element = document.getElementById("upload-form-id");
  element.classList.remove("animate");
}
function cover() {
  var element = document.getElementById("upload-form-id2");
  element.classList.add("animate");
}
function cover2() {
  var element = document.getElementById("upload-form-id2");
  element.classList.remove("animate");
}
function topicnew() {
  var element = document.getElementById("postnewtopic");
  element.classList.add("animate");
}
function topicnew2() {
  var element = document.getElementById("postnewtopic");
  element.classList.remove("animate");
}

function bioedit() {
  var element = document.getElementById("bio-form");
  var element1 = document.getElementById("user-bio");
  var element2 = document.getElementById("edit-profile");
  element.classList.remove("hidden");
  element1.classList.add("hidden");
  element2.classList.add("hidden");
}
function biocancel() {
  var element = document.getElementById("bio-form");
  var element1 = document.getElementById("user-bio");
  var element2 = document.getElementById("edit-profile");
  element.classList.add("hidden");
  element1.classList.remove("hidden");
  element2.classList.remove("hidden");
}
function courseEdit() {
  var element = document.getElementById("profile-course");
  var element1 = document.getElementById("course-form");
  var element2 = document.getElementById("edit-profile");
  element.classList.add("hidden");
  element1.classList.remove("hidden");
  element2.classList.remove("hidden");
}
function editcomment() {
  var element = document.getElementById("edit-comment-reveal");
  var element1 = document.getElementById("edit-comment-form-id");
  element.classList.add("hidden");
  element1.classList.remove("hidden");
}
function editcommentcancel() {
  var element = document.getElementById("edit-comment-reveal");
  var element1 = document.getElementById("edit-comment-form-id");
  element.classList.remove("hidden");
  element1.classList.add("hidden");
}
function messagesend() {
  var element1 = document.getElementById("send-message");
  var element2 = document.getElementById("left");
  var element3 = document.getElementById("right");
  element1.classList.remove("hidden");
  element2.classList.add("hidden");
  element3.classList.add("hidden");
}
function messagecancel() {
  var element1 = document.getElementById("send-message");
  var element2 = document.getElementById("left");
  var element3 = document.getElementById("right");
  element1.classList.add("hidden");
  element2.classList.remove("hidden");
  element3.classList.remove("hidden");
}
