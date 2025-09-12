<?php
class Forms {
    public function Signup() {
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
          <?php $this->submit_button("Sign In", "signin"); ?> 
          <a href="signup.php">Don't have an account? Sign up</a>
        </form>
        <?php
    }
}
