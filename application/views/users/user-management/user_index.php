<div class="top-bar d-flex align-items-center">
    <div class="user-filter d-flex align-items-center">
        <div class="dropdown me-2">
            <button class="btn dropdown-toggle btn-filter-export btn-export" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa-solid fa-download me-2"></i> Export
            </button>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item btn-export-excel" href="#">Export as Excel</a></li>
                <li><a class="dropdown-item btn-export-pdf" href="#">Export as PDF</a></li>
            </ul>
        </div>


        <button class="btn btn-filter-export btn-filter" onclick="toggleFilterOptions()">
            <i class="fa-solid fa-filter me-2"></i>Filter</button>

        <div class="filter-option d-flex align-items-center ms-3">
            <span><i class="fa-solid fa-angles-right"></i></span>
            <form id="filterForm" class="ms-3 m-0">
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
                                <option value="Inactive">Inactive</option>
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
                        <button type="reset" class="btn btn-danger has-tooltip" title="Reset"><i
                                class="fa-solid fa-arrow-rotate-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="user-util">
    <button class="btn btn-filter-export btn-add-user">
        <i class="fa-solid fa-user-plus me-2"></i>
        Add User</button>
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
                            <?php if (strtolower($user['status']) == strtolower("inactive")): ?>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="priority-critical badge text-center"><?= ucwords($user['status']) ?></span>
                                </div>
                            <?php elseif (strtolower($user['status']) == strtolower("active")): ?>
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
                            $created = new DateTime($user['last_active']);
                            $today = new DateTime();

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
                                <!-- View -->
                                <a href="" title="View"
                                    class="action-item btn btn-sm d-flex align-items-center px-2 has-tooltip">
                                    <i class="fa-solid fa-eye me-1"></i>
                                </a>

                                <!-- Divider -->
                                <div style="width: 1px; background: var(--border);"></div>

                                <!-- Edit -->
                                <a href="" title="Edit"
                                    class="action-item btn btn-sm d-flex align-items-center px-2 has-tooltip">
                                    <i class="fa-solid fa-pen-to-square"></i>

                                </a>

                                <!-- Divider -->
                                <div style=" width: 1px; background: var(--border);">
                                </div>

                                <!-- Delete -->
                                <a href="" title="Delete"
                                    class="action-item btn btn-sm d-flex align-items-center px-2 has-tooltip">
                                    <i class="fa-solid fa-trash"></i>
                                </a>

                                <!-- Divider -->
                                <div style="width: 1px; background: var(--border);"></div>

                                <!-- Audit Trail -->
                                <a href="" title="Audit Trail"
                                    class="action-item btn btn-sm d-flex align-items-center px-2 has-tooltip">
                                    <i class="fa-solid fa-clipboard-list"></i>
                                </a>
                            </div>

        </div>


        </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
</div>
</div>

<?php
function get_abbreviation($string) {
    // Condition: Only proceed if there is more than 1 word
    if (str_word_count($string) > 1) {
        if (preg_match_all('/\b(\w)/', strtoupper($string), $matches)) {
            return implode('', $matches[0]);
        }
    }
    // Return original string if it's just one word or empty
    return $string;
}
?>
<script>
    const filterToggle = document.querySelector(".btn-filter");
    const filterOptions = document.querySelector(".filter-option");

    function toggleFilterOptions() {
        filterOptions.classList.toggle("collapsed");

    }
</script>