<?php
$count_all = 0;
$count_approval = 0;
$count_open = 0;
$count_pending = 0;
$count_ongoing = 0;
$count_testing = 0;
$count_closed = 0;

?>
<div class="dataTables_filter">
        <div class="row row-cols-7 mx-0 px-0 g-0 w-100 my-2">
                <a href="<?= base_url("tickets/approval") ?>">
                        <div class="col <?= ($status == "approval") ? "active" : "" ?>">
                                <span class="text text-start">For Approval</span>
                                <span class="count">
                                        <?php foreach ($tickets_count as $ticket) {
                                                if (strtolower($ticket['ticket_status']) == strtolower("For Approval")) {
                                                        $count_approval++;
                                                }
                                        }
                                        echo $count_approval; ?>
                                </span>
                        </div>
                </a>
                <a href="<?= base_url("tickets/open") ?>">
                        <div class="col <?= ($status == "open") ? "active" : "" ?>">
                                <span class="text text-start">To Assign</span>
                                <span class="count">
                                        <?php foreach ($tickets_count as $ticket) {
                                                if (strtolower($ticket['ticket_status']) == strtolower("open")) {
                                                        $count_open++;
                                                }
                                        }
                                        echo $count_open; ?>
                                </span>
                        </div>
                </a>
                <a href="<?= base_url("tickets/pending") ?>">
                        <div class="col <?= ($status == "pending") ? "active" : "" ?>">
                                <span class="text text-start">Assigned</span>
                                <span class="count">
                                        <?php foreach ($tickets_count as $ticket) {
                                                if (strtolower($ticket['ticket_status']) == strtolower("pending")) {
                                                        $count_pending++;
                                                }
                                        }
                                        echo $count_pending; ?>
                                </span>
                        </div>
                </a>
                <a href="<?= base_url("tickets/ongoing") ?>">
                        <div class="col <?= ($status == "ongoing") ? "active" : "" ?>">
                                <span class="text text-start">On Going</span>
                                <span class="count">
                                        <?php foreach ($tickets_count as $ticket) {
                                                if (strtolower($ticket['ticket_status']) == strtolower("on going")) {
                                                        $count_ongoing++;
                                                }
                                        }
                                        echo $count_ongoing; ?>
                                </span>
                        </div>
                </a>
                <a href="<?= base_url("tickets/testing") ?>">
                        <div class="col <?= ($status == "testing") ? "active" : "" ?>">
                                <span class="text text-start">For Testing</span>
                                <span class="count">
                                        <?php foreach ($tickets_count as $ticket) {
                                                if (strtolower($ticket['ticket_status']) == strtolower("testing")) {
                                                        $count_testing++;
                                                }
                                        }
                                        echo $count_testing; ?>
                                </span>
                        </div>
                </a>
                <a href="<?= base_url("tickets/closed") ?>">
                        <div class="col <?= ($status == "closed") ? "active" : "" ?>">
                                <span class="text text-start">Closed</span>
                                <span class="count">
                                        <?php foreach ($tickets_count as $ticket) {
                                                if (strtolower($ticket['ticket_status']) == strtolower("closed")) {
                                                        $count_closed++;
                                                }
                                        }
                                        echo $count_closed; ?>
                                </span>
                        </div>
                </a>
                <a href="<?= base_url("tickets/all") ?>">
                        <div class="col ticket-all">

                                <span class="text text-start">All</span>
                                <span class="count">
                                        <?php foreach ($tickets_count as $ticket) {
                                                $count_all++;
                                        }
                                        echo $count_all; ?>
                                </span>
                        </div>
                </a>
        </div>
</div>

<div class="filter_specific d-flex">
        <div class="dropdown me-2">
                <button class="btn dropdown-toggle btn-filter-export btn-export" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-download"></i> Export Data
                </button>

                <ul class="dropdown-menu">
                        <li><a class="dropdown-item btn-export-excel" href="#">Export as Excel</a></li>
                        <li><a class="dropdown-item btn-export-pdf" href="#">Export as PDF</a></li>
                </ul>
        </div>
        <!-- <button class="btn btn-success btn-filter-export btn-export"><i class="fa-solid fa-download"></i> Export
Data</button> -->
        <button class="btn btn-filter-export btn-filter" onclick="toggleFilterOptions()"><i
                        class="fa-solid fa-filter"></i>
                Filter</button>
</div>

<div class="filter_options mb-3 ">
        <form id="filterForm">
                <h5 class="text-start">Filters</h5>
                <div class="row">
                        <?php if ($status == "all"): ?>
                                <div class="col-md-3 mt-2">
                                        <div class="input-wrapper">
                                                <select name="filterStatus" id="filterStatus" class="form-control">
                                                        <option value="">- Select Status -</option>
                                                        <option value="For Approval">For Approval</option>
                                                        <option value="Open">Open</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="On Going">On Going</option>
                                                        <option value="For Testing">For Testing</option>
                                                        <option value="Closed">Closed</option>
                                                </select>
                                                <i class="fa-solid fa-angle-down icon-dropdown"></i>
                                        </div>
                                </div>
                        <?php endif; ?>
                        <?php if ($status !== "approval"): ?>
                                <div class="col-md-3 mt-2">
                                        <div class="input-wrapper">
                                                <select name="filterPriority" id="filterPriority" class="form-control">
                                                        <option value="">- Select Priority -</option>
                                                        <option value="Low">Low</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="High">High</option>
                                                        <option value="Critical">Critical</option>
                                                </select>
                                                <i class="fa-solid fa-angle-down icon-dropdown"></i>
                                        </div>

                                </div>
                        <?php endif; ?>
                        <div class="col-md-3 mt-2">
                                <div class="input-wrapper">
                                        <select name="filterDepartment" id="filterDepartment" class="form-control">
                                                <option value="">- Select Assigned Department Department -</option>
                                                <?php foreach ($departments as $department): ?>
                                                        <option value="<?= get_abbreviation($department['department_name']) ?>">
                                                                <?= $department['department_name'] ?>
                                                        </option>
                                                <?php endforeach; ?>
                                        </select>
                                        <i class="fa-solid fa-angle-down icon-dropdown"></i>
                                </div>
                        </div>
                        <?php if ($_SESSION['role_id'] == "4"): ?>
                                <div class="col-md-3 mt-2">
                                        <div class="input-wrapper">
                                                <select name="filterRequesterDepartment" id="filterRequesterDepartment"
                                                        class="form-control">
                                                        <option value="">- Select Requester Department -</option>
                                                        <?php foreach ($departments as $department): ?>
                                                                <option value="<?= get_abbreviation($department['department_name']) ?>">
                                                                        <?= $department['department_name'] ?>
                                                                </option>
                                                        <?php endforeach; ?>
                                                </select>
                                                <i class="fa-solid fa-angle-down icon-dropdown"></i>
                                        </div>
                                </div>
                        <?php endif; ?>
                        <div class="col-md-3 mt-2 d-flex align-items-end">
                                <button type="reset" class="btn btn-md btn-outline-dark px-4 has-tooltip"
                                        title="Reset Filters">
                                        <i class="fa-solid fa-filter-circle-xmark me-2"></i>
                                        Reset
                                </button>
                        </div>
                </div>



        </form>

</div>



<script>
        const filterToggle = document.querySelector(".btn-filter");
        const filterOptions = document.querySelector(".filter_options");

        function toggleFilterOptions() {
                filterOptions.classList.toggle("collapsed");

        }
</script>