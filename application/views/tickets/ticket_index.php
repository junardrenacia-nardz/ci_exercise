<div class="p-2">
    <div class="table-wrapper">

        <table class="table tbl-custom" id="ticketTable">
            <thead>
                <tr>
                    <th class="text-center">Aging Days</th>
                    <th>ID</th>
                    <th class="text-center">Priority</th>
                    <th>Subject</th>
                    <?php if ($status === "all"): ?>
                        <th>Status</th>
                    <?php endif ?>
                    <th class="text-center">Assigned Dept</th>
                    <th class="text-center">PIC</th>
                    <th>Created By</th>
                    <th class="text-center">Requester Dept</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ticket_details as $ticket): ?>
                    <?php if (strtolower($ticket['ticket_status']) !== strtolower("Not Approved")): ?>
                        <?php $count_assign = 0;
                        $peopleInCharge = [];
                        $inCharge = ""; ?>
                        <?php foreach ($ticket_assigned as $assigned): ?>
                            <?php if ($ticket['ticket_id'] == $assigned['ticket_id']): ?>
                                <?php $inCharge = $assigned['department_name'];
                                $peopleInCharge[] = $assigned["first_name"] . " " . $assigned["last_name"];
                                $count_assign++ ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <tr class="">
                            <td class="align-middle text-center">
                                <?php $created = new DateTime($ticket['ticket_created']);
                                $today = new DateTime();

                                $aging = $today->diff($created)->days;
                                ?>
                                <?php if ($aging <= 7): ?>
                                    <div>
                                        <span class="aging-custom aging-new"><?= $aging ?></span>
                                    </div>
                                <?php elseif ($aging <= 30): ?>
                                    <div>
                                        <span class="aging-custom aging-mid"><?= $aging ?></span>
                                    </div>
                                <?php elseif ($aging > 30): ?>
                                    <div>
                                        <span class="aging-custom aging-late"><?= $aging ?></span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle"><?= $ticket['ticket_id'] ?></td>
                            <td class="align-middle ">
                                <?php if (strtolower($ticket['priority']) == strtolower("critical")): ?>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="priority-critical badge text-center"><?= ucwords($ticket['priority']) ?></span>
                                    </div>
                                <?php elseif (strtolower($ticket['priority']) == strtolower("high")): ?>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="priority-high badge"><?= ucwords($ticket['priority']) ?></span>
                                    </div>
                                <?php elseif (strtolower($ticket['priority']) == strtolower("medium")): ?>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="priority-medium badge"><?= ucwords($ticket['priority']) ?></span>
                                    </div>
                                <?php elseif (strtolower($ticket['priority']) == strtolower("low")): ?>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="priority-low badge class"><?= ucwords($ticket['priority']) ?></span>
                                    </div>
                                <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h5>-</h5>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle"><?= $ticket['ticket_name'] ?></td>
                            <?php if ($status === "all"): ?>
                                <td class="align-middle">
                                    <?php if (
                                        strtolower($ticket['ticket_status']) == strtolower("for approval")
                                    ): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="status-approval"></div>
                                            <span class="text-start"><?= ucwords($ticket['ticket_status']) ?>
                                            </span>
                                        </div>
                                    <?php elseif (
                                        strtolower($ticket['ticket_status']) == strtolower("open")
                                    ): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="status-open"></div>
                                            <span class="text-start"><?= ucwords($ticket['ticket_status']) ?>
                                            </span>
                                        </div>
                                    <?php elseif (
                                        strtolower($ticket['ticket_status']) == strtolower("pending")
                                    ): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="status-pending"></div>
                                            <span class="text-start"><?= ucwords($ticket['ticket_status']) ?>
                                            </span>
                                        </div>
                                    <?php elseif (
                                        strtolower($ticket['ticket_status']) == strtolower("on going")
                                    ): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="status-ongoing"></div>
                                            <span class="text-start"><?= ucwords($ticket['ticket_status']) ?>
                                            </span>
                                        </div>
                                    <?php elseif (
                                        strtolower($ticket['ticket_status']) == strtolower("testing")
                                    ): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="status-testing"></div>
                                            <span class="text-start">For <?= ucwords($ticket['ticket_status']) ?>
                                            </span>
                                        </div>
                                    <?php elseif (
                                        strtolower($ticket['ticket_status']) == strtolower("closed")
                                    ): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="status-closed"></div>
                                            <span class="text-start"><?= ucwords($ticket['ticket_status']) ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <td class="align-middle text-center"><?php echo get_abbreviation($ticket['department_name']) ?></td>
                            <td class="align-middle">
                                <?php if ($count_assign != 0): ?>
                                    <?php if ($count_assign == 1): ?>
                                        <div class="text-center fw-bold">
                                            <?php foreach ($peopleInCharge as $pic): ?>
                                                <?php echo $pic ?>
                                            <?php endforeach ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-center fw-bold has-tooltip" title="
                                    <?php foreach ($peopleInCharge as $pic): ?>
                                            <?php echo "$pic, " ?>
                                        <?php endforeach ?>
                                    ">
                                            <?= get_abbreviation($ticket['department_name']) . " ($count_assign)" ?>
                                        </div>
                                    <?php endif; ?>

                                <?php elseif (strtolower($ticket['ticket_status']) == strtolower("For Approval")): ?>
                                    <div class="text-center">
                                        <h5>-</h5>
                                    </div>
                                <?php elseif ($count_assign === 0): ?>
                                    <?php if (strtolower($ticket['ticket_status']) == strtolower("Closed")): ?>
                                        <div class="text-center">
                                            <!-- <a href="" class="btn btn-assign fw-bold rounded-5 p-2 py-1"><i
                                                class="fa-solid fa-plus"></i>
                                            Assign</a> -->
                                            <h5>-</h5>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-center">
                                            <span><i>To be assigned</i></span>
                                        </div>

                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <?= $ticket['requester_first_name'] . " " . $ticket['requester_last_name'] ?>
                            </td>
                            <td class="align-middle text-center"><?= get_abbreviation($ticket['requester_department_name']) ?>
                            </td>
                            <td class="align-middle"><?= date('m-d-Y', strtotime($ticket['ticket_updated'])) ?></td>
                            <td class="align-middle">

                                <div class="d-inline-flex align-items-stretch rounded-2 action-group">
                                    <!-- View -->
                                    <a href="<?= base_url('tickets/view_ticket') . '/' . $ticket['ticket_id'] ?>"
                                        class="action-item btn btn-sm d-flex align-items-center px-2" style="
                                                    border: none;
                                                    color: var(--text);
                                                    font-size: 0.7rem;
                                            ">
                                        <i class="fa-solid fa-eye me-1" style="color: var(--text-muted);"></i>
                                        View
                                    </a>

                                    <!-- Divider -->
                                    <div style="width: 1px; background: var(--border);"></div>

                                    <!-- Dropdown -->
                                    <div class="dropdown dropdown-status d-flex">
                                        <button
                                            class="action-item dropdown-item btn btn-sm d-flex align-items-center justify-content-center px-2"
                                            type="button" data-toggle="dropdown" style="
                                                border: none;
                                                color: var(--text-muted);
                                                font-size: 0.7rem;
                                            ">
                                            <i class="fa-solid fa-caret-down"></i>
                                        </button>

                                        <div class="dropdown-menu" style="
                                                border: 1px solid var(--border);
                                                background: var(--card);
                                                width: max-content;
                                                 min-width: unset;
                                            ">
                                            <?php if (strtolower($ticket['ticket_status']) == strtolower('for approval')): ?>

                                                <a class="dropdown-item" id="approveBtn" data-bs-toggle="modal"
                                                    data-bs-target="#approveTicket" data-ticket_id="<?= $ticket['ticket_id'] ?>"><i
                                                        class="fa-solid fa-thumbs-up me-2"></i>
                                                    Approve</a>
                                                <a class="dropdown-item" id="rejectBtn" data-bs-toggle="modal"
                                                    data-bs-target="#rejectTicket" data-ticket_id="<?= $ticket['ticket_id'] ?>"><i
                                                        class="fa-solid fa-thumbs-down me-2"></i>
                                                    Reject</a>
                                            <?php endif; ?>
                                            <?php if ($this->session->userdata('role_id') == "3" && strtolower($ticket['ticket_status']) !== strtolower('for approval') && strtolower($ticket['ticket_status']) !== strtolower('open')): ?>
                                                <a class="dropdown-item" id="ticketStatusBtn" data-bs-toggle="modal"
                                                    data-bs-target="#ticketStatusModal"
                                                    data-ticket_id="<?= $ticket['ticket_id'] ?>">
                                                    <i class="fa-solid fa-spinner me-2"></i>
                                                    Status</a>
                                            <?php endif; ?>
                                            <a class="dropdown-item" href="#"><i class="fa-solid fa-clipboard-list me-2"></i>
                                                Audit
                                                Trail</a>
                                        </div>
                                    </div>

                                </div>

                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Approve -->
