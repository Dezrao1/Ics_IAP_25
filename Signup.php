<?php
class forms {
  public function Signup() {
?> 
  <form method="post" action="mail.php">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
      <br>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <br>
      <input type="submit" value="Sign Up">
  </form>

  <form method="post" action="process_signup.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <input type="submit" value="Sign Up">
  </form>
<?php
    
  }
    
    public function Login() {
        ?>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br></br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br></br>
            <input type="submit" value="Log In">
        </form>
        <?php
            
    }

}