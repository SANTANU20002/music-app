<link rel="stylesheet" href="../assets/css/style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>
/* Transitions for auth forms */
.auth-forms {
  position: relative;
  min-height: 470px;
}
.auth-form-panel {
  position: absolute;
  width: 100%;
  top: 0;
  left: 0;
  opacity: 0;
  z-index: 1;
  transform: translateX(50px) scale(0.96);
  pointer-events: none;
  transition: 
    opacity .45s cubic-bezier(.5,0,0,1),
    transform .5s cubic-bezier(.5,0,0,1);
}
.auth-form-panel.active {
  opacity: 1;
  z-index: 2;
  transform: translateX(0) scale(1);
  pointer-events: auto;
}
</style>

<script>
function showAuth(form) {
  var forms = ['signin', 'signup', 'forgot', 'otp'];
  forms.forEach(function(f) {
    var el = document.getElementById(f + '-form');
    if (!el) return;
    if (f === form) {
      el.classList.add('active');
    } else {
      el.classList.remove('active');
    }
  });
}
window.addEventListener('DOMContentLoaded', function(){
  showAuth('signin');
  resetSignupState();
});
function showForgot() {
  showAuth('forgot');
}
function showOTP() {
  showAuth('otp');
}
function enterApp() {
  // Dummy action: can add redirect logic
  alert('Signed in! (This is a demo)');
}
function showLanding() {
  alert('Go to landing page!');
}

// ---- SIGNUP SIMPLE LOGIC ----

function resetSignupState() {
  document.getElementById('signup-simple-form').reset();
}

function handleSignupCreateAccount(event) {

let name = document.getElementById('signup-name').value.trim();
let email = document.getElementById('signup-email').value.trim();
let password = document.getElementById('signup-password-field').value;

if (!name || !email) {
    alert('Please enter your name and email.');
    event.preventDefault();
    return false;
}

if (password.length < 8) {
    alert('Password must be at least 8 characters');
    event.preventDefault();
    return false;
}

// Allow form submission to PHP
return true;
}

// OTP digit input logic for other forms (for forgot password, etc.)
function handleOTPInput(e) {
  const input = e.target;
  if (e.inputType === 'deleteContentBackward') {
    // If backspace and empty, go to prev
    if (input.value === '' && input.previousElementSibling) {
      input.previousElementSibling.focus();
    }
    return;
  }
  let v = input.value.replace(/[^\d]/g, '');
  input.value = v.slice(0,1);
  if (v.length > 0 && input.nextElementSibling) {
    input.nextElementSibling.focus();
  }
}
function handleOTPKeyUp(e) {
  const input = e.target;
  if (e.key === 'Backspace' && input.value === '' && input.previousElementSibling) {
    input.previousElementSibling.focus();
  }
}
function toggleSignupPasswordVisibility() {
        const pwdField = document.getElementById('signup-password-field');
        const eyeIcon = document.getElementById('signup-password-eye');
        if (pwdField.type === 'password') {
          pwdField.type = 'text';
          eyeIcon.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
        } else {
          pwdField.type = 'password';
          eyeIcon.innerHTML = '<i class="fa-regular fa-eye"></i>';
        }
      }
</script>

