<style>
    .row-cols-7 {
        width: 40% !important;
    }

    .row-cols-7>* {
        width: calc(100% / 4.2);
    }

    .filter_specific {
        flex: 1 !important;
    }
</style>

<?php
$count_all = 0;
$count_assigned = 0;
$count_requested = 0;
$count_completed = 0;

?>
<div>

</div>

<div class="filter_specific d-flex align-items-center justify-content-between">
    <div class="row row-cols-7 mx-0 px-0 g-0 my-2">
        <a href="<?= base_url('my_tickets/assigned') ?>">
            <div class="col <?= ($status == "assigned") ? "active" : "" ?>">
                <span class="text text-start">Assigned</span>
                <span class="count">
                    <?php foreach ($ticket_assigned as $ticket) {
                        if (idFormatRemove($ticket['user_id']) == $_SESSION['user_id']) {
                            $count_assigned++;
                        }
                    }
                    echo $count_assigned; ?>
                </span>
            </div>
        </a>
        <a href="<?= base_url('my_tickets/requested') ?>">
            <div class=" col <?= ($status == "requested") ? "active" : "" ?>">
                <span class="text text-start">Requested</span>
                <span class="count">
                    <?php foreach ($tickets_count as $ticket) {
                        if ($ticket['requester_id'] == $_SESSION['user_id']) {
                            $count_requested++;
                        }
                    }
                    echo $count_requested; ?>
                </span>
            </div>
        </a>
        <a href="<?= base_url('my_tickets/completed') ?>">
            <div class=" col <?= ($status == "completed") ? "active" : "" ?>">
                <span class="text text-start">Completed</span>
                <span class="count">
                    <?php foreach ($tickets_count as $ticket) {
                        if (strtolower($ticket['ticket_status']) == strtolower("closed") && $ticket['priority'] !== null) {
                            $count_completed++;
                        }
                    }
                    echo $count_completed; ?>
                </span>
            </div>
        </a>
        <a href="<?= base_url('my_tickets/all') ?>">
            <div class="col ticket-all">
                <span class="text text-start">All</span>
                <span class="count">
                    <?php foreach ($tickets_count as $count) {

                        // requester matches current user
                        if ($count['requester_id'] == $_SESSION['user_id']) {
                            $count_all++;
                            continue;
                        }

                        // assigned user matches current user
                        foreach ($ticket_assigned as $assign) {
                            if ((int) idFormatRemove($assign['user_id']) == (int) $_SESSION['user_id']) {
                                $count_all++;
                                break;
                            }
                        }
                    }

                    echo $count_all; ?>
                </span>
            </div>
        </a>
    </div>
    <div class="d-flex">
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
        <div>
            <button class="btn btn-filter-export btn-filter" onclick="toggleFilterOptions()"><i
                    class="fa-solid fa-filter"></i>
                Filter</button>
        </div>

    </div>



</div>

<div class="filter_options mb-3">
    <form id="filterForm">
        <h5 class="text-start">Filters</h5>
        <div class="row">
            <?php if ($status == "all"): ?>
                <div class="col-md-3">
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
                <div class="col-md-3">
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
            <div class="col-md-3">
                <div class="input-wrapper">
                    <select name="filterDepartment" id="filterDepartment" class="form-control">
                        <option value="">- Select Department -</option>
                        <?php foreach ($departments as $department): ?>
                            <option value="<?= get_abbreviation($department['department_name']) ?>">
                                <?= $department['department_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <i class="fa-solid fa-angle-down icon-dropdown"></i>
                </div>

            </div>
            <div class="col-md-3 text-start">
                <button type="reset" class="btn btn-reset has-tooltip" title="Reset">
                    <i class="fa-solid fa-filter-circle-xmark"></i></button>
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