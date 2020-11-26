$(document).ready(function () {
  $("#hideLogin").click(function () {
    $("#registerForm").show();
    $("#loginForm").hide();
  });
  $("#hideRegister").click(function () {
    $("#loginForm").show();
    $("#registerForm").hide();
  });
});
