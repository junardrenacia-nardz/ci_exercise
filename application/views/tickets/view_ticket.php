<?php
$showModal = $this->session->flashdata('showModal');
$old = null;

if ($showModal === 'edit_assign_person') {
    $old = $this->session->flashdata('old_input');
}

$count_assign = 0;
$inCharge = [];
foreach ($ticket_assigned as $assigned):
    if ($ticket['ticket_id'] == $assigned['ticket_id']):
        $inCharge[] = [
            "name" => $assigned['first_name'] . " " . $assigned['last_name'],
            "id" => $assigned['user_id']
        ];
        $count_assign++;
    endif;
endforeach; ?>
<div class="w-100 rounded-3 mt-4 p-4 mx-auto mb-5"
    style="background-color: white; max-width: 1290px ; box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);">
    <div class="ticket-details d-flex justify-content-between">
        <div class="information-tickets col-md-7 pe-3">
            <div class="ticket-subject d-flex align-items-center mb-1">
                <span class="subject me-2"><?= $ticket['ticket_name'] ?></span>
                <span class="badge p-1 badge-ticket fw-bold">Main Ticket</span>
            </div>

            <div id="ticket_id">
                <span class="badge p-1 badge-ticket fw-bold">
                    Ticket ID: <?= $ticket['ticket_id'] ?></span>
            </div>
            <div class="detail-title mt-3">
                <span class="title fw-bold">Ticket Details:</span>
            </div>
            <div class="details mt-2">
                <div class="person-in-charge d-flex">
                    <span class="text-nowrap me-2"><i><b>Person/s In-Charge: </b></i> </span>
                    <span>
                        <?php if ($count_assign !== 0): ?>
                            <?php foreach ($inCharge as $person): ?>
                                <?php echo $person['name'] ?>,
                            <?php endforeach; ?>
                        <?php else: ?>
                            <i>Not assigned to anyone yet</i>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="department-author mt-2 d-flex">
                    <span class="badge bg-light rounded-5 text-black has-tooltip me-1" title="Department">
                        <i class="fa-solid fa-building me-1"></i><?= $ticket['department_name'] ?>
                    </span>
                    <span class="badge bg-light rounded-5 text-black has-tooltip" title="Author">
                        <i class="fa-regular fa-user me-1"></i>
                        <?= $ticket['requester_first_name'] . " " . $ticket['requester_last_name'] ?>
                    </span>
                </div>
                <div class="dates mt-3 row">
                    <div class="col-md-3 col-sm-6 d-flex flex-column">
                        <b>Expected Start Date:</b>
                        <span><?= $ticket['expected_start_date'] ?? "N/A" ?></span>
                    </div>
                    <div class="col-md-3 col-sm-6 d-flex flex-column">
                        <b>Actual Start Date:</b>
                        <span><?= $ticket['actual_start_date'] ?? "N/A" ?></span>
                    </div>
                    <div class="col-md-3 col-sm-6 d-flex flex-column">
                        <b>Expected Resolved Date:</b>
                        <span><?= $ticket['expected_resolved_date'] ?? "N/A" ?></span>
                    </div>
                    <div class="col-md-3 col-sm-6 d-flex flex-column">
                        <b>Date Created:</b>
                        <span><?= date('F j, Y, h:i a') ?? "N/A" ?></span>
                    </div>
                    <div class="col-md-3 col-sm-6 d-flex flex-column">
                        <b>Resolved Date:</b>
                        <span><?= $ticket['resolved_date'] ?? "N/A" ?></span>
                    </div>
                    <div class="col-md-3 col-sm-6 d-flex flex-column">
                        <b>Days Since Resolved:</b>
                        <span><?= $ticket['days_since_resolved'] ?? "N/A" ?></span>
                    </div>
                    <div class="col-md-3 col-sm-6 d-flex flex-column">
                        <b>Resolution Aging:</b>
                        <span><?= $ticket['actual_start_date'] ?? "N/A" ?></span>
                    </div>
                </div>

                <div class="ticket_description mt-4 d-flex flex-column">
                    <span><b>Ticket Description:</b> (<i>Please detail the request</i>)</span>
                    <div class="description-body mt-3 bg-light p-3">
                        <?= $ticket['ticket_description'] ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="comments col-md-5">
            <div class="ticket-button d-flex justify-content-end">
                <?php if ($ticket['ticket_status'] !== "For Approval"): ?>
                    <?php if ($count_assign == 0): ?>
                        <a href="" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modal_assign_person">

                            <i class="fa-solid fa-plus me-1"></i> Assign PIC</a>
                    <?php else: ?>
                        <a href="" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modal_assign_person">
                            <i class="fa-solid fa-user-group me-1"></i> Re-assign PIC</a>
                    <?php endif; ?>

                <?php endif; ?>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_department">
                    <i class="fa-solid fa-building-user me-1"></i> Re-assign Dept.</button>
            </div>

            <div class="comments-col w-100 mt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h6>Comments</h6>
                    <a href="" class="btn btn-success">
                        <i class="fa-solid fa-plus"></i> New</a>
                </div>

                <div class="comment-contents p-3 mt-3 bg-light">
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment my-2 d-flex flex-column">
                            <span class="mb-1"><b
                                    class="fs-6 me-1"><?= $comment['first_name'] . " " . $comment['last_name'] ?></b> <i
                                    class="fw-regular">(<?= $comment['department_name'] ?>)</i></span>
                            <span><?= $comment['comment'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>

    </div>
</div>

<!--ASSIGN Person to the Ticket-->
<div class="modal fade" id="modal_assign_person" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-3">

            <!-- HEADER -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold">
                    <?= ($count_assign === 0) ? "Assign Ticket" : "Re-assign Ticket" ?>
                </h5>

                <button type="button" class="btn-close btn-close-white btn-close-reload"
                    data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body px-4 py-3">

                <!-- Department Card -->
                <div class="p-3 bg-light rounded-3 mb-3">
                    <label class="text-muted small mb-1">Department</label>
                    <div class="fw-semibold fs-6">
                        <i class="fa-solid fa-building me-2 text-primary"></i>
                        <?= $ticket['department_name'] ?>
                    </div>
                </div>

                <!-- Person In Charge -->
                <div class="p-3 border rounded-3">
                    <label class="text-muted small mb-2 d-block">Person in Charge</label>

                    <?php if ($count_assign !== 0) : ?>
                        <ul class="list-unstyled mb-0">
                            <?php foreach ($inCharge as $person): ?>
                                <li class="d-flex align-items-center justify-content-between mb-2 p-2 bg-light rounded">
                                    <span>
                                        <i class="fa-solid fa-user me-2 text-secondary"></i>
                                        <?= $person['name'] ?>
                                    </span>
                                    <span class="badge bg-secondary">
                                        #<?= $person['id'] ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <div class="text-muted fst-italic">
                            No person assigned yet.
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0 px-4 pb-4 d-flex justify-content-between">
                <button type="button" class="btn btn-secondary btn-close-reload" data-bs-dismiss="modal">
                    Close
                </button>

                <a href="" data-bs-toggle="modal" data-bs-target="#edit_assign_person" class="btn btn-outline-primary">
                    <i class="<?= ($count_assign === 0) ? "fa-solid fa-user-plus" : "fa-solid fa-user-pen" ?> me-1"></i>
                    <?= ($count_assign === 0) ? "Assign Person" : "Edit Assignment" ?>
                </a>
            </div>

        </div>
    </div>
</div>

<!--EDIT ASSIGNED EMPLOYEE-->

<div class="modal fade modal-lg edit_assign_person" id="edit_assign_person" tabindex="-1" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-3">

            <!-- HEADER -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold">
                    <?= ($count_assign === 0) ? "Assign Ticket" : "Edit Assigned Ticket" ?>
                </h5>

                <button type="button" class="btn-close btn-close-white btn-close-reload"
                    data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('tickets/assign_ticket/' . $ticket['ticket_id']) ?>" method="post">

                <?php foreach ($inCharge as $prevId): ?>
                    <input type="hidden" name="prev_id[]" value="<?= $prevId['id'] ?>">
                <?php endforeach; ?>

                <!-- BODY -->
                <div class="modal-body px-4 py-3">
                    <!-- Person In Charge -->

                    <div class="p-3 border rounded-3">
                        <label class="text-muted small mb-2 d-block">Person in Charge</label>
                        <table class="table" id="assignTableDynamic">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($old['employeeName'])): ?>
                                    <?php foreach ($old['employeeName'] as $selectedId): ?>
                                        <tr>
                                            <td>
                                                <div class="col-md-9">
                                                    <div class="input-wrapper">
                                                        <select name="employeeName[]" class="form-control">
                                                            <option value="">- Select person to be assigned -</option>
                                                            <?php foreach ($all_assigned as $choice): ?>
                                                                <?php if ($choice['department_id'] == $ticket['department_id']): ?>
                                                                    <option value="<?= $choice['user_id'] ?>"
                                                                        <?= ($selectedId == $choice['user_id']) ? "selected" : "" ?>>
                                                                        <?= $choice['first_name'] . " " . $choice['last_name'] ?>
                                                                        (#<?= $choice['user_id'] ?>)
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <i class="fa-solid fa-angle-down icon-dropdown"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger removeRow">X</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <?php if ($count_assign === 0): ?>
                                        <tr>
                                            <td>
                                                <div class="col-md-9">
                                                    <div class="input-wrapper">
                                                        <select name="employeeName[]" id="employeeName" class="form-control">
                                                            <option value="">- Select person to be assigned -</option>
                                                            <?php foreach ($all_assigned as $choice): ?>
                                                                <?php if ($choice['department_id'] == $ticket['department_id']): ?>
                                                                    <option value="<?= $choice['user_id'] ?>">
                                                                        <?= $choice['first_name'] . " " . $choice['last_name'] ?>
                                                                        (#<?= $choice['user_id'] ?>)
                                                                    </option>
                                                                <?php endif; ?>

                                                            <?php endforeach; ?>
                                                        </select>
                                                        <i class="fa-solid fa-angle-down icon-dropdown"></i>
                                                    </div>

                                                </div>
                                            </td>
                                            <td class="text-center"><button type="button"
                                                    class="btn btn-danger removeRow">X</button></td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($inCharge as $person): ?>
                                            <tr>
                                                <td>
                                                    <div class="col-md-9">
                                                        <div class="input-wrapper">
                                                            <select name="employeeName[]" id="employeeName" class="form-control">
                                                                <option value="">- Select person to be assigned -</option>
                                                                <?php foreach ($all_assigned as $choice): ?>
                                                                    <?php if ($choice['department_id'] == $ticket['department_id']): ?>
                                                                        <option value="<?= $choice['user_id'] ?>"
                                                                            <?= ($choice['user_id'] == $person['id']) ? "selected" : "" ?>>
                                                                            <?= $choice['first_name'] . " " . $choice['last_name'] ?>
                                                                            (#<?= $choice['user_id'] ?>)
                                                                        </option>
                                                                    <?php endif; ?>

                                                                <?php endforeach; ?>
                                                            </select>
                                                            <i class="fa-solid fa-angle-down icon-dropdown"></i>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td class="text-center"><button type="button"
                                                        class="btn btn-danger removeRow">X</button></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <button type="button" id="addRow" class="btn btn-primary">Add
                            Row</button>
                    </div>

                    <div class="expected_dates p-3 d-flex justify-content-between">
                        <div class="col-md-6 pe-1">
                            <label for="" class="mb-2">Expected Start Date:</label>
                            <input type="date" name="expectedStart" id="expectedStart" class="form-control"
                                value="<?= $old['expectedStart'] ?? '' ?>">
                        </div>
                        <div class="col-md-6 ps-1">
                            <label for="" class="mb-2">Expected End Date:</label>
                            <input type="date" name="expectedEnd" id="expectedEnd" class="form-control"
                                value="<?= $old['expectedEnd'] ?? '' ?>">
                        </div>
                    </div>


                </div>

                <!-- FOOTER -->
                <div class="modal-footer border-0 px-4 pb-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#modal_assign_person">
                        Close
                    </button>
                    <button type="submit" class="btn btn-outline-primary">
                        <i
                            class="<?= ($count_assign === 0) ? "fa-solid fa-user-plus" : "fa-solid fa-user-pen" ?> me-1"></i>
                        <?= ($count_assign === 0) ? "Save" : "Save Changes" ?>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


<!--DEPARTMENTS-->
<div class="modal fade" id="modal_department" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-3">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold">Department</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-3 py-3">
                <div class="col-12">
                    <!-- <label for="">Department:</label> -->
                    <div class="d-flex mt-2">
                        <input type="text" value="<?= $ticket['department_name'] ?>" class="form-control" readonly>
                        <a href="" data-bs-toggle="modal" data-bs-target="#edit_department"
                            class="btn btn-primary p-2 px-3 ms-2 has-tooltip" title="Change Department"><i
                                class="fa-solid fa-dice"></i></a>
                    </div>

                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>


        </div>
    </div>
</div>

<!--CHANGE DEPARTMENT-->
<div class="modal fade modalEdit" id="edit_department" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Re-assign Department</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?php echo base_url("tickets/reassign_department/") . $ticket['ticket_id'] ?>">
                <div class="modal-body">
                    <div class="col-12">
                        <div class="input-wrapper">
                            <select name="selectDepartment" id="selectDepartment" class="form-control">
                                <option value="">- Select Department -</option>
                                <?php foreach ($departments as $department): ?>
                                    <option value="<?= $department['department_id'] ?>"
                                        <?= ($ticket['department_id'] == $department['department_id']) ? "selected" : "" ?>>
                                        <?= $department['department_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <i class="fa-solid fa-angle-down icon-dropdown"></i>
                        </div>

                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#modal_department">Back</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(function() {
        $(".has-tooltip").tooltip();
    });
    document.querySelectorAll('.modalEdit').forEach(function(modal) {
        modal.addEventListener('hidden.bs.modal', function() {
            this.querySelector('form').reset();
            updateSelectOptions();
        });
    });

    const originalRowCount = <?= ($count_assign == 0) ? 1 : $count_assign ?>;

    let originalAssignTableHTML;

    document.addEventListener("DOMContentLoaded", function() {
        originalAssignTableHTML = document.querySelector("#assignTableDynamic tbody").innerHTML;
    });

    // document.querySelectorAll('.edit_assign_person').forEach(function(modal) {
    //     modal.addEventListener('hidden.bs.modal', function() {


    //         this.querySelector('form').reset();
    //         // remove added rows only (not DB rows)
    //         const rows = document.querySelectorAll("#assignTableDynamic tbody tr");

    //         rows.forEach((row, index) => {
    //             if (index >= originalRowCount) {
    //                 row.remove();
    //             }
    //         });
    //         updateSelectOptions();
    //     });
    // });

    document.addEventListener("DOMContentLoaded", function() {
        updateSelectOptions();
    });

    document.addEventListener("change", function(e) {
        if (e.target.matches("select[name='employeeName[]']")) {
            updateSelectOptions();
        }
    });

    // ADD ROW
    document.getElementById("addRow").addEventListener("click", () => {
        let assignTable = document.querySelector("#assignTableDynamic tbody");

        let assignRow = `
            <tr>
                <td>
                    <div class="col-md-9">
                        <div class="input-wrapper">
                            <select name="employeeName[]" id="employeeName" class="form-control">
                                <option value="">- Select person to be assigned -</option>
                                <?php foreach ($all_assigned as $choice): ?>
                                    <?php if ($choice['department_id'] == $ticket['department_id']): ?>
                                        <option value="<?= $choice['user_id'] ?>"
                                            <?= (set_value('employeeName')) ? "selected" : "" ?>>
                                            <?= $choice['first_name'] . " " . $choice['last_name'] ?>
                                            (#<?= $choice['user_id'] ?>)
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <i class="fa-solid fa-angle-down icon-dropdown"></i>
                        </div>

                    </div>
                </td>
                <td class="text-center"><button type="button"
                        class="btn btn-danger removeRow">X</button></td>
            </tr>`;

        assignTable.insertAdjacentHTML("beforeend", assignRow);
        updateSelectOptions();

    });

    // REMOVE ROW
    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("removeRow")) {
            e.target.closest("tr").remove();
            updateSelectOptions();
        }
    })

    function updateSelectOptions() {
        const selects = document.querySelectorAll(".edit_assign_person select[name='employeeName[]']")

        //collect all selected values 
        const selectedValues = Array.from(selects)
            .map(select => select.value)
            .filter(val => val !== "");

        selects.forEach(select => {
            const currentValue = select.value;

            Array.from(select.options).forEach(option => {
                // always keep placeholder enabled
                if (option.value === "") return;

                // disable if selected elsewhere (but not current select)
                if (selectedValues.includes(option.value) && option.value !== currentValue) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            })
        })
    }
</script>

<?php if ($this->session->flashdata('showModal')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalId = "<?= $this->session->flashdata('showModal'); ?>";
            var myModal = new bootstrap.Modal(document.getElementById(modalId));
            myModal.show();
        });
    </script>
<?php endif; ?>

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


<script id="reload-fix">
    document.querySelectorAll('.btn-close-reload').forEach(btn => {
        btn.addEventListener('click', function() {
            setTimeout(() => {
                location.reload();
            }, 250); // 1000ms = 1 second
        });
    });
</script>