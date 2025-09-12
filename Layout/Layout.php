<?php
class Layout {
    public function header($conf) { // Add $conf parameter
        ?>
        <header>
            <h1>Welcome to <?php print $conf['site_name']; ?> </h1>
        </header>
        <?php
    }
    
    public function footer($conf) {
        ?>
        <footer>
            <p>Copyright &copy; <?php echo date("Y"); ?> <?php print $conf['site_name']; ?> - All Rights Reserved</p>
        </footer>
        <?php 
    }
}
?>