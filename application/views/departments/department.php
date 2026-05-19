<style>
    /* ===== Page background feel ===== */
    body {
        background: var(--bg);
        color: var(--text);
    }

    /* ===== Card ===== */
    .dept-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 14px;
        transition: all 0.2s ease;
    }

    .dept-card:hover {
        border-color: var(--border-hover);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(17, 24, 39, 0.06);
    }

    /* ===== Title ===== */
    .dept-title {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--text-heading);
    }

    /* ===== Badge (ink tag style) ===== */
    .dept-badge {
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 999px;
        background: var(--primary-soft);
        color: var(--primary);
        border: 1px solid var(--border);
    }

    /* ===== Meta text ===== */
    .dept-meta {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .dept-meta span {
        color: var(--text);
    }

    /* ===== Buttons ===== */
    .btn-ink {
        background: var(--primary);
        color: white;
        border-radius: 10px;
        padding: 8px 14px;
        border: none;
    }

    .btn-ink:hover {
        background: var(--primary-hover);
    }

    .btn-soft {
        background: var(--primary-light);
        color: var(--primary);
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 0.85rem;
        padding: 6px 10px;
        flex: 1;
    }

    .btn-soft:hover {
        background: var(--primary-soft);
    }

    .btn-danger-soft {
        background: var(--danger-light);
        color: var(--danger-dark);
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 0.85rem;
        padding: 6px 10px;
        flex: 1;
    }

    .btn-danger-soft:hover {
        background: #fecaca;
    }

    .btn-success-soft {
        background: var(--success-light);
        color: var(--success-dark);
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 0.85rem;
        padding: 6px 10px;
        flex: 1;
    }

    .btn-success-soft:hover {
        background: #ceffbf;
    }

    /* ===== Actions layout ===== */
    .dept-actions {
        display: flex;
        gap: 8px;
    }

    .status-active {
        font-size: 0.7rem;
        margin-left: 6px;
        padding: 2px 8px;
        border-radius: 999px;
        background: var(--success-light);
        color: var(--success-dark);
        border: 1px solid var(--border);
        font-weight: 500;
    }

    .status-danger {
        font-size: 0.7rem;
        margin-left: 6px;
        padding: 2px 8px;
        border-radius: 999px;
        background: var(--danger-light);
        color: var(--danger-dark);
        border: 1px solid var(--border);
        font-weight: 500;
    }

    .text-danger {
        font-size: 0.9rem;
    }
</style>
<?php
$errors = $this->session->flashdata('errors');
$old = $this->session->flashdata('old_input');
?>

<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 text-heading">Departments</h4>

        <button class="btn btn-ink" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
            + Add Department
        </button>
    </div>

    <div class="row g-3">
        <?php foreach ($departments as $department): ?>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card dept-card h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="dept-title"><?= ucwords($department['department_name']) ?>
                            </h5>
                            <span class="dept-badge">#<?= $department['department_id'] ?></span>
                        </div>

                        <div class="dept-meta">
                            <div>Created: <span><?= $department['department_created_at'] ?></span></div>
                            <div>Updated: <span><?= $department['department_updated_at'] ?></span></div>
                        </div>

                        <div class="dept-actions mt-3">
                            <button class="btn btn-soft btn-rename" data-bs-target="#renameDepartmentModal"
                                data-bs-toggle="modal" data-department_id="<?= $department['department_id'] ?>"
                                data-department_name="<?= $department['department_name'] ?>">Rename</button>

                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="modal fade" id="addDepartmentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content ink-modal">

                <form method="post" action="<?= base_url('departments/add_department') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title text-heading">Add Department</h5>
                        <button type="button"
                            class="btn-close <?= $this->session->flashdata('showModal') ? 'btn-close-reload' : '' ?>"
                            data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <label class="form-label text-muted">Department Name</label>
                        <input type="text" class="form-control ink-input" name="department_name"
                            placeholder="e.g. Human Resources" value="<?= set_value('department_name') ?? "" ?>">
                        <span id="" class="text-danger"><?= $errors['department_name'] ?? '' ?></span>

                    </div>

                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-soft w-100  <?= $this->session->flashdata('showModal') ? 'btn-close-reload' : '' ?>"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-ink w-100">
                            Save Department
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="renameDepartmentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content ink-modal">

                <form method="post" action="<?= base_url('departments/update_department') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title text-heading">Rename Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" id="rename_department_id" name="department_id">

                        <label class="form-label text-muted">Department Name</label>
                        <input type="text" class="form-control ink-input" id="rename_department_name"
                            name="department_name">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-soft w-100" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-ink w-100">
                            Update Department
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Deactivate -->
    <!-- <div class="modal fade modalEdit" id="deactivateModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deactivate Department</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="">
                    <input type="hidden" name="department_status" id="deactivate_status" value="deactivated">
                    <input type="hidden" name="department_id" id="deactivate_department_id">
                    <div class="modal-body">
                        <div class="col-12">
                            <span>Are you sure you want to deactivate the department <b id='deactivate_id'></b>?</span>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn submit-btn">Confirm</button>
                    </div>
                </form>

            </div>
        </div>
    </div> -->

    <script>
        $(document).on("click", ".btn-rename", function () {
            let department_id = $(this).data("department_id");
            let department_name = $(this).data('department_name');

            $("#rename_department_id").val(department_id);
            $("#rename_department_name").val(department_name);

        });

        $(document).on("click", "#deactivateBtn", function () {
            let department_id = $(this).data("department_id");

            $("#deactivate_department_id").val(department_id);
            $("#deactivate_id").html(department_id);

        });
    </script>