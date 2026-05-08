<script>
console.log(<?= $user ?>)
</script>
<div class="d-flex justify-content-between w-100 ps-0">
    <div></div>
    <h5>Edit User Details</h5>
    <button type="button" class="btn-close btn-close-black btn-close-reload" data-bs-dismiss="modal"></button>
</div>
<form action="<?= base_url('users/edit_user/' . ($old['user_id'] ?? $user['user_id'] ?? ''))  ?>" method="POST"
    id="step1Form" class=" px-3">
    <input type="hidden" name="user_id" id="user_id" value="<?= $old['user_id'] ?? $user['user_id'] ?? '' ?>">
    <input type="hidden" name="employee_id" id="employee_id"
        value="<?= $old['employee_id'] ?? $user['employee_id'] ?? '' ?>">
    <div class="create-account mt-4 d-flex flex-column justify-content-between">
        <div class="fields">
            <div class="row">
                <h6>Personal Info</h6>
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mt-1">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" name="firstName" id="editfirstName" class="form-control"
                        value="<?= $old['firstName'] ?? $user['first_name'] ?? '' ?>">
                    <span id="" class="text-danger"><?= $errors['firstName'] ?? '' ?></span>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mt-1">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" name="lastName" id="editlastName" class="form-control"
                        value="<?= $old['lastName'] ?? $user['last_name'] ?? '' ?>">
                    <span id="" class="text-danger"><?= $errors['lastName'] ?? '' ?></span>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-1">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" id="editgender" class="form-control">
                        <option value="">- Gender -</option>
                        <option value="male"
                            <?= ($old['gender'] ?? $user['gender'] ?? '') == "male" ? 'selected' : '' ?>>
                            Male</option>
                        <option value="female"
                            <?= ($old['gender'] ?? $user['gender'] ?? '') == "female" ? 'selected' : '' ?>>
                            Female</option>
                    </select>
                    <span id="" class="text-danger"><?= $errors['gender'] ?? '' ?></span>
                </div>
                <div class="col-md-8 col-lg-6 col-xl-6 mt-1">
                    <label for="contact" class="form-label">Contact Number</label>
                    <input type="tel" name="contact" id="editcontact" class="form-control"
                        value="<?= $old['contact'] ?? $user['contact_number'] ??  '' ?>">
                    <span id="" class="text-danger"><?= $errors['contact'] ?? '' ?></span>
                </div>
                <div class="col-lg-6 col-xl-6 mt-1">
                    <label for="contact" class="form-label">Email</label>
                    <input type="text" name="email" id="editemail" class="form-control"
                        value="<?= $old['email'] ?? $user['email'] ?? '' ?>">
                    <span class="text-danger"><?= $errors['email'] ?? '' ?></span>
                </div>
            </div>
            <div class="row mt-4">
                <h6>Employee Role and Department</h6>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-1">
                    <label for="firstName" class="form-label">Department</label>
                    <select name="department" id="editdepartment" class="form-control">
                        <option value="">- Select a Department -</option>
                        <?php foreach ($departments as $department): ?>
                        <option value="<?= $department['department_id'] ?>"
                            <?= ($old['department'] ?? $user['department_id'] ?? "") == $department['department_id'] ? 'selected' : '' ?>>
                            <?= $department['department_name'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <span id="" class="text-danger"><?= $errors['department'] ?? '' ?></span>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-1">
                    <label for="lastName" class="form-label">Position</label>
                    <select name="position" id="editposition" class="form-control">
                        <option value="">- Select a Position -</option>
                        <?php foreach ($positions as $position): ?>
                        <option value="<?= $position['position_id'] ?>"
                            data-department="<?= $position['department_id'] ?>"
                            <?= ($old['position'] ?? $user['position_id'] ?? "") == $position['position_id'] ? 'selected' : '' ?>>
                            <?= $position['position_name'] ?>
                        </option>
                        <?php endforeach; ?>

                    </select>
                    <span id="" class="text-danger"><?= $errors['position'] ?? '' ?></span>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-1">
                    <label for="lastName" class="form-label">Escalation Level</label>
                    <select name="tier" id="edittier" class="form-control">
                        <option value="">- Select a Escalation -</option>
                        <?php foreach ($escalations as $e): ?>
                        <option value="<?= $e['escalation_id'] ?>"
                            <?= ($old['tier'] ?? $user['escalation_id'] ?? "") == $e['escalation_id'] ? 'selected' : '' ?>>
                            <?php if ($e['escalation_level'] !== "10"): ?>
                            Level <?= $e['escalation_level'] ?>
                            <?php else: ?>
                            Super Admin Level
                            <?php endif; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <span id="" class="text-danger"><?= $errors['tier'] ?? '' ?></span>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-1">
                    <label for="lastName" class="form-label">Role</label>
                    <select name="role" id="editrole" class="form-control">
                        <option value="">- Select a Role -</option>
                        <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['access_id'] ?>"
                            <?= ($old['role'] ?? $user['access_id'] ?? "") == $role['access_id'] ? 'selected' : '' ?>>
                            <?= ucwords($role['access_name']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <span id="" class="text-danger"><?= $errors['role'] ?? '' ?></span>
                </div>
            </div>
            <div class="mt-4">
                <a class="btn btn-outline-secondary" data-bs-target="#changePassword" data-bs-toggle="modal">
                    <i class="fa-solid fa-unlock me-2"></i>Change Password</a>
            </div>
        </div>

        <div class="buttons d-flex justify-content-end mt-3">
            <a href="" type="submit" name="direction" value="go_to_login" data-bs-dismiss="modal"
                class="btn btn-outline-dark me-2">Cancel</a>
            <button class="btn btn-dark" type="submit" id="submit-1" name="direction" value="submit">Update</button>
        </div>
    </div>


</form>

<script>
const editDepartment = document.getElementById("editdepartment");
const editPosition = document.getElementById("editposition");

if (editDepartment && editPosition) {
    setupDepartmentPosition(editDepartment, editPosition);
}

function setupDepartmentPosition(deptSelect, posSelect) {

    const allOptions = Array.from(posSelect.options);

    function filterPositions(selectedDept, selectedPosition = null) {

        posSelect.innerHTML = '<option value="">- Select a Position -</option>';

        if (!selectedDept) {
            posSelect.disabled = true;
            return;
        }

        posSelect.disabled = false;

        allOptions.forEach(option => {

            // skip placeholder
            if (option.value === "") return;

            if (option.dataset.department == selectedDept) {

                const newOption = option.cloneNode(true);

                // restore selected position
                if (selectedPosition && newOption.value == selectedPosition) {
                    newOption.selected = true;
                }

                posSelect.appendChild(newOption);
            }
        });
    }

    deptSelect.addEventListener("change", function() {
        filterPositions(this.value);
    });

    // initial load
    if (deptSelect.value) {
        filterPositions(deptSelect.value, posSelect.value);
    }
}
</script>