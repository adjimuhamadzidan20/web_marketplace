<?php
    require 'koneksi.php';

    if (isset($_POST['login'])) {
        $username = htmlspecialchars($_POST['username']); 
        $password = htmlspecialchars($_POST['password']);
    
        $query = "SELECT * FROM tb_user WHERE username = '$username'";
        $res = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_assoc($res);
        $barisData = mysqli_num_rows($res);
    
        if ($barisData == 1) {
            $_SESSION['log_username'] = $data['username'];
    
            echo '<script>
                location.replace("index.php")
            </script>';
            
        } else {
            $_SESSION['pesan'] = 'Username atau password tidak valid!';
            
            echo '<script>
                location.replace("index.php?page=login")
            </script>';
        }
    }

?>