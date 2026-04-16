<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/dataTable-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css">
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <!-- <link rel="stylesheet" href="../css/dataTable-styles.css"> -->
    <title><?php echo $title
            ?></title>


</head>

<body>
    <div class="container-fluid d-flex g-0">
        <!-- sidebar -->
        <aside id="sidebar" class="collapsed">
            <div id="sidebar-logo"
                class="sidebar-logo d-flex justify-content-between align-items-center px-4 border-bottom">
                <a href="#">
                    <h5>Ticketing System</h5>
                </a>

                <button class="sidebar-toggler" type="button"><i class="fa-solid fa-bars"></i></button>
            </div>
            <!-- sidebar Navigation -->
            <ul class="sidebar-nav p-0">
                <li class="sidebar-header">Lists</li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-grip-vertical"></i><span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#ticket-items" aria-expanded="true" aria-controls="ticket-items">
                        <i class="fa-solid fa-ticket"></i>
                        <span>Tickets</span>
                    </a>
                    <ul class="sidebar-dropdown list-unstyled collapse" id="ticket-items" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="<?= base_url() ?>tickets" class="sidebar-link"><i class="fa-regular fa-user"></i>My
                                Ticket</a>
                            <a href="#" class="sidebar-link"><i class="fa-solid fa-users"></i>All</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-layer-group"></i><span>Categories</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-thumbtack"></i><span>Pinned</span>
                    </a>
                </li> -->

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#history-item" aria-expanded="true" aria-controls="history-item">
                        <i class="fa-solid fa-hourglass"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="sidebar-dropdown list-unstyled collapse" id="history-item" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link"><i class="fa-solid fa-check"></i>Completed</a>
                            <a href="#" class="sidebar-link"><i class="fa-solid fa-xmark"></i>Undone</a>
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
                <a href="<?= base_url() ?>users" class="sidebar-link"><i
                        class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>
            </div>
        </aside>

        <div id="main" class="container-fluid g-0">
            <div id="overlayBg"></div>
            <nav id="nav-toggle"
                class="navbar px-3 d-flex align-items-center justify-content-between navbar-expand border-bottom">
                <div class="d-flex align-items-center">
                    <button class="toggler-btn" type="button"><i class="fa-solid fa-bars"></i></button>
                    <h4 class="ms-2"><?= $title ?></h4>
                </div>

                <div class="d-flex align-items-center">
                    <a href="<?= base_url() ?>tickets/createTicket" id="createTicket"
                        class="btn btn-primary rounded-5 text-nowrap mx-1" type="button">
                        <i class="fa-solid fa-ticket me-2"></i>
                        Create Ticket</a>
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

            </nav>
            <main class="main p-3 mt-5">
                <div class="container-fluid mt-3">