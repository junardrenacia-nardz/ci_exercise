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

    <main class="container-fluid d-flex flex-column justify-content-center align-items-center">
        <h1>ACCOUNT CREATION</h1>
        <div class="d-flex creation-container">
            <div class="steps row">
                <div class="step-1 col-sm-10">
                    <div class="">
                        <form action="<?= base_url('users/register') ?>" method="POST" id="step1Form" class="">
                            <input type="hidden" name="step" value="1">
                            <div class="form mt-4 d-flex flex-column justify-content-between">
                                <div class="fields">
                                    <div class="row">
                                        <h5>Personal Info</h5>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 mt-1">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" name="firstName" id="firstName" class="form-control"
                                                value="<?= set_value('firstName' ?? '') ?>">
                                            <span id="" class="text-danger"><?= form_error('firstName') ?></span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 mt-1">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" name="lastName" id="lastName" class="form-control"
                                                value="<?= set_value('lastName' ?? '') ?>">
                                            <span id="" class="text-danger"><?= form_error('lastName') ?></span>
                                        </div>
                                        <div class="col-lg-6 col-xl-4 mt-1">
                                            <label for="contact" class="form-label">Contact Number</label>
                                            <input type="tel" name="contact" id="contact" class="form-control"
                                                value="<?= set_value('contact' ?? '') ?>">
                                            <span id="" class="text-danger"><?= form_error('contact') ?></span>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <h5>Employee Role and Department</h5>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 mt-1">
                                            <label for="firstName" class="form-label">Department</label>
                                            <select name="department" id="department" class="form-control">
                                                <option value="">- Select your Department -</option>
                                                <?php foreach ($departments as $department): ?>
                                                    <option value="<?= $department['department_id'] ?>"
                                                        <?= ($department['department_id'] == set_value('department')) ? 'selected' : "" ?>>
                                                        <?= $department['department_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span id="" class="text-danger"><?= form_error('department') ?></span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 mt-1">
                                            <label for="lastName" class="form-label">Role</label>
                                            <select name="role" id="role" class="form-control" disabled>
                                                <option value="">- Select your Role -</option>
                                                <?php foreach ($positions as $position): ?>
                                                    <option value=" <?= $position['position_id'] ?>"
                                                        data-department="<?= $position['department_id'] ?>"
                                                        <?= ($position['position_id'] == set_value('role')) ? 'selected' : "" ?>>
                                                        <?= $position['position_name'] ?>
                                                    </option>
                                                <?php endforeach; ?>

                                            </select>
                                            <span id="" class="text-danger"><?= form_error('role') ?></span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 mt-1">
                                            <label for="lastName" class="form-label">Tier Level</label>
                                            <select name="tier" id="tier" class="form-control">
                                                <option value="">- Select your Tier Level -</option>
                                                <option value="Level 1">Level 1</option>
                                                <option value="Level 2">Level 2</option>
                                                <option value="Level 3">Level 3</option>
                                                <option value="Level 4">Level 4</option>
                                                <option value="Level 5">Level 5</option>
                                            </select>
                                            <span id="" class="text-danger"><?= form_error('tier') ?></span>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <h5>Account Information</h5>
                                        <div class="col-lg-6 col-xl-4 mt-1">
                                            <label for="contact" class="form-label">Email</label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                value="<?= set_value('email' ?? '') ?>">
                                            <span class="text-danger"><?= form_error('email') ?></span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 mt-1">
                                            <label for="firstName" class="form-label">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                value="<?= set_value('password' ?? '') ?>">
                                            <div class="password-requirements mt-2 d-flex flex-column">
                                                <span id="errorPassword" class="text-danger">
                                                    <?php echo form_error('password'); ?></span>

                                                <span class="fw-bold" id="requirement"></span>
                                                <ul>
                                                    <span class="" id="length"></span>
                                                    <span class="" id="lowCase"></span>
                                                    <span class="" id="upCase"></span>
                                                    <span class="" id="specialChars"></span>
                                                    <span class="" id="nums"></span>
                                                    <span class="" id="invalid"></span>
                                                </ul>

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 mt-1">
                                            <label for="password2" class="form-label">Confirm Password</label>
                                            <input type="password" name="password2" id="password2" class="form-control"
                                                value="<?= set_value('password2' ?? '') ?>">
                                            <span id="" class="text-danger"><?= form_error('password2') ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="buttons d-flex justify-content-between">
                                    <a href="<?= base_url('users') ?>" type="submit" name="direction"
                                        value="go_to_login" class="btn btn-outline-dark">Go back to
                                        Login</a>
                                    <button class="btn btn-dark" type="submit" id="submit-1" name="direction"
                                        value="submit">Register</button>
                                </div>
                            </div>


                        </form>
                    </div>


                </div>
            </div>

        </div>


    </main>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const department = document.getElementById("department");
        const role = document.getElementById("role");

        const allOptions = Array.from(role.options);

        function filterRoles(selectedDept) {
            role.innerHTML = '<option value="">- Select your Role -</option>';

            if (selectedDept === "") {
                role.disabled = true;
                return;
            }

            role.disabled = false;

            allOptions.forEach(option => {
                if (option.dataset.department === selectedDept) {
                    role.appendChild(option);
                }
            });
        }

        // 🔁 Run when user changes department
        department.addEventListener("change", function() {
            filterRoles(this.value);
        });

        // ✅ RUN ON PAGE LOAD (THIS FIXES YOUR ISSUE)
        if (department.value !== "") {
            filterRoles(department.value);
        }
    });


    // Password
    const regexPassword = /[^A-Za-z\d@$!%*?&-]/;

    let passwordRequirement = document.getElementById("requirement");
    let passwordLength = document.getElementById("length");
    let passwordLowCase = document.getElementById("lowCase");
    let passwordUpCase = document.getElementById("upCase");
    let passwordSpecialChars = document.getElementById("specialChars");
    let passwordNumbers = document.getElementById("nums");
    let passwordInvalid = document.getElementById("invalid");

    function validatePassword() {
        let passwordVal = password.value;
        passwordRequirement.textContent = "Password Requirement:";

        if (regexPassword.test(passwordVal)) {
            passwordInvalid.style.display = "block";
            passwordInvalid.innerHTML = "<li>Password input is invalid</li>";
            passwordInvalid.style.color = "red";
            passwordLength.style.display = "none";
            passwordLowCase.style.display = "none";
            passwordUpCase.style.display = "none";
            passwordNumbers.style.display = "none";
            passwordSpecialChars.style.display = "none";
        } else {
            passwordInvalid.style.display = "none";
            passwordLength.style.display = "block";
            passwordLowCase.style.display = "block";
            passwordUpCase.style.display = "block";
            passwordNumbers.style.display = "block";
            passwordSpecialChars.style.display = "block";
        }

        if (passwordVal.length < 8) {
            passwordLength.innerHTML =
                "<li>Password must have at least 8 character</li>";
            passwordLength.style.color = "red";
        } else {
            passwordLength.innerHTML =
                "<li>Password must have at least 8 character</li>";
            passwordLength.style.color = "green";
        }

        if (!/^(?=.*[a-z])[A-Za-z\d@$!%*?&-]+$/.test(passwordVal)) {
            passwordLowCase.innerHTML =
                "<li>Password must contain a lower cased letter</li>";
            passwordLowCase.style.color = "red";
        } else {
            passwordLowCase.innerHTML =
                "<li>Password must contain a lower cased letter</li>";
            passwordLowCase.style.color = "green";
        }

        if (!/^(?=.*[A-Z])[A-Za-z\d@$!%*?&-]+$/.test(passwordVal)) {
            passwordUpCase.innerHTML =
                "<li>Password must contain a upper cased letter</li>";
            passwordUpCase.style.color = "red";
        } else {
            passwordUpCase.innerHTML =
                "<li>Password must contain a upper cased letter</li>";
            passwordUpCase.style.color = "green";
        }

        if (!/^(?=.*\d)[A-Za-z\d@$!%*?&-]+$/.test(passwordVal)) {
            passwordNumbers.innerHTML = "<li>Password must contain a number</li>";
            passwordNumbers.style.color = "red";
        } else {
            passwordNumbers.innerHTML = "<li>Password must contain a number</li>";
            passwordNumbers.style.color = "green";
        }

        if (!/^(?=.*[@$!%*?&-])[A-Za-z\d@$!%*?&-]+$/.test(passwordVal)) {
            passwordSpecialChars.innerHTML =
                "<li>Password must contain a special character</li>";
            passwordSpecialChars.style.color = "red";
        } else {
            passwordSpecialChars.innerHTML =
                "<li>Password must contain a special character</li>";
            passwordSpecialChars.style.color = "green";
        }
    }

    password.addEventListener("input", validatePassword)
</script>



</html>