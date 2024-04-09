<?php
    session_start();
    unset($_SESSION['log_username']);
    
    echo '<script>
        location.replace("index.php")
    </script>';

?>