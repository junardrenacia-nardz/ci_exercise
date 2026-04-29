<div class="container-fluid py-4">

    <!-- ===================== -->
    <!-- 📊 DASHBOARD SUMMARY -->
    <!-- ===================== -->
    <?php
    $totalTickets = count($ticket_details);
    $open = $pending = $closed = $critical = 0;

    $statusCounts = ['Open' => 0, 'Pending' => 0, 'Closed' => 0];
    $priorityCounts = ['Critical' => 0, 'High' => 0, 'Medium' => 0, 'Low' => 0, "" => 0];

    foreach ($ticket_details as $t) {
        $status = strtolower($t['ticket_status']);
        $priority = strtolower($t['priority']);

        if ($status == 'open' || $status == 'for approval') {
            $open++;
            $statusCounts['Open']++;
        } elseif ($status == 'pending' || $status == 'on going') {
            $pending++;
            $statusCounts['Pending']++;
        } elseif ($status == 'closed') {
            $closed++;
            $statusCounts['Closed']++;
        }

        if ($priority == 'critical') $critical++;
        $priorityCounts[ucwords($priority)]++;
    }
    ?>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <h6>Total Tickets</h6>
                <h3><?= $totalTickets ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-start border-danger border-4">
                <h6>Open</h6>
                <h3><?= $open ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-start border-warning border-4">
                <h6>Pending</h6>
                <h3><?= $pending ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-start border-success border-4">
                <h6>Closed</h6>
                <h3><?= $closed ?></h3>
            </div>
        </div>
    </div>

    <!-- ===================== -->
    <!-- 📈 CHARTS -->
    <!-- ===================== -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h6 class="mb-3">Ticket Status</h6>
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h6 class="mb-3">Priority Distribution</h6>
                <canvas id="priorityChart"></canvas>
            </div>
        </div>
    </div>

    <!-- ===================== -->
    <!-- 📋 TICKET TABLE -->
    <!-- ===================== -->
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover" id="ticketTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Aging</th>
                            <th>ID</th>
                            <th class="text-center">Priority</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th class="text-center">Dept</th>
                            <th class="text-center">PIC</th>
                            <th>Created By</th>
                            <th>Updated</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($ticket_details as $ticket): ?>
                            <?php
                            $created = new DateTime($ticket['ticket_created']);
                            $today = new DateTime();
                            $aging = $today->diff($created)->days;
                            ?>

                            <tr>
                                <td class="text-center"><?= $aging ?></td>
                                <td><?= $ticket['ticket_id'] ?></td>

                                <!-- Priority -->
                                <td class="text-center">
                                    <span class="badge bg-<?=
                                                            strtolower($ticket['priority']) == 'critical' ? 'danger' : (strtolower($ticket['priority']) == 'high' ? 'warning' : (strtolower($ticket['priority']) == 'medium' ? 'primary' : 'secondary'))
                                                            ?>">
                                        <?= ucfirst($ticket['priority']) ?>
                                    </span>
                                </td>

                                <td><?= $ticket['ticket_name'] ?></td>

                                <!-- Status -->
                                <td>
                                    <span class="badge bg-<?=
                                                            in_array(strtolower($ticket['ticket_status']), ['open', 'for approval']) ? 'danger' : (in_array(strtolower($ticket['ticket_status']), ['pending', 'on going']) ? 'warning' : (strtolower($ticket['ticket_status']) == 'closed' ? 'success' : 'info'))
                                                            ?>">
                                        <?= ucfirst($ticket['ticket_status']) ?>
                                    </span>
                                </td>

                                <td class="text-center"><?= $ticket['department_name'] ?></td>

                                <td class="text-center">-</td>

                                <td><?= $ticket['requester_first_name'] . ' ' . $ticket['requester_last_name'] ?></td>

                                <td><?= date('m-d-Y', strtotime($ticket['ticket_updated'])) ?></td>

                                <td>
                                    <a href="<?= base_url('tickets/view_ticket/' . $ticket['ticket_id']) ?>"
                                        class="btn btn-sm btn-outline-primary">
                                        View
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>


<!-- ===================== -->
<!-- 📊 CHART SCRIPT -->
<!-- ===================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const statusChart = new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_keys($statusCounts)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($statusCounts)) ?>,
                backgroundColor: ['#dc3545', '#ffc107', '#28a745']
            }]
        }
    });

    const priorityChart = new Chart(document.getElementById('priorityChart'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($priorityCounts)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($priorityCounts)) ?>,
                backgroundColor: ['#dc3545', '#fd7e14', '#0d6efd', '#6c757d']
            }]
        }
    });
</script>


<!-- ===================== -->
<!-- 🎨 STYLE -->
<!-- ===================== -->
<style>
    .card {
        border-radius: 12px;
    }

    .card:hover {
        transform: translateY(-2px);
        transition: 0.2s;
    }

    canvas {
        max-height: 300px;
    }
</style>