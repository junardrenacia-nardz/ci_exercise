<div class="p-2">
    <div class="table-wrapper">

        <table class="table tbl-custom" id="ticketTable">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th class="text-center">User Status</th>
                    <th class="text-center">Dept</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Joined Date</th>
                    <th>Last Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr class="align-middle">
                        <td><?= $user['user_id'] ?></td>
                        <td><?= $user['first_name'] . " " . $user['last_name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td class="text-center"><?= $user['status'] ?></td>
                        <td class="text-center"><?= ucwords(get_abbreviation($user['department_name'])) ?></td>
                        <td class="text-center"><?= ucwords($user['access_name']) ?></td>
                        <td class="text-center"><?= date('m-d-Y', strtotime($user['created_at'])) ?></td>
                        <td>
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
                        <td style="white-space: nowrap;">

                            <a href="" class="btn py-1 px-2" style="
                                    background-color: var(--primary);
                                    color: var(--bg);
                                    border-radius: 4px 0 0 4px;
                                    display: inline-block;
                                    vertical-align: middle;
                                    ">
                                View
                            </a>

                            <div class="dropdown" style="display: inline-block; vertical-align: middle;">

                                <button class="dropdown-toggle py-1 px-2" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" style="
                                        background: transparent;
                                        border: none;
                                        border-radius: 0 4px 4px 0;
                                        line-height: 1.5;
                                    ">
                                </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
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