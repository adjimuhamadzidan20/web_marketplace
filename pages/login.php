<?php
    require 'fungsi/proses_login.php';
?>

<section class="section">
    <div class="section-login">
        <div class="section-title-login">
            <h2>Login</h2>
            <p>Silahkan masukan akun anda untuk mengakses lebih jauh</p>
        </div>
        <div class="section-form">
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div>
                    <button class="btn btn-success w-100" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</section>