<div class="landing-view" id="auth-page">
  <div class="auth-page">
    <div class="auth-left">
      <div style="width:100%;max-width:400px; transform: translateY(-80px);">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:40px;cursor:pointer" onclick="showLanding()">
          <div class="logo-mark">🎵</div>
          <span style="font-family:var(--font-display);font-size:22px;font-weight:800">AURA</span>
        </div>
        <div class="auth-forms" style="position:relative">
          <!-- Sign In Form -->
          <div id="signin-form" class="auth-form-panel">
            <h1 class="auth-title">Welcome back</h1>
            <p class="auth-desc">Sign in to continue your musical journey</p>
            <div class="social-btns">
              <button class="social-btn"><i class="fa-brands fa-google"></i> Continue with Google</button>
              <button class="social-btn"><i class="fa-brands fa-apple"></i> Continue with Apple</button>
              <button class="social-btn"><i class="fa-brands fa-facebook-f"></i> Continue with Facebook</button>
            </div>
            <div class="divider">or continue with email</div>
            <form action="../backend/login.php" method="POST">

              <div class="form-group">
                  <label class="form-label">EMAIL</label>
                  <input
                      type="email"
                      name="email"
                      class="form-input"
                      placeholder="you@example.com"
                      required>
              </div>

              <div class="form-group" style="margin-bottom:8px">
                  <label class="form-label">PASSWORD</label>
                  <input
                      type="password"
                      name="password"
                      class="form-input"
                      placeholder="••••••••"
                      required>
              </div>

              <div style="text-align:right;margin-bottom:24px">
                  <a href="#" class="section-link" style="font-size:13px"
                      onclick="showForgot();return false;">
                      Forgot password?
                  </a>
              </div>

              <button
                  type="submit"
                  class="btn btn-primary"
                  style="width:100%;justify-content:center;padding:14px">
                  Sign In →
              </button>

              <p style="text-align:center;font-size:13px;color:var(--c-text3);margin-top:20px">
                  Don't have an account?
                  <a href="#" class="section-link"
                      onclick="showAuth('signup'); resetSignupState(); return false;">
                      Sign up free
                  </a>
              </p>

          </form>
          </div>
          <!-- Sign Up Form (Simple: Name, Email, Password) -->
          <div id="signup-form" class="auth-form-panel">
            <h1 class="auth-title">Join AURA</h1>
            <p class="auth-desc">Create your free account and start listening</p>
            <div class="social-btns">
              <button class="social-btn"><i class="fa-brands fa-google"></i> Sign up with Google</button>
              <button class="social-btn"><i class="fa-brands fa-apple"></i> Sign up with Apple</button>
            </div>
            <div class="divider">or use email</div>
            <!-- registration-------------------------- -->

            <form id="signup-simple-form"
      action="../backend/register.php"
 
      method="POST"
      onsubmit="return handleSignupCreateAccount(event)">

    <div class="form-group">
        <label class="form-label">FULL NAME</label>
        <input
            type="text"
            class="form-input"
            name="fullname"
            id="signup-name"
            placeholder="Your name"
            required>
    </div>

    <div class="form-group">
        <label class="form-label">EMAIL</label>
        <input
            type="email"
            class="form-input"
            name="email"
            id="signup-email"
            placeholder="you@example.com"
            required>
    </div>

    <div class="form-group" style="margin-bottom:24px; position:relative;">
        <label class="form-label">PASSWORD</label>
        <input
            type="password"
            class="form-input"
            name="password"
            id="signup-password-field"
            placeholder="Min 8 characters"
            required
            style="padding-right:38px;">
        <button type="button"
            onclick="toggleSignupPasswordVisibility()"
            tabindex="-1"
            style="position:absolute; top:32px; right:10px; background:transparent; border:none; outline:none; cursor:pointer; height:30px; width:30px; display:flex; align-items:center; justify-content:center;">
            <span id="signup-password-eye" style="font-size:14px; color: #fff;">
                <i class="fa-regular fa-eye"></i>
            </span>
        </button>
    </div>

    <button
        class="btn btn-primary"
        style="width:100%;justify-content:center;padding:14px"
        type="submit">
        Sign Up →
    </button>

