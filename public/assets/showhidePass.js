var togglePassword1 = document.querySelector('#togglePassword_edit_profile1');
var password1 = document.querySelector('#password_edit_profile1');
togglePassword1.addEventListener('click', function(e) {
// toggle the type attribute
   var type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
   password1.setAttribute('type', type);
   // toggle the icon
   this.querySelector('i').classList.toggle('bi-eye-fill');
   this.querySelector('i').classList.toggle('bi-eye-slash-fill');
});

var togglePassword2 = document.querySelector('#togglePassword_edit_profile2');
var password2 = document.querySelector('#password_edit_profile2');
togglePassword2.addEventListener('click', function(e) {
// toggle the type attribute
   var type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
   password2.setAttribute('type', type);
   // toggle the icon
   this.querySelector('i').classList.toggle('bi-eye-fill');
   this.querySelector('i').classList.toggle('bi-eye-slash-fill');
});

var togglePassword3 = document.querySelector('#togglePassword_edit_profile3');
var password3 = document.querySelector('#password_edit_profile3');
togglePassword3.addEventListener('click', function(e) {
// toggle the type attribute
   var type = password3.getAttribute('type') === 'password' ? 'text' : 'password';
   password3.setAttribute('type', type);
   // toggle the icon
   this.querySelector('i').classList.toggle('bi-eye-fill');
   this.querySelector('i').classList.toggle('bi-eye-slash-fill');
});
   
   