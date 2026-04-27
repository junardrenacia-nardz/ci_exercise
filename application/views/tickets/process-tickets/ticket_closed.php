<div class="container">
    <div class="table-wrapper">

        <table class="table tbl-custom" id="ticketTable">
            <thead>
                <tr>
                    <th class="text-center">Aging Days</th>
                    <th>ID</th>
                    <th class="text-center">Priority</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th class="text-center">PIC</th>
                    <th>Created By</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ticket_details)): ?>
                    <?php foreach ($ticket_details as $ticket): ?>
                        <?php if (strtolower($ticket['ticket_status']) == strtolower("Closed")): ?>
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
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle"><?= $ticket['ticket_name'] ?></td>
                                <td class="align-middle">
                                    <?php if (
                                        strtolower($ticket['ticket_status']) == strtolower("for approval") ||
                                        strtolower($ticket['ticket_status']) == strtolower("open")
                                    ): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="status-red"></div>
                                            <span class="text-center"><?= ucwords($ticket['ticket_status']) ?>
                                            </span>
                                        </div>
                                    <?php elseif (
                                        strtolower($ticket['ticket_status']) == strtolower("pending") ||
                                        strtolower($ticket['ticket_status']) == strtolower("on going")
                                    ): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="status-orange"></div>
                                            <span class="text-center"><?= ucwords($ticket['ticket_status']) ?>
                                            </span>
                                        </div>
                                    <?php elseif (strtolower($ticket['ticket_status']) == strtolower("for testing")): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="status-blue"></div>
                                            <span class="text-center"><?= ucwords($ticket['ticket_status']) ?>
                                            </span>
                                        </div>
                                    <?php elseif (strtolower($ticket['priority']) == strtolower("closed")): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="status-green"></div>
                                            <span class="text-center"><?= ucwords($ticket['ticket_status']) ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle">
                                    <?php if ($count_assign != 0) : ?>
                                        <?php if ($count_assign == 1): ?>
                                            <div class="text-center fw-bold">
                                                <?php foreach ($peopleInCharge as $pic): ?>
                                                    <?php echo $pic ?>
                                                <?php endforeach ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="text-center fw-bold has-tooltip" title="
                                    <?php foreach ($peopleInCharge as $pic): ?>
                                            <?php echo "$pic, "  ?>
                                        <?php endforeach ?>
                                    ">
                                                <?= get_abbreviation($ticket['department_name']) . " ($count_assign)" ?>
                                            </div>
                                        <?php endif; ?>

                                    <?php elseif (strtolower($ticket['ticket_status']) == strtolower("For Approval")): ?>
                                        <div class="text-center"><b>-</b></div>
                                    <?php
                                    elseif ($count_assign === 0): ?>
                                        <div class="text-center">
                                            <a href="" class="btn btn-assign fw-bold rounded-5 p-2 py-1"><i
                                                    class="fa-solid fa-plus"></i>
                                                Assign</a>
                                        </div>
                                    <?php endif; ?>
                                </td class="align-middle">
                                <td class="align-middle">
                                    <?= $ticket['requester_first_name'] . " " . $ticket['requester_last_name']  ?>
                                </td>
                                <td class="align-middle"><?= date('m-d-Y', strtotime($ticket['ticket_updated'])) ?></td>
                                <td class="align-middle">
                                    <a href="<?= base_url('tickets/view_ticket') . '/' . $ticket['ticket_id'] ?>" class="btn"><i
                                            class="fa-solid fa-eye"></i></a>

                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>

                <?php endif; ?>
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