<div class="modal fade modalEdit" id="approveTicket" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Approve Ticket</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="<?= base_url('tickets/update_ticket_status/open') ?>">

                <input type="hidden" name="ticket_id" id="approve_ticket_id">
                <input type="hidden" name="current_uri" id="current_uri" value="<?= uri_string() ?>">

                <div class="modal-body p-4">

                    <!-- Ticket ID -->
                    <div class="mb-3">
                        <div class="text-muted small">Ticket ID</div>
                        <div class="fw-semibold" id="ticket_id_approve"></div>
                    </div>

                    <!-- Priority Box -->
                    <div class="border rounded-3 p-3">

                        <label for="priority" class="form-label text-muted small mb-2">
                            Set Priority
                        </label>

                        <select class="form-select form-select-sm shadow-none" name="priority" id="prioritySelect"
                            required>
                            <option value="" selected disabled>Select priority</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="critical">Critical</option>
                        </select>

                    </div>

                </div>

                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="submit" id="approveSubmitBtn" class="btn submit-btn w-100">
                        Approve
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- REJECT -->
<div class="modal fade modalEdit" id="rejectTicket" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Ticket</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action=" <?= base_url('tickets/update_ticket_status/closed') ?>">
                <input type="hidden" name="ticket_id" id="reject_ticket_id">
                <input type="hidden" name="current_uri" id="current_uri" value="<?= uri_string() ?>">
                <div class="modal-body">
                    <div class="col-12">
                        <span>Are you sure you want to reject ticket <b id='ticket_id_reject'></b>?</span>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn submit-btn">Reject</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Ticket Status Update -->