</form>

            <p style="text-align:center;font-size:13px;color:var(--c-text3);margin-top:20px">
              Already have an account? <a href="#" class="section-link" onclick="showAuth('signin');resetSignupState();return false;">Sign in</a>
            </p>
          </div>
          <!-- Forgot Form -->
          <div id="forgot-form" class="auth-form-panel">
            <h1 class="auth-title">Reset password</h1>
            <p class="auth-desc">We'll send a reset link to your email</p>
            <div class="form-group" style="margin-bottom:24px"><label class="form-label">EMAIL ADDRESS</label><input type="email" class="form-input" placeholder="you@example.com"></div>
            <button class="btn btn-primary" style="width:100%;justify-content:center;padding:14px" onclick="showOTP()">Send Reset Link →</button>
            <p style="text-align:center;font-size:13px;color:var(--c-text3);margin-top:20px"><a href="#" class="section-link" onclick="showAuth('signin');return false;">← Back to Sign In</a></p>
          </div>
          <!-- OTP Form (For forgot password or other) -->
          <div id="otp-form" class="auth-form-panel">
            <h1 class="auth-title">Verify email</h1>
            <p class="auth-desc">Enter the 6-digit code sent to your email</p>
            <div style="display:flex;gap:10px;margin-bottom:28px;justify-content:center">
              <input type="text" maxlength="1" inputmode="numeric" pattern="\d*" style="width:52px;height:64px;text-align:center;font-size:24px;font-family:var(--font-display);font-weight:700;background:var(--c-surface2);border:2px solid var(--c-border);border-radius:var(--r-md);color:var(--c-text);outline:none"
                oninput="handleOTPInput(event)" onkeyup="handleOTPKeyUp(event)">
              <input type="text" maxlength="1" inputmode="numeric" pattern="\d*" style="width:52px;height:64px;text-align:center;font-size:24px;font-family:var(--font-display);font-weight:700;background:var(--c-surface2);border:2px solid var(--c-border);border-radius:var(--r-md);color:var(--c-text);outline:none"
                oninput="handleOTPInput(event)" onkeyup="handleOTPKeyUp(event)">
              <input type="text" maxlength="1" inputmode="numeric" pattern="\d*" style="width:52px;height:64px;text-align:center;font-size:24px;font-family:var(--font-display);font-weight:700;background:var(--c-surface2);border:2px solid var(--c-border);border-radius:var(--r-md);color:var(--c-text);outline:none"
                oninput="handleOTPInput(event)" onkeyup="handleOTPKeyUp(event)">
              <input type="text" maxlength="1" inputmode="numeric" pattern="\d*" style="width:52px;height:64px;text-align:center;font-size:24px;font-family:var(--font-display);font-weight:700;background:var(--c-surface2);border:2px solid var(--c-border);border-radius:var(--r-md);color:var(--c-text);outline:none"
                oninput="handleOTPInput(event)" onkeyup="handleOTPKeyUp(event)">
              <input type="text" maxlength="1" inputmode="numeric" pattern="\d*" style="width:52px;height:64px;text-align:center;font-size:24px;font-family:var(--font-display);font-weight:700;background:var(--c-surface2);border:2px solid var(--c-border);border-radius:var(--r-md);color:var(--c-text);outline:none"
                oninput="handleOTPInput(event)" onkeyup="handleOTPKeyUp(event)">
              <input type="text" maxlength="1" inputmode="numeric" pattern="\d*" style="width:52px;height:64px;text-align:center;font-size:24px;font-family:var(--font-display);font-weight:700;background:var(--c-surface2);border:2px solid var(--c-border);border-radius:var(--r-md);color:var(--c-text);outline:none"
                oninput="handleOTPInput(event)" onkeyup="handleOTPKeyUp(event)">
            </div>
            <button class="btn btn-primary" style="width:100%;justify-content:center;padding:14px" onclick="enterApp()">Verify & Continue →</button>
            <p style="text-align:center;font-size:13px;color:var(--c-text3);margin-top:20px">Didn't receive? <a href="#" class="section-link" onclick="event.preventDefault(); /* Should resend OTP */">Resend code</a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="auth-right">
      <div style="position:relative;z-index:2;text-align:center;color:#fff;padding:40px">
        <div style="font-size:80px;margin-bottom:24px">🎵</div>
        <h2 style="font-family:var(--font-display);font-size:32px;font-weight:800;letter-spacing:-1px;margin-bottom:12px">100M+ Songs<br>at your fingertips</h2>
        <p style="color:rgba(255,255,255,0.6);font-size:15px;line-height:1.6">Discover new music every day with AI-powered recommendations tailored just for you.</p>
        <div style="display:flex;justify-content:center;gap:24px;margin-top:32px">
          <div style="text-align:center"><div style="font-family:var(--font-display);font-size:28px;font-weight:800">100M+</div><div style="font-size:12px;color:rgba(255,255,255,0.5)">Songs</div></div>
          <div style="width:1px;background:rgba(255,255,255,0.1)"></div>
          <div style="text-align:center"><div style="font-family:var(--font-display);font-size:28px;font-weight:800">4K+</div><div style="font-size:12px;color:rgba(255,255,255,0.5)">Artists</div></div>
          <div style="width:1px;background:rgba(255,255,255,0.1)"></div>
          <div style="text-align:center"><div style="font-family:var(--font-display);font-size:28px;font-weight:800">12M</div><div style="font-size:12px;color:rgba(255,255,255,0.5)">Users</div></div>
        </div>
      </div>
      <div style="position:absolute;top:-50px;right:-50px;width:300px;height:300px;border-radius:50%;background:radial-gradient(circle,rgba(124,106,247,0.3),transparent)"></div>
      <div style="position:absolute;bottom:-50px;left:-50px;width:200px;height:200px;border-radius:50%;background:radial-gradient(circle,rgba(6,214,160,0.2),transparent)"></div>
    </div>
  </div>
</div>