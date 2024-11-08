<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <h2>Registration</h2>
    <?php if (isset($validation)) : ?>
      <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
      </div>
    <?php endif; ?>

    <form action="<?php base_url('/register'); ?>" method="post">
      
      <div class="input-box">
        <input type="text" class="form-control" id="firstname" name="firstname" required
         title="First name should contain only letters (A-Z or a-z)"
         placeholder="Enter your first name"
         oninput="validateFirstName(this)"
         pattern="[A-Za-z ]+">
         <small id="firstnameError" style="color: red; display: none;">First name should contain only letters (A-Z or a-z)</small>
      </div>

      <div class="input-box">
        <input type="text" class="form-control" id="lastname" name="lastname" required
        title="Last name should contain only letters (A-Z or a-z)"
        placeholder="Enter your last name"
        oninput="validateLastName(this)"
        pattern="[A-Za-z ]+">
        <small id="lastnameError" style="color: red; display: none;">Last name should contain only letters (A-Z or a-z)</small>
      </div>

      <div class="input-box">
        <input type="text" name="email" required
        title="Email should be in the format of 'example@example.com'"
        placeholder="Enter your email">
      </div>

      <div class="input-box">
        <input type="password" id="password" name="password" required
        title="Password should contain at least one uppercase letter, one lowercase letter, one number, and one special character"
        placeholder="Enter your password"
        oninput="validatePassword()">
        <small id="warning-message-password" style="color: red; display: none;">Password contain at least 8 characters, including one uppercase, lowercase, number, special character.</small>
      </div>

      <div class="input-box">
        <input type="password" id="confirmPassword" name="confirmpassword" required
        title="Please confirm your password"
        placeholder="Confirm password"
        oninput="validatePasswordMatch()">
        <small id="match-warning-message" style="color: red; display: none;">
        Passwords do not match.
        </small>
        
      </div>

      <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="showPasswordCheckbox" onclick="togglePasswordVisibility()">
        <label class="form-check-label" style="font-size: 12px;" for="showPasswordCheckbox">Show password</label>
      </div>

      <div class="input-box button">
        <input type="submit" value="Register Now">
      </div>
    
      <div class="text">
        <h3>Already have an account? <a href="login">Login now</a></h3>
      </div>
      </form>
  </div>

  <script>
    function validateFirstName(input) {
      const pattern = /^[A-Za-z ]*$/;
      const errorMessage = document.getElementById("firstnameError");

      if (!pattern.test(input.value)) {
        input.value = input.value.slice(0, -1);
        errorMessage.style.display = "inline";  // Show error message
      } else {
        errorMessage.style.display = "none";  // Hide error message if input is valid
      }
    }

    function validateLastName(input) {
      const pattern = /^[A-Za-z ]*$/;
      const errorMessage = document.getElementById("lastnameError");

      if (!pattern.test(input.value)) {
        input.value = input.value.slice(0, -1);
        errorMessage.style.display = "inline";  // Show error message
      } else {
        errorMessage.style.display = "none";  // Hide error message if input is valid
      }
    }

    function togglePasswordVisibility() {
      const passwordInput = document.getElementById("password");
      const confirmPasswordInput = document.getElementById("confirmPassword");
      const checkbox = document.getElementById("showPasswordCheckbox");

      const type = checkbox.checked ? "text" : "password";
      passwordInput.type = type;
      confirmPasswordInput.type = type;
    }

    function validatePassword() {
      const passwordInput = document.getElementById("password").value;
      const warningMessage = document.getElementById("warning-message-password");

      const hasLetter = /[a-zA-Z]/;
      const hasNumber = /[0-9]/;
      const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/;

      if (
        passwordInput.length >= 8 &&
        hasLetter.test(passwordInput) &&
        hasNumber.test(passwordInput) &&
        hasSpecialChar.test(passwordInput)
      ) {
        warningMessage.style.display = "none"; // Hide warning if valid
      } else {
        warningMessage.style.display = "block"; // Show warning if invalid
      }
    }

    function validatePasswordMatch() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const matchWarningMessage = document.getElementById("match-warning-message");

    if (password && confirmPassword && password !== confirmPassword) {
      matchWarningMessage.style.display = "block"; // Show warning if passwords do not match
    } else {
      matchWarningMessage.style.display = "none"; // Hide warning if passwords match
    }
  }

  </script>

  <style>
    /* Your CSS styling here */
  </style>
</body>
</html>


<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #4070f4;
}
.wrapper{
  position: relative;
  max-width: 430px;
  width: 95%;
  background: #fff;
  padding: 34px;
  border-radius: 6px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
}
.wrapper h2{
  position: relative;
  font-size: 22px;
  font-weight: 600;
  color: #333;
}
.wrapper h2::before{
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 28px;
  border-radius: 12px;
  background: #4070f4;
}
.wrapper form{
  margin-top: 30px;
}
.wrapper form .input-box{
  height: 40px;
  margin: 40px 0;
}
form .input-box input{
  height: 100%;
  width: 100%;
  outline: none;
  padding: 0 15px;
  font-size: 14px;
  font-weight: 400;
  color: #333;
  border: 1.5px solid #C7BEBE;
  border-bottom-width: 2.5px;
  border-radius: 6px;
  transition: all 0.3s ease;
}
.input-box input:focus,
.input-box input:valid{
  border-color: #4070f4;
}
form .policy{
  display: flex;
  align-items: center;
}
form h3{
  color: #707070;
  font-size: 14px;
  font-weight: 500;
  margin-left: 10px;
}
.input-box.button input{
  color: #fff;
  letter-spacing: 1px;
  border: none;
  background: #4070f4;
  cursor: pointer;
}
.input-box.button input:hover{
  background: #0e4bf1;
}
form .text h3{
 color: #333;
 width: 100%;
 text-align: center;
}
form .text h3 a{
  color: #4070f4;
  text-decoration: none;
}
form .text h3 a:hover{
  text-decoration: underline;
}

</style>

