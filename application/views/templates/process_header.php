    <div class="process-header navbar">
        <ul class="nav list-unstyled ps-0 w-100  d-flex justify-content-center">
            <li class="process-list <?= isset($activeAll) && $activeAll ? "active" : "" ?>"><a
                    href="<?= base_url("tickets/all") ?>">All
                    <span class="badge bg-primary">90</span></a></li>
            <li class="process-list <?= isset($activeApproval) && $activeApproval ? "active" : "" ?>"><a
                    href="<?= base_url("tickets/approval") ?>">Approval
                    <span class="badge bg-primary">90</span></a>
            </li>
            <li class="process-list <?= isset($activeOpen) && $activeOpen ? "active" : "" ?>"><a
                    href="<?= base_url("tickets/open") ?>">To
                    Assign <span class="badge bg-primary">90</span></a></li>
            <li class="process-list <?= isset($activePending) && $activePending ? "active" : "" ?>"><a
                    href="<?= base_url("tickets/pending") ?>">Assigned
                    <span class="badge bg-primary">90</span></a></li>
            <li class="process-list <?= isset($activeOnGoing) && $activeOnGoing ? "active" : "" ?>"><a
                    href="<?= base_url("tickets/ongoing") ?>">On Going
                    <span class="badge bg-primary">90</span></a></li>
            <li class="process-list <?= isset($activeTesting) && $activeTesting ? "active" : "" ?>"><a
                    href="<?= base_url("tickets/testing") ?>">Testing
                    <span class="badge bg-primary">90</span></a></li>
            <li class="process-list <?= isset($activeClosed) && $activeClosed ? "active" : "" ?>"><a href="">Closed
                    <span class="badge bg-primary">90</span></a></li>
        </ul>
    </div>