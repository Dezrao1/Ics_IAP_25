<?php
class Forms {
    private $EmailService;
    
    public function __construct($EmailService = null) {
        $this->EmailService = $EmailService;
    }
    
    public function signup() {
        // Display success message if email was sent
        if (isset($_GET['verification_sent']) && $_GET['verification_sent'] == 'true') {
            echo '<div class="alert alert-success mt-3">Verification email sent! Please check your inbox to activate your account.</div>';
        }
        
        // Display error message if email failed
        if (isset($_GET['email_error']) && $_GET['email_error'] == 'true') {
            echo '<div class="alert alert-warning mt-3">Account created but we couldn\'t send verification email. Please contact support.</div>';
        }
?>
<h1>Sign Up</h1>
<form method="post" action="process_signup.php">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" required>
    <div id="usernameHelp" class="form-text">Choose a unique username</div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
    <div id="passwordHelp" class="form-text">Use at least 8 characters with a mix of letters, numbers and symbols.</div>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
    <label class="form-check-label" for="terms">I agree to the <a href="terms.php">Terms of Service</a> and <a href="privacy.php">Privacy Policy</a></label>
  </div>
  <?php $this->submit_button("Sign Up", "signup"); ?> 
  <a href="signin.php">Already have an account? Log in</a>
</form>

<?php
    }

    private function submit_button($value, $name) {
        ?>
        <button type="submit" class="btn btn-primary" name="<?php echo htmlspecialchars($name); ?>">
            <?php echo htmlspecialchars($value); ?>
        </button>
        <?php
    }

    public function signin() {
        // Display verification reminder if needed
        if (isset($_GET['verify_account']) && $_GET['verify_account'] == 'true') {
            echo '<div class="alert alert-info mt-3">Please verify your email address before signing in. Check your inbox for the verification email.</div>';
        }
        
        // Display account activated message
        if (isset($_GET['account_activated']) && $_GET['account_activated'] == 'true') {
            echo '<div class="alert alert-success mt-3">Your account has been activated! You can now sign in.</div>';
        }
?>
        <h1>Sign In</h1>
        <form method="post" action="process_signin.php">
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text"></div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
          <?php $this->submit_button("Sign In", "signin"); ?> 
          <a href="signup.php">Don't have an account? Sign up</a>
          <div class="mt-3">
            <a href="forgot_password.php">Forgot your password?</a>
          </div>
        </form>
        <?php
    }
    
    public function emailVerificationSuccess() {
        ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title text-success">Email Verified Successfully!</h2>
                            <p class="card-text">Your email address has been verified. Your account is now active.</p>
                            <p>You can now <a href="signin.php" class="btn btn-primary">Sign In</a> to your account.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    public function emailVerificationFailed() {
        ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title text-danger">Verification Failed</h2>
                            <p class="card-text">The verification link is invalid or has expired.</p>
                            <p>Please request a <a href="resend_verification.php">new verification email</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}