<div class="modal fade modalEdit" id="ticketStatusModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Update Ticket Status</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="">

                <input type="hidden" name="ticket_id" id="approve_ticket_id">
                <input type="hidden" name="current_uri" id="current_uri" value="<?= uri_string() ?>">

                <div class="modal-body p-4">

                    <!-- Ticket ID -->
                    <div class="mb-3">
                        <div class="text-muted small">Ticket ID</div>
                        <div class="fw-semibold" id="ticket_id_status"></div>
                    </div>

                    <!-- Priority Box -->
                    <div class="border rounded-3 p-3">

                        <label for="priority" class="form-label text-muted small mb-2">
                            Select Ticket Status
                        </label>

                        <select class="form-select form-select-sm shadow-none" name="ticket_status" id="statusSelect"
                            required>
                            <option value="" selected disabled>Select ticket status</option>
                            <option value="on going">On Going</option>
                            <option value="testing">For Testing</option>
                            <option value="closed">Close</option>
                            <option value="for approval">Re-open</option>
                        </select>

                    </div>

                </div>

                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="submit" id="statusSubmitBtn" class="btn submit-btn w-100">
                        Update Status
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
<script>
    $(document).on("click", "#approveBtn", function () {
        let ticket_id = $(this).data("ticket_id");

        $("#approve_ticket_id").val(ticket_id);
        $('#ticket_id_approve').html(ticket_id);
    });

    $(document).on("click", "#rejectBtn", function () {
        let ticket_id = $(this).data("ticket_id");

        $("#reject_ticket_id").val(ticket_id);
        $('#ticket_id_reject').html(ticket_id);
    });
</script>

<script>
    const approveBtn = document.getElementById('approveSubmitBtn');
    const statusBtn = document.getElementById('statusSubmitBtn');
    const selectPriority = document.getElementById('prioritySelect');
    const selectStatus = document.getElementById('statusSelect');

    const approveModal = document.getElementById('approveTicket');
    const statusModal = document.getElementById('ticketStatusModal');


    function toggleApproveButton(button, select) {
        button.disabled = !select.value;
    }

    selectPriority.addEventListener('change', () => {
        toggleApproveButton(approveBtn, selectPriority);
    });

    selectStatus.addEventListener('change', () => {
        toggleApproveButton(statusBtn, selectStatus);
    });

    resetModal(approveModal, approveBtn, selectPriority);
    resetModal(statusModal, statusBtn, selectStatus)


    function resetModal(modal, button, select) {
        modal.addEventListener('shown.bs.modal', function () {
            this.querySelector('form').reset();

            // run once on load or modal open
            toggleApproveButton(button, select);
        });
    }
</script>