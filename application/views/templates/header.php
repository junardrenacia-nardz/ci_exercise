<?php $current = uri_string();
$isViewTicket = strpos($current, 'tickets/view_ticket/') === 0; ?>

<?php
function name_abbr($first, $last) {
    $first_name = strtoupper(substr($first, 0, 1));
    $last_name = strtoupper(substr($last, 0, 1));

    $initial = $first_name . $last_name;

    return $initial;
}
?>

<script>
    const BASE_URL = "<?= base_url() ?>";
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- =======================
         CSS (LOCAL STYLES)
    ======================== -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/root.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ticket-list.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/process-nav.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/dataTable-style.css">

    <!-- =======================
         ICONS
    ======================== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        referrerpolicy="no-referrer" />

    <!-- =======================
         JQUERY + UI
    ======================== -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.2/themes/base/jquery-ui.css">

    <!-- =======================
         DATATABLES CORE
    ======================== -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>

    <!-- =======================
         DATATABLES BUTTONS (EXPORT)
    ======================== -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <!-- =======================
         EXPORT DEPENDENCIES
    ======================== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <title><?= $title ?></title>
</head>

<body class="no-transition">
    <div class="container-fluid d-flex g-0 side-main-container">
        <!-- sidebar -->
        <aside id="sidebar" class="">
            <div id="sidebar-logo" class="sidebar-logo d-flex justify-content-center align-items-center pt-5 px-4 ">
                <a href="#">
                    <img src="<?= base_url("assets/images/background/logo-black.png") ?>" width="120" alt="" srcset="">
                </a>

                <button class="sidebar-toggler" type="button"><i class="fa-solid fa-bars"></i></button>
            </div>
            <!-- sidebar Navigation -->
            <ul class="sidebar-nav pt-5 p-0">
                <li class="sidebar-header">Lists</li>
                <li class="sidebar-item">
                    <a href="<?= base_url("dashboard") ?>"
                        class="sidebar-link <?= ($current == "dashboard") ? "active" : "" ?>">
                        <i class="fa-solid fa-grip-vertical"></i><span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link has-dropdown <?= ($current == "tickets/all" || $current == "tickets/approval" || $current == "tickets/open"
                                                                        || $current == "tickets/pending" || $current == "tickets/ongoing"
                                                                        || $current == "tickets/testing" || $current == "tickets/closed"
                                                                        || $isViewTicket) ? "active" : "" ?>"
                        data-bs-toggle="collapse" data-bs-target="#ticket-items" aria-expanded="true"
                        aria-controls="ticket-items">
                        <i class="fa-solid fa-ticket"></i>
                        <span>Tickets</span>
                    </a>
                    <ul class="sidebar-dropdown list-unstyled collapse <?= ($current == "tickets/all" || $current == "tickets/approval" || $current == "tickets/open"
                                                                            || $current == "tickets/pending" || $current == "tickets/ongoing"
                                                                            || $current == "tickets/testing" || $current == "tickets/closed"
                                                                            || $isViewTicket) ? "show" : "" ?>"
                        id="ticket-items">
                        <li class="sidebar-item">
                            <a href="" class="sidebar-link"><i class="fa-regular fa-user"></i>
                                <span>My Tickets</span></a>
                            <a href="<?= base_url("tickets/all") ?>"
                                class="sidebar-link <?= ($current == "tickets/all" || $current == "tickets/approval" || $current == "tickets/open"
                                                        || $current == "tickets/pending" || $current == "tickets/ongoing" || $current == "tickets/testing" || $current == "tickets/closed") ? "active" : "" ?>"><i
                                    class="fa-solid fa-users"></i><span>All Tickets</span> </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-building"></i><span>Department</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-thumbtack"></i><span>Pinned</span>
                    </a>
                </li> -->

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#history-item" aria-expanded="true" aria-controls="history-item">
                        <i class="fa-solid fa-hourglass"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="sidebar-dropdown list-unstyled collapse" id="history-item">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link"><i class="fa-solid fa-check"></i><span>Completed</span></a>
                            <a href="#" class="sidebar-link"><i class="fa-solid fa-xmark"></i><span>On Going</span></a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="sidebar-footer">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-user"></i><span>Profile</span>
                    </a>
                </li>
                <a href="<?= base_url() ?>users/logout" class="sidebar-link"><i
                        class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>
            </div>
        </aside>

        <div id="main" class="container-fluid g-0 collapsed w-100">
            <nav id="nav-toggle" class="navbar px-3 d-flex align-items-center justify-content-between navbar-expand">
                <div class="d-flex align-items-center">
                    <button class="toggler-btn" type="button"><i class="fa-solid fa-bars"></i></button>
                    <h4 class="ms-2"><?= $title ?></h4>
                </div>

                <div class="d-flex align-items-center justify-content-end">
                    <a href="<?= base_url("create_ticket") ?>" id="createTicket"
                        class="btn btn-create-ticket rounded-5 text-nowrap mx-1" type="button">
                        <i class="fa-solid fa-ticket me-2"></i>
                        <span>Create Ticket</span></a>
                    <div class="input-group">
                        <input id="input-search-all" type="text" class="form-control rounded-5" placeholder="Search">
                        <button class="search-btn-all btn rounded-5 mx-1 p-2 px-3">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <a href="#" id="notifications" class="btn rounded-5 text-nowrap mx-1 p-2 px-3" type="button">
                        <i class="fa-regular fa-bell" style="font-size: 18px;"></i></a>
                    <h6 class="text-nowrap mx-1 me-2 px-1">
                        <?= $logged_user['first_name'] . ' ' . $logged_user['last_name'] ?></h6>
                    <div class="user-icon d-flex align-items-center mx-1"
                        style="background: <?= ($logged_user['gender'] == "male") ? "var(--gender-male)" : "var(--gender-female)" ?> ;">
                        <b class="d-flex align-items-center"><?= name_abbr(
                                                                    $logged_user['first_name'],
                                                                    $logged_user['last_name']
                                                                ); ?></b>
                    </div>

                </div>

            </nav>
            <main class="main">
                <div class="container-fluid mt-2">
                    <div id="alertMessage-col" class="position-fixed bottom-0 end-0 p-3">
                        <?php if ($msg = $this->session->flashdata('message')): ?>
                            <div id="alertMessage"
                                class="alert alert-<?= $msg['type'] === 'success' ? 'success' : 'danger' ?>">
                                <?= $msg['text'] ?>
                            </div>
                        <?php endif; ?>
                    </div>