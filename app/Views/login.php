<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="wrapper">
    <h2>Login</h2>

    <?php if(session()->getFlashdata('msg')):?>
      <div class="alert alert-warning">
        <?= session()->getFlashdata('msg') ?>
      </div>
    <?php endif;?>

    <form action="<?php base_url('/login'); ?>" method="post">

      <div class="input-box">
        <input type="text" name="email" id="email" value="<?= esc($email ?? '') ?>" placeholder="Enter your email" required>
      </div>

      <div class="input-box">
        <input type="password" name="password" id="password" value="<?= esc($password ?? '') ?>" placeholder="Enter your password" required>
      </div>

      <!-- Remember Me Checkbox -->
      <div class="form-check" style="margin-bottom: 20px;">
          <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me"
          <?= (isset($email) || isset($password)) ? 'checked' : '' ?>>
          <label class="form-check-label" for="remember_me">Remember me</label>
          
      </div>

      <div class="input-box button">
        <button type="submit">Login Now</button>
      </div>

      <div class="input-box password">
        <button type="button" onclick="window.location.href='<?= base_url('/password_reset_request') ?>'">Forgot Password</button>
      </div>

      <div class="text">
        <h3>Not registered? <a href="<?= base_url('/register') ?>">Register Now</a></h3>
      </div>

    </form>
  </div>
</body>
</html>

<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #33cece;
}
.wrapper {
  position: relative;
  max-width: 430px;
  width: 100%;
  background: #fff;
  padding: 34px;
  border-radius: 6px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
}
.wrapper h2 {
  position: relative;
  font-size: 22px;
  font-weight: 600;
  color: #333;
}
.wrapper h2::before {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 28px;
  border-radius: 12px;
  background: #4070f4;
}
.wrapper form {
  margin-top: 30px;
}
.wrapper form .input-box {
  height: 52px;
  margin: 18px 0;
}
form .input-box input {
  height: 100%;
  width: 100%;
  outline: none;
  padding: 0 15px;
  font-size: 17px;
  font-weight: 400;
  color: #333;
  border: 1.5px solid #C7BEBE;
  border-bottom-width: 2.5px;
  border-radius: 6px;
  transition: all 0.3s ease;
}
.input-box input:focus,
.input-box input:valid {
  border-color: #4070f4;
}
.form-check {
  display: flex;
  align-items: center;
}
.form-check input[type="checkbox"] {
  margin-right: 8px;
}
form h3 {
  color: #707070;
  font-size: 14px;
  font-weight: 500;
  margin-left: 10px;
}
.input-box.button button {
  width: 100%;
  padding: 15px;
  font-size: 14px;
  font-weight: 500;
  color: #fff;
  background: #4070f4;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.input-box.password button {
  width: 100%;
  padding: 15px;
  font-size: 14px;
  font-weight: 500;
  color: #fff;
  background: #f96130;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.input-box.button button:hover {
  background: #0e4bf1;
}
form .text h3 {
  color: #333;
  width: 100%;
  text-align: center;
}
form .text h3 a {
  color: #4070f4;
  text-decoration: none;
}
form .text h3 a:hover {
  text-decoration: underline;
}
</style>
