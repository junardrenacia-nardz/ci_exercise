<div class="container">
    <div class="table-wrapper">

        <table class="table table-striped tbl-custom" id="ticketTable">
            <thead>
                <tr>
                    <th>Aging Days</th>
                    <th>ID</th>
                    <th>Priority</th>
                    <th>Subject</th>
                    <th>PIC</th>
                    <th>Created By</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ticket_details)): ?>
                    <?php foreach ($ticket_details as $ticket): ?>
                        <?php if (strtolower($ticket['ticket_status']) == strtolower("For Approval")): ?>
                            <?php $count_assign = 0;
                            $inCharge = ""; ?>
                            <?php foreach ($ticket_assigned as $assigned): ?>
                                <?php if ($ticket['ticket_id'] == $assigned['ticket_id']): ?>
                                    <?php $inCharge = $assigned['department_name'];
                                    $count_assign++ ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <tr class="">
                                <td class="align-middle"><?php $created = new DateTime($ticket['ticket_created']);
                                                            $today = new DateTime();

                                                            $aging = $today->diff($created)->days;

                                                            echo $aging; ?>
                                </td>
                                <td class="align-middle"><?= $ticket['ticket_id'] ?></td>
                                <td class="align-middle"><?= $ticket['priority'] ?></td>
                                <td class="align-middle"><?= $ticket['ticket_name'] ?></td>
                                <td class="align-middle">
                                    <?php if ($count_assign != 0) : ?>
                                        <div class="text-center fw-bold">
                                            <?= get_abbreviation($ticket['department_name']) . " ($count_assign)" ?>
                                        </div>
                                    <?php elseif ($ticket['ticket_status'] == "For Approval"): ?>
                                        <div class="text-center"><b>-</b></div>
                                    <?php
                                    elseif ($count_assign === 0): ?>
                                        <div class="text-center">
                                            <a href="" class="btn btn-outline-primary fw-bold rounded-5 p-2 py-1"><i
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
<script>
    $(document).ready(function() {
        $('#ticketTable').DataTable({
            order: [
                [0, 'asc']
            ],
            initComplete: function() {
                $('.dt-search input').attr('placeholder', 'Keyword');
            },
            stateSave: true,
            dom: 'f t<"bottom"l p i>',
            pageLength: 10,
            pagingType: "simple_numbers",
            layout: {
                topStart: null,
                topEnd: 'search',
                top: {
                    start: null,
                    end: null
                }
            }
        });

        // Move search bar into custom container
        $('.dt-search').append($('.dataTables_filter'));
    });
    $.fn.dataTable.version
</script>