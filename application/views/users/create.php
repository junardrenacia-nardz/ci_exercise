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
                    <h2>STEP 1 - Employee Information</h2>
                    <div class="mt-5 ">
                        <form action="step-1-register" method="POST" id="form1" class="">
                            <input type="hidden" name="step" value="2">
                            <div class="form d-flex flex-column justify-content-between">
                                <div class="fields">
                                    <div class="row">
                                        <h5>Personal Info</h5>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 mt-2">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" name="firstName" id="firstName" class="form-control"
                                                value="" required>
                                            <span id="errorFirstName" class="text-danger fw-bold"></span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 mt-2">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" name="lastName" id="lastName" class="form-control"
                                                value="" required>

                                        </div>
                                        <div class="col-lg-6 col-xl-4 mt-2">
                                            <label for="contact" class="form-label">Contact Number</label>
                                            <input type="tel" name="contact" id="contact" class="form-control" value=""
                                                required>
                                            <span id="errorContact" class="text-danger fw-bold"></span>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <h5>Employee Role and Department</h5>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 mt-2">
                                            <label for="firstName" class="form-label">Department</label>
                                            <select name="department" id="department" class="form-control">
                                                <option value="">- Select your Department -</option>
                                                <option value="Information Technology">Information Technology</option>
                                                <option value="Acquisition">Acquisition</option>
                                                <option value="Accounting">Accounting</option>
                                            </select>
                                            <span id="errorFirstName" class="text-danger fw-bold"></span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 mt-2">
                                            <label for="lastName" class="form-label">Role</label>
                                            <select name="role" id="role" class="form-control">
                                                <option value="">- Select your Role -</option>
                                                <option value="Quality Assurance">Quality Assurance</option>
                                                <option value="Web Developer">Web Developer</option>
                                                <option value="Software Engineer">Software Engineer</option>
                                            </select>

                                        </div>

                                    </div>
                                </div>

                                <div class="buttons d-flex justify-content-between">
                                    <a href="<?= site_url('users') ?>" class="btn btn-outline-dark">Go back to
                                        Login</a>
                                    <button class="btn btn-dark" type="submit" id="submit-1"
                                        name="submit-1">Next</button>
                                </div>
                            </div>


                        </form>
                    </div>


                </div>
                <div class="step-2 col-sm-12 col-md-12 col-lg-2" style="background-color: rgba(5, 4, 4, 0.5); ">
                    <h1 class="text-center text-white">2</h1>
                </div>
            </div>

        </div>


    </main>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>
<script src="js/validation.js"></script>
<script>
    step1.addEventListener("input", (e) => {
        if (validation(form1Arr)) {
            submit1.disabled = false;
        } else {
            submit1.disabled = true;
        }
    });
</script>



</html>