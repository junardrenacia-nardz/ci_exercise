<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/users-style.css">
    <title><?php echo $title ?></title>
</head>

<body>

    <div class="position-fixed top-0 start-50 translate-middle-x w-50 mt-3">
        <?php if ($this->session->flashdata('login_failed')) {
            echo "<p id = 'loginFailedAlert' class = 'alert alert-danger'>" . $this->session->flashdata('login_failed') . "</p>";
        } ?>
    </div>
    <main class=" main-login container-xl d-flex justify-content-center align-items-center">
        <div class="login card col-md-6 col-lg-4 py-5 d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="user-icon bi bi-person-circle"
                viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
            </svg>
            <h2 class="text-center">Login</h2>

            <form action="<?php echo base_url('users/login') ?>" method="POST">
                <div class="col-md-12 mb-4">
                    <div class="col mb-4">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="" class="input form-control mb-1"
                            value="<?= set_value('email'); ?>">
                        <span class="text-danger"><?= form_error('email'); ?></span>

                        </span>
                    </div>
                    <div class="col d-flex flex-column">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="input form-control mb-1"
                            value="<?= set_value('password'); ?>">
                        <span class="text-danger"><?= form_error('password'); ?></span>
                        <button class="btn btn-sm" id="toggle" type="button" onclick="togglePassword()">Show
                            Password</button>
                    </div>

                </div>
                <button type="submit" name="loginBtn" class="log-btn btn btn-dark form-control">Login</button>

            </form>

            <div class="mt-3 no-account">
                <p>No Account? <a class="create-acc" href="<?php echo base_url('users/register') ?>">Create One</a>
                </p>
            </div>
        </div>
    </main>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>

<script>
    const password = document.getElementById('password');
    let toggle = document.getElementById('toggle')

    function togglePassword() {
        if (password.type == "password") {
            password.type = "text";
            toggle.textContent = "Hide Password";
        } else {
            password.type = "password";
            toggle.textContent = "Show Password";
        }
    }

    const alertBox = document.getElementById('loginFailedAlert');

    if (alertBox) {
        setTimeout(() => {
            alertBox.style.transition = "opacity 0.5s ease";
            alertBox.style.opacity = "0";
            setTimeout(() => {
                alertBox.remove();
            }, 500);
        }, 3000); // 3 seconds
    }
</script>

</html>