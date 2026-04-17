<?php
$count_assign = 0;
$inCharge = [];
foreach ($ticket_assigned as $assigned):
    if ($ticket['ticket_id'] == $assigned['ticket_id']):
        $inCharge[] = $assigned['first_name'] . " " . $assigned['last_name'];
        $count_assign++;
    endif;
endforeach; ?>
<div class="container w-100 rounded-3 p-4" style="background-color: #f2f2f2;">
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
                                <?php echo $person ?>,
                            <?php endforeach; ?>
                        <?php else: ?>
                            <i>Not assigned to anyone yet</i>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="department-author mt-2 d-flex">
                    <span class="badge bg-light rounded-5 text-black">
                        <i class="fa-solid fa-building me-1"></i><?= $ticket['department_name'] ?>
                    </span>
                    <span class="badge bg-light rounded-5 text-black">
                        <i class="fa-regular fa-user me-1"></i>
                        <?= $ticket['requester_first_name'] . " " . $ticket['requester_last_name'] ?>
                    </span>
                </div>
                <div class="dates mt-2 row">
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
                <a href="" class="btn btn-primary me-2">
                    <i class="fa-solid fa-plus"></i> Assign</a>
                <a href="" class="btn btn-primary">
                    <i class="fa-solid fa-user-group"></i> Reassign Dept.</a>
            </div>

            <div class="comments-col w-100 mt-5">
                <div class="d-flex justify-content-between">
                    <h6>Comments</h6>
                    <a href="" class="btn btn-success">
                        <i class="fa-solid fa-plus"></i> New</a>
                </div>
            </div>
        </div>

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