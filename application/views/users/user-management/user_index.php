<?php
$errors = $this->session->flashdata('errors');
$old = $this->session->flashdata('old_input');
?>
<div class="top-bar d-flex align-items-center">
    <div class="user-filter d-flex align-items-center">
        <div class="filter-option d-flex align-items-center">
            <form id="filterForm" class="m-0">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="input-wrapper">
                            <select name="filterDepartment" id="filterDepartment" class="form-control pe-4">
                                <option value="">- Select Department -</option>
                                <?php foreach ($departments as $department): ?>
                                <option value="<?= ucwords(get_abbreviation($department['department_name'])) ?>">
                                    <?= $department['department_name'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <i class=" fa-solid fa-angle-down icon-dropdown"></i>
                        </div>
                    </div>
                    <div class="me-3">
                        <div class="input-wrapper">
                            <select name="filterStatus" id="filterStatus" class="form-control pe-4">
                                <option value="">- Select Status -</option>
                                <option value="Active">Active</option>
                                <option value="Deactivated">Deactivated</option>
                            </select>
                            <i class=" fa-solid fa-angle-down icon-dropdown"></i>
                        </div>
                    </div>
                    <div class="me-3">
                        <div class="input-wrapper">
                            <select name="filterRole" id="filterRole" class="form-control pe-4">
                                <option value="">- Select Role -</option>
                                <?php foreach ($roles as $role): ?>
                                <option value="<?= ucwords($role['access_name']) ?>">
                                    <?= ucwords($role['access_name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <i class=" fa-solid fa-angle-down icon-dropdown"></i>
                        </div>
                    </div>

                    <div class="text-start">
                        <button type="reset" class="btn btn-reset has-tooltip" title="Reset">
                            <i class="fa-solid fa-filter-circle-xmark"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="user-util d-flex align-items-center justify-content-end w-100">
    <button class="btn btn-filter-export btn-filter me-2 px-3" onclick="toggleFilterOptions()">
        <i class="fa-solid fa-filter me-2"></i>Filter</button>

    <div class="dropdown me-2 ">
        <button class="btn dropdown-toggle btn-filter-export btn-export px-3" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa-solid fa-download me-2"></i> Export
        </button>

        <ul class="dropdown-menu">
            <li><a class="dropdown-item btn-export-excel" href="#">Export as Excel</a></li>
            <li><a class="dropdown-item btn-export-pdf" href="#">Export as PDF</a></li>
        </ul>
    </div>
    <button class="btn btn-filter-export btn-add-user me-2 px-3" data-bs-toggle="modal" data-bs-target="#add_user">
        <i class="fa-solid fa-user-plus me-2"></i>
        Add User</button>
    <button class="btn btn-filter-export btn-add-user px-3" data-bs-toggle="modal" data-bs-target="#approve_user">
        <i class="fa-solid fa-key me-2"></i>
        Roles and Permissions</button>
</div>

<div class="px-4 py-2">
    <div class="table-wrapper">

        <table class="table tbl-custom" id="userTable">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th class="text-center">User Status</th>
                    <th class="text-center">Dept</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Joined Date</th>
                    <th class="text-center">Last Active</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <?php if(strtolower($user['status']) !== strtolower("pending")): ?>
                <tr class="align-middle">
                    <td>
                        <?= $user['user_id'] ?>
                    </td>
                    <td>
                        <div class="user_name d-flex align-items-center">
                            <div class=" rounded-5 d-flex align-items-center justify-content-center me-2"
                                style="color: white; width: 25px; height: 25px; background: <?= ($user['gender'] == "male") ? "var(--gender-male)" : "var(--gender-female)" ?> ;">
                                <b class="d-flex align-items-center"><?= name_abbr(
                                        $user['first_name'],
                                        $user['last_name']
                                    ); ?></b>
                            </div>
                            <span class=""><?= $user['first_name'] . " " . $user['last_name'] ?></span>

                        </div>

                    </td>
                    <td><?= $user['email'] ?></td>
                    <td class="text-center">
                        <?php if (strtolower($user['status']) !== strtolower("active")): ?>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="priority-critical badge text-center"><?= ucwords($user['status']) ?></span>
                        </div>
                        <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="priority-low badge class"><?= ucwords($user['status']) ?></span>
                        </div>
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><?= ucwords(get_abbreviation($user['department_name'])) ?></td>
                    <td class="text-center"><?= ucwords($user['access_name']) ?></td>
                    <td class="text-center"><?= date('m-d-Y', strtotime($user['created_at'])) ?></td>
                    <td class="text-center">
                        <?php
                            date_default_timezone_set('Asia/Manila');

                            $created = new DateTime($user['updated_at']);

                            $today = new DateTime();
                            $today->setTimezone(new DateTimeZone('Asia/Manila'));

                            $diffSeconds = $today->getTimestamp() - $created->getTimestamp();

                            $minutes = floor($diffSeconds / 60);
                            $hours = floor($diffSeconds / 3600);
                            $days = floor($diffSeconds / 86400);
                            $months = floor($diffSeconds / (30 * 86400));
                            $years = floor($diffSeconds / (365 * 86400));
                            ?>

                        <?php if ($minutes < 60): ?>
                        <span><?= $minutes ?> minute(s) ago</span>


                        <?php elseif ($hours < 24): ?>
                        <span><?= $hours ?> hour(s) ago</span>

                        <?php elseif ($days < 30): ?>
                        <span><?= $days ?> day(s) ago</span>

                        <?php elseif ($months < 12): ?>
                        <span><?= $months ?> month(s) ago</span>

                        <?php else: ?>
                        <span><?= $years ?> year(s) ago</span>

                        <?php endif; ?>
                    </td>
                    <td class="text-center">

                        <div class="action-group user-action-btn">
                            <!-- Edit -->
                            <a href="" title="Edit"
                                class="action-item btn btn-sm d-flex align-items-center px-2 has-tooltip">
                                <i class="fa-solid fa-pen-to-square"></i>

                            </a>

                            <!-- Divider -->
                            <div style=" width: 1px; background: var(--border);">
                            </div>

                            <?php if(strtolower($user['status']) == strtolower("active")): ?>
                            <!-- Delete -->
                            <a href="<?= base_url('users/update_employee_status/' . $user['employee_id'] . "/deactivated/" .$user['user_id']) ?>"
                                title="Delete"
                                class="action-item btn btn-sm d-flex align-items-center px-2 has-tooltip">
                                <i class="fa-solid fa-trash"></i>
                            </a>

                            <!-- Divider -->
                            <div style="width: 1px; background: var(--border);"></div>
                            <?php else: ?>
                            <!-- Reactivate -->
                            <a href="<?= base_url('users/update_employee_status/' . $user['employee_id'] . "/active/" .$user['user_id']) ?>"
                                title="Reactivate"
                                class="action-item btn btn-sm d-flex align-items-center px-2 has-tooltip">
                                <i class="fa-solid fa-arrow-rotate-left"></i>
                            </a>

                            <!-- Divider -->
                            <div style="width: 1px; background: var(--border);"></div>
                            <?php endif; ?>


                            <!-- Audit Trail -->
                            <a href="" title="Audit Trail"
                                class="action-item btn btn-sm d-flex align-items-center px-2 has-tooltip">
                                <i class="fa-solid fa-clipboard-list"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="add_user" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between w-100 ps-0">
                        <div></div>
                        <h5>Create New Account</h5>
                        <button type="button" class="btn-close btn-close-black btn-close-reload"
                            data-bs-dismiss="modal"></button>
                    </div>
                    <form action="<?= base_url('users/register') ?>" method="POST" id="step1Form" class="">
                        <div class="create-account mt-4 d-flex flex-column justify-content-between">
                            <div class="fields">
                                <div class="row">
                                    <h6>Personal Info</h6>
                                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mt-1">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" name="firstName" id="firstName" class="form-control"
                                            value="<?= $old['firstName'] ?? '' ?>">
                                        <span id="" class="text-danger"><?= $errors['firstName'] ?? '' ?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mt-1">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" name="lastName" id="lastName" class="form-control"
                                            value="<?= $old['lastName'] ?? '' ?>">
                                        <span id="" class="text-danger"><?= $errors['lastName'] ?? '' ?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-1">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">- Gender -</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <span id="" class="text-danger"><?= $errors['gender'] ?? '' ?></span>
                                    </div>
                                    <div class="col-md-8 col-lg-6 col-xl-6 mt-1">
                                        <label for="contact" class="form-label">Contact Number</label>
                                        <input type="tel" name="contact" id="contact" class="form-control"
                                            value="<?= $old['contact'] ?? '' ?>">
                                        <span id="" class="text-danger"><?= $errors['contact'] ?? '' ?></span>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 mt-1">
                                        <label for="contact" class="form-label">Email</label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            value="<?= $old['email'] ?? '' ?>">
                                        <span class="text-danger"><?= $errors['email'] ?? '' ?></span>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <h6>Employee Role and Department</h6>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-1">
                                        <label for="firstName" class="form-label">Department</label>
                                        <select name="department" id="department" class="form-control">
                                            <option value="">- Select a Department -</option>
                                            <?php foreach ($departments as $department): ?>
                                            <option value="<?= $department['department_id'] ?>"
                                                <?= isset($old['department']) && $old['department'] == $department['department_id'] ? 'selected' : '' ?>>
                                                <?= $department['department_name'] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id="" class="text-danger"><?= $errors['department'] ?? '' ?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-1">
                                        <label for="lastName" class="form-label">Position</label>
                                        <select name="position" id="position" class="form-control" disabled>
                                            <option value="">- Select a Position -</option>
                                            <?php foreach ($positions as $position): ?>
                                            <option value="<?= $position['position_id'] ?>"
                                                data-department="<?= $position['department_id'] ?>"
                                                <?= isset($old['position']) && $old['position'] == $position['position_id'] ? 'selected' : '' ?>>
                                                <?= $position['position_name'] ?>
                                            </option>
                                            <?php endforeach; ?>

                                        </select>
                                        <span id="" class="text-danger"><?= $errors['position'] ?? '' ?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-1">
                                        <label for="lastName" class="form-label">Escalation Level</label>
                                        <select name="tier" id="tier" class="form-control">
                                            <option value="">- Select a Escalation -</option>
                                            <?php foreach ($escalations as $e): ?>
                                            <option value="<?= $e['escalation_id'] ?>"
                                                <?= isset($old['tier']) && $old['tier'] == $e['escalation_id'] ? 'selected' : '' ?>>
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
                                        <select name="role" id="role" class="form-control">
                                            <option value="">- Select a Role -</option>
                                            <?php foreach ($roles as $role): ?>
                                            <option value="<?= $role['access_id'] ?>"
                                                <?= isset($old['role']) && $old['role'] == $role['access_id'] ? 'selected' : '' ?>>
                                                <?= ucwords($role['access_name']) ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id="" class="text-danger"><?= $errors['role'] ?? '' ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="buttons d-flex justify-content-end mt-3">
                                <a href="" type="submit" name="direction" value="go_to_login" data-bs-dismiss="modal"
                                    class="btn btn-outline-dark btn-close-reload me-2">Cancel</a>
                                <button class="btn btn-dark" type="submit" id="submit-1" name="direction"
                                    value="submit">Register</button>
                            </div>
                        </div>


                    </form>


                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="approve_user" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Roles and Permission</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-wrapper">

                        <table class="table tbl-custom" id="userTable">
                            <thead>
                                <tr>
                                    <th class="text-start">User ID</th>
                                    <th class="text-start">Full Name</th>
                                    <th class="text-start">Email</th>
                                    <th class="text-center">User Status</th>
                                    <th class="text-center">Dept</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Joined Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                <?php if(strtolower($user['status']) == strtolower("Pending")): ?>
                                <tr class="align-middle">
                                    <td>
                                        <?= $user['user_id'] ?>
                                    </td>
                                    <td>
                                        <div class="user_name d-flex align-items-center">
                                            <span class=""><?= $user['first_name'] . " " . $user['last_name'] ?></span>
                                        </div>

                                    </td>
                                    <td><?= $user['email'] ?></td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span
                                                class="priority-medium badge class"><?= ucwords($user['status']) ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center"><?= ucwords(get_abbreviation($user['department_name'])) ?>
                                    </td>
                                    <td class="text-center"><?= ucwords($user['access_name']) ?></td>
                                    <td class="text-center"><?= date('m-d-Y', strtotime($user['created_at'])) ?></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-evenly">
                                            <a href="<?= base_url('users/update_employee_status/' . $user['employee_id'] . "/active/" .$user['user_id']) . "/" . TRUE ?>"
                                                class="btn rounded-5 has-tooltip" title="Approve">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                            <a href="<?= base_url('delete_users/' . substr($user['user_id'], -1) ."/" . $user['employee_id']) ?>"
                                                class="btn rounded-5 has-tooltip" title="Reject">
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-bs-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    const filterToggle = document.querySelector(".btn-filter");
    const filterOptions = document.querySelector(".filter-option");

    function toggleFilterOptions() {
        filterOptions.classList.toggle("collapsed");

    }
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const department = document.getElementById("department");
        const position = document.getElementById("position");

        const allOptions = Array.from(position.options);

        function filterPositions(selectedDept) {
            position.innerHTML = '<option value="">- Select a Position -</option>';

            if (selectedDept === "") {
                position.disabled = true;
                return;
            }

            position.disabled = false;

            allOptions.forEach(option => {
                if (option.dataset.department === selectedDept) {
                    position.appendChild(option);
                }
            });
        }

        // 🔁 Run when user changes department
        department.addEventListener("change", function() {
            filterPositions(this.value);
        });

        // ✅ RUN ON PAGE LOAD (THIS FIXES YOUR ISSUE)
        if (department.value !== "") {
            filterPositions(department.value);
        }
    });
    </script>