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
    <div class="ticket-details information-tickets d-flex justify-content-between p-3">
        <div class="d-flex flex-column">
            <div class="ticket-subject mb-1">
                <span class="subject me-2 align-middle"><?= $ticket['ticket_name'] ?> <span
                        class="badge p-1 badge-ticket fw-bold ms-2">Main Ticket</span></span>

            </div>

            <div id="ticket_id">
                <span class="badge p-1 badge-ticket fw-bold">
                    Ticket ID: <?= $ticket['ticket_id'] ?></span>
            </div>
        </div>

        <div class="ticket-button d-flex justify-content-end">
            <div>
                <button class="btn assign-reassign-btn timeline-btn me-2" data-bs-toggle="modal"
                    data-bs-target="#modal_department">
                    <i class="fa-solid fa-timeline me-1"></i> Timeline</button>
            </div>
            <div>
                <?php if (strtolower($ticket['ticket_status']) !== strtolower("For Approval")): ?>
                    <?php if ($count_assign == 0): ?>

                        <a href="" class="btn assign-reassign-btn me-2" data-bs-toggle="modal"
                            data-bs-target="#modal_assign_person">

                            <i class="fa-solid fa-plus me-1"></i> Assign PIC</a>
                    <?php else: ?>
                        <a href="" class="btn assign-reassign-btn me-2" data-bs-toggle="modal"
                            data-bs-target="#modal_assign_person">
                            <i class="fa-solid fa-user-group me-1"></i> Re-assign PIC</a>
                    <?php endif; ?>

                <?php endif; ?>
            </div>
            <div>
                <button class="btn assign-reassign-btn" data-bs-toggle="modal" data-bs-target="#modal_department">
                    <i class="fa-solid fa-building-user me-1"></i> Re-assign Dept.</button>
            </div>
        </div>

    </div>

    <div class="ticket-details d-flex justify-content-between pt-0 p-3">
        <div class="information-tickets col-md-8 pe-3">

            <div class="detail-title">
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
                <div class="mt-3">
                    <button class="btn btn-outline-secondary btn-sm attachment-btn" data-bs-toggle="modal"
                        data-bs-target="#ticket_attachments">

                        <i class="fa-solid fa-paperclip me-1"></i>
                        <span>Attachments</span>
                    </button>
                </div>

            </div>
        </div>

        <div class="comments col-md-4">
            <div class="comments-col w-100">
                <div class="d-flex align-items-center justify-content-between comment-btn">
                    <div class="fs-6 fw-bold ">Comments <span>(<?= count($comments) ?>)</span></div>
                    <a href="" class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#add_comment">
                        <i class="fa-solid fa-plus me-2"></i><span>New</span></a>
                </div>

                <div class="comment-contents px-3 py-2 mt-2">
                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>
                            <div class="d-flex align-items-start my-3">
                                <div class="avatar-col d-flex justify-content-between align-items-center">
                                    <div class="avatar me-2"
                                        style="background: <?= ($comment['gender'] == "male") ? "var(--gender-male)" : "var(--gender-female)" ?> ;">
                                        <?= name_abbr($comment['first_name'], $comment['last_name']); ?>
                                    </div>

                                </div>

                                <div class="comment d-flex flex-column w-100">
                                    <div class="comment-date d-flex flex-column mb-1">
                                        <span>
                                            <b class="me-1"
                                                style="font-size: 15px;"><?= $comment['first_name'] . " " . $comment['last_name'] ?></b>
                                            <i class="fw-regular"
                                                style="font-size: 15px;">(<?= get_abbreviation($comment['department_name']) ?>)</i></span>
                                        <span
                                            style="font-size: 0.7rem; color: var(--text-muted); font-weight: 600;"><?= date('m-d-Y', strtotime($comment['comment_created_at'])) . "  " . date('h:i:s a', strtotime($comment['comment_created_at'])) ?></span>
                                    </div>

                                    <span><?= $comment['comment'] ?></span>

                                    <?php
                                    $hasAttachment = 0;
                                    foreach ($comment_attachments as $ca) {
                                        if ($comment['comment_id'] === $ca['comment_id']) {
                                            $hasAttachment++;
                                        }
                                    } ?>

                                    <?php if ($hasAttachment > 0): ?>
                                        <div class="mt-2 ">
                                            <a class="py-1 view-attachment" data-comment-id="<?= $comment['comment_id']; ?>"
                                                data-bs-toggle="modal" data-bs-target="#comment_attachments">View Attachments</a>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="comment my-1 d-flex flex-column">
                            <span class="me-1 text-center" style="font-size: 15px;">No comments yet.</span>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>

    </div>
    <?php if (strtolower($ticket['ticket_status']) == strtolower('for approval')): ?>

        <div class="mt-1 p-3 border rounded-3 d-flex justify-content-between align-items-center bg-light">
            <div>
                <b class="d-block">Pending Approval</b>
                <small class="text-muted">Choose an action for this ticket</small>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#rejectTicket">
                    Reject
                </button>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveTicket">
                    Approve
                </button>

            </div>

        </div>

    <?php endif; ?>

</div>

<!--ASSIGN Person to the Ticket-->
<div class="modal fade" id="modal_assign_person" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-3">

            <!-- HEADER -->
            <div class="modal-header">
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
                        <i class="fa-solid fa-building me-2"></i>
                        <?= $ticket['department_name'] ?>
                    </div>
                </div>

                <!-- Person In Charge -->
                <div class="p-3 border rounded-3">
                    <label class="text-muted small mb-2 d-block">Person in Charge</label>

                    <?php if ($count_assign !== 0): ?>
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

                <a href="" data-bs-toggle="modal" data-bs-target="#edit_assign_person" class="btn submit-btn">
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
            <div class="modal-header">
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
                                                                <?php if ($choice['department_id'] == $ticket['department_id'] && $choice['access_id'] !== 1): ?>
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
                                                                <?php if ($choice['department_id'] == $ticket['department_id'] && $choice['access_id'] !== '1'): ?>
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
                                                                    <?php if ($choice['department_id'] == $ticket['department_id'] && $choice['access_id'] !== 1): ?>
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
                                                <td class="text-center"><button type="button" class="btn removeRow"
                                                        style="background: #ef4444; color: white;">X</button></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <button type="button" id="addRow" class="btn " style="background-color: #3b82f6;">Add
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
                    <button type="submit" class="btn submit-btn">
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
            <div class="modal-header">
                <h5 class="modal-title fw-semibold">Department</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-3 py-3">
                <div class="col-12">
                    <!-- <label for="">Department:</label> -->
                    <div class="d-flex mt-2">
                        <input type="text" value="<?= $ticket['department_name'] ?>" class="form-control" readonly>
                        <a href="" data-bs-toggle="modal" data-bs-target="#edit_department"
                            class="btn p-2 px-3 ms-2 has-tooltip modal-btn d-flex align-items-center"
                            title="Change Department"><i class="fa-solid fa-dice" style="font-size: 20px;"></i></a>
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
<div class="modal fade modalEdit" id="edit_department" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Re-assign Department</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?php echo base_url("tickets/reassign_department/") . $ticket['ticket_id'] ?>">
                <input type="hidden" name="oldDepartment" value="<?= $ticket['department_id'] ?>">
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
                    <button type="submit" class="btn submit-btn">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!--COMMENTS Modal-->
<div class="modal fade" id="add_comment" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Comment</h5>
                <button type="button" class="btn-close btn-close-white btn-close-reload"
                    data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo base_url("comments/") . $ticket['ticket_id'] ?>" method="post"
                enctype="multipart/form-data">
                <div class="form-content comment-sheet">
                    <!-- Identity (display only) -->
                    <div class="comment-identity">
                        <div class="avatar"
                            style="background: <?= ($logged_user['gender'] == "male") ? "var(--gender-male)" : "var(--gender-female)" ?> ;">
                            <?= name_abbr($logged_user['first_name'], $logged_user['last_name']); ?>
                        </div>

                        <div class="identity-info">
                            <div class="name"><?= $logged_user['first_name'] . ' ' . $logged_user['last_name'] ?></div>
                            <div class="department"><?= $ticket['department_name'] ?></div>
                        </div>
                    </div>

                    <!-- Comment Area -->
                    <div class="comment-body">
                        <label>Comment</label>
                        <textarea name="comment" rows="4" placeholder="Write your comment here..."
                            required><?= set_value("comment") ?></textarea>
                    </div>

                    <!-- Attachment Footer -->
                    <div class="comment-attachment">
                        <label class="attachment-box">
                            <input type="file" name="fileUploads[]" id="files" multiple
                                accept=".jpg,.jpeg,.png,.pdf,.docx,.ppt,.zip,.pptx">
                            <span>📎 Attach file <i class="text-black">(optional)</i></span>
                        </label>
                        <small>PDF, JPG, PNG, PDF, ... — max 5MB</small>
                    </div>
                    <div class="fileList-col mt-2">
                        <ul id="fileList" class="list-group mt-2"></ul>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-close-reload" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn">Add Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--COMMENT Attachments Modal-->
<div class="modal fade" id="comment_attachments" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-attachment modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-3 modal-attachment">
            <div class="modal-body px-3 py-3">
                <div class="d-flex justify-content-between attachment-close w-100 ps-5">
                    <h5 class="attachment-header-title">
                        <?= $comment_attachments[0]['first_name'] . " " . $comment_attachments[0]['last_name'] ?>
                    </h5>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal"></button>
                </div>
                <div class="attachment-content d-flex flex-column my-4 mt-5 mx-3 overflow-y-auto overflow-x-hidden">
                    <?php
                    $commentImages = [];
                    $commentFiles = [];

                    foreach ($comment_attachments as $file) {
                        $ext = strtolower(pathinfo($file['attachment'], PATHINFO_EXTENSION));

                        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                            $commentImages[] = $file;
                        } else {
                            $commentFiles[] = $file;
                        }
                    }
                    ?>

                    <!-- IMAGES -->
                    <div class=" mb-3 mx-3">
                        <h6 class="section-title">Images</h6>

                        <?php if (!empty($commentImages)): ?>
                            <div class="image-attachments">
                                <?php foreach ($commentImages as $img): ?>
                                    <a href="<?= base_url('assets/images/comment_attachments/' . $img['attachment']) ?>"
                                        target="_blank" title="<?= $img['orig_name'] ?>" class="has-tooltip">
                                        <img src="<?= base_url('assets/images/comment_attachments/' . $img['attachment']) ?>">
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No Images Attached</p>
                        <?php endif; ?>
                    </div>

                    <!-- FILES -->
                    <div class="mx-3 mb-3">
                        <h6 class="section-title">Files</h6>

                        <?php if (!empty($commentFiles)): ?>
                            <div class="file-attachments">
                                <?php foreach ($commentFiles as $f): ?>
                                    <div class="file-item">
                                        <span class="file-name"><?= $f['orig_name'] ?></span>
                                        <a href="<?= base_url('assets/images/comment_attachments/' . $f['attachment']) ?>"
                                            target="_blank">
                                            <i class="fa-solid fa-download" style='color: #666666;'></i>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No Files Attached</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ticket_attachments" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body attachment-content">
                <div class="d-flex justify-content-between attachment-close w-100 ps-5">
                    <h5>Ticket Attachments</h5>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal"></button>
                </div>


                <?php
                $images = [];
                $files = [];

                foreach ($ticket_attachments as $file) {
                    $ext = strtolower(pathinfo($file['attachment'], PATHINFO_EXTENSION));

                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                        $images[] = $file;
                    } else {
                        $files[] = $file;
                    }
                }
                ?>

                <!-- IMAGES -->
                <div class="mt-5 mb-3 mx-3">
                    <h6 class="section-title">Images</h6>

                    <?php if (!empty($images)): ?>
                        <div class="image-attachments">
                            <?php foreach ($images as $img): ?>
                                <a href="<?= base_url('assets/images/ticket_attachments/' . $img['attachment']) ?>"
                                    target="_blank" title="<?= $img['orig_name'] ?>" class="has-tooltip">
                                    <img src="<?= base_url('assets/images/ticket_attachments/' . $img['attachment']) ?>">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No Images Attached</p>
                    <?php endif; ?>
                </div>

                <!-- FILES -->
                <div class="mx-3 mb-3">
                    <h6 class="section-title">Files</h6>

                    <?php if (!empty($files)): ?>
                        <div class="file-attachments">
                            <?php foreach ($files as $f): ?>
                                <div class="file-item">
                                    <span class="file-name"><?= $f['orig_name'] ?></span>
                                    <a href="<?= base_url('assets/images/ticket_attachments/' . $f['attachment']) ?>"
                                        target="_blank">
                                        <i class="fa-solid fa-download" style='color: #666666;'></i>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No Files Attached</p>
                    <?php endif; ?>
                </div>

            </div>

        </div>
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

                <input type="hidden" name="ticket_id" id="approve_ticket_id" value="<?= $ticket['ticket_id'] ?>">
                <input type="hidden" name="current_uri" id="current_uri" value="<?= uri_string() ?>">

                <div class="modal-body p-4">

                    <!-- Ticket ID -->
                    <div class="mb-3">
                        <div class="text-muted small">Ticket ID</div>
                        <div class="fw-semibold" id="ticket_id_approve"><?= $ticket['ticket_id'] ?></div>
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
                <input type="hidden" name="ticket_id" id="reject_ticket_id" value="<?= $ticket['ticket_id'] ?>">
                <input type="hidden" name="current_uri" id="current_uri" value="<?= uri_string() ?>">
                <div class="modal-body">
                    <div class="col-12">
                        <span>Are you sure you want to reject ticket <b
                                id='ticket_id_reject'><?= $ticket['ticket_id'] ?></b>?</span>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn submit-btn">Reject</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(function () {
        $(".has-tooltip").tooltip();
    });
    document.querySelectorAll('.modalEdit').forEach(function (modal) {
        modal.addEventListener('hidden.bs.modal', function () {
            this.querySelector('form').reset();
            updateSelectOptions();
        });
    });

    const originalRowCount = <?= ($count_assign == 0) ? 1 : $count_assign ?>;

    let originalAssignTableHTML;

    document.addEventListener("DOMContentLoaded", function () {
        originalAssignTableHTML = document.querySelector("#assignTableDynamic tbody").innerHTML;
    });

    document.addEventListener("DOMContentLoaded", function () {
        updateSelectOptions();
    });

    document.addEventListener("change", function (e) {
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
                                    <?php if ($choice['department_id'] == $ticket['department_id'] && $choice['access_id'] !== 1): ?>
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


<script>
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('view-attachment')) {

            let commentId = e.target.dataset.commentId;

            // Clear old content
            document.querySelector('.attachment-content').innerHTML = '';

            // AJAX request to get attachments
            fetch("<?= base_url('comments/get_attachments/') . $ticket['ticket_id'] . "/" ?>" + commentId)
                .then(response => response.json())
                .then(data => {

                    let title = document.querySelector('.attachment-header-title');
                    title.textContent = data[0]?.first_name + " " + data[0]?.last_name;


                    let container = document.querySelector('.attachment-content');
                    container.innerHTML = `
                        <div class="attachment-section">
                            <h6 class="section-title">Images</h6>
                            <div class="image-attachments"></div>
                        </div>

                        <div class="attachment-section mt-4">
                            <h6 class="section-title">Files</h6>
                            <div class="file-attachments"></div>
                        </div>
                    `;

                    let imageContainer = container.querySelector('.image-attachments');
                    let fileContainer = container.querySelector('.file-attachments');

                    let images = '';
                    let files = '';

                    data.forEach(file => {

                        let ext = file.attachment.split('.').pop().toLowerCase();
                        let filePath = "<?= base_url('assets/images/comment_attachments/') ?>" + file
                            .attachment;

                        // IMAGES
                        if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                            images += `
                                <a href="${filePath}" target="_blank" title="${file.orig_name}" class="has-tooltip">
                                    <img src="${filePath}">
                                </a>
                                `;
                        }

                        // FILES
                        else {
                            files += `
                                <div class="file-item">
                                    <span class="file-name">${file.orig_name}</span>
                                    <a href="${filePath}" target="_blank" class="file-download">
                                     <i class="fa-solid fa-download" style = 'color: #666666;'></i>
                                    </a>
                                </div>
                                `;
                        }
                    });

                    imageContainer.innerHTML = images ?
                        images :
                        `<p class="text-muted">No Images Attached</p>`;

                    fileContainer.innerHTML = files ?
                        files :
                        `<p class="text-muted">No Files Attached</p>`;

                });
        }
    });
</script>

<script>
    approveBtn = document.getElementById('approveSubmitBtn');
    selectPriority = document.getElementById('prioritySelect');

    function toggleApproveButton() {
        approveBtn.disabled = !selectPriority.value;
    }

    selectPriority.addEventListener('change', toggleApproveButton);


    const approveModal = document.getElementById('approveTicket');

    approveModal.addEventListener('shown.bs.modal', function () {
        this.querySelector('form').reset();

        // run once on load or modal open
        toggleApproveButton();
    });
</script>