<?php
class Layout {
    public function header() {
        ?>
        <header>
            <h1>Welcime to <?php print $conf['site_name']; ?> </h1>
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