<div class="d-flex justify-content-center w-100 new-ticket-container mt-4">
    <div class="container rounded-3 p-4 mb-3"
        style="background-color: white; width: 1100px; box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);">
        <h5><i class="fa-solid fa-ticket mb-3 me-2"></i> New Ticket</h5>
        <form action="<?php base_url('tickets/createTicket') ?>" id="createNewTicket" method="POST"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8 col-sm-12 pe-3">
                    <div class="col-sm-12 form-group">
                        <label for="" class="form-label">Subject:</label>
                        <input type="text" name="ticketSubject" id="ticketSubject" class="form-control"
                            value="<?= set_value("ticketSubject") ?>" placeholder="Enter ticket subject...">
                        <span><?= form_error("ticketSubject") ?></span>
                    </div>
                    <div class="col-sm-12 form-group">
                        <label for="" class="form-label">Ticket Description:</label>
                        <textarea name="ticketDescription" id="ticketDescription" class="form-control"
                            style="height: 300px;"
                            placeholder="Type here..."><?= set_value("ticketDescription") ?></textarea>
                        <span><?= form_error("ticketDescription") ?></span>
                    </div>
                    <div class="col-sm-12 form-group">
                        <label for="" class="form-label">Attachments <i>(optional)</i></label>
                        <input type="file" name="fileUploads[]" id="files" class="form-control" multiple
                            accept=".jpg,.jpeg,.png,.pdf,.docx,.ppt,.zip,.pptx" value="">
                    </div>
                    <div class="fileList-col">
                        <ul id="fileList" class="list-group mt-2"></ul>
                    </div>

                </div>
                <div class="col-md-4 col-sm-12 ps-2">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label for="" class="form-label">Department:</label>
                            <div class="input-wrapper">
                                <select name="selectDepartment" id="selectDepartment" class="form-control">
                                    <option value="">- Select Department -</option>
                                    <?php foreach ($departments as $department): ?>
                                        <option value="<?= $department['department_id'] ?>"
                                            <?= $department['department_id'] == set_value("selectDepartment") ? 'selected' : ''; ?>>
                                            <?= $department['department_name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fa-solid fa-angle-down icon-dropdown"></i>
                            </div>
                            <span><?= form_error("selectDepartment") ?></span>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="" class="form-label">Request Type:</label>
                            <div class="input-wrapper">
                                <select name="requestType" id="requestType" class="form-control" disabled>
                                    <option value="">- Select Request Type -</option>
                                    <?php foreach ($ticket_types as $type): ?>
                                        <option value=" <?= $type['ticket_type_id'] ?>"
                                            data-department="<?= $type['department_id'] ?>"
                                            <?= ($type['ticket_type_id'] == set_value("requestType")) ? "selected" : "" ?>>
                                            <?= $type['type_name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fa-solid fa-angle-down icon-dropdown"></i>
                            </div>
                            <span><?= form_error("requestType") ?></span>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 280px;">
                        <div class="createBtns d-flex justify-content-between">
                            <div class="col-6 pe-2"><input type="reset" id="resetBtn"
                                    class="btn btn-danger form-control" value="Reset"></div>
                            <div class="col-6 ps-2">
                                <input type="submit" class="btn btn-success form-control" value="Submit">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>
    </div>

</div>


<script>
    resetBtn.addEventListener('click', (e) => {
        // 🔹 Reset dropdown states
        const department = document.getElementById("selectDepartment");
        const subject = document.getElementById("ticketSubject");
        const description = document.getElementById("ticketDescription");
        const requestType = document.getElementById("requestType");


        subject.value = "";
        description.value = ""
        department.value = '';

        requestType.value = "";
        requestType.disabled = true

        // 🔹 (optional) clear validation messages
        form.querySelectorAll("span").forEach(span => span.innerHTML = "");
    });

    // Ticket Type per Department
    document.addEventListener("DOMContentLoaded", function() {
        const department = document.getElementById("selectDepartment");
        const requestType = document.getElementById("requestType");;

        const allOptions = Array.from(requestType.querySelectorAll("option"));

        function filterRequestTypes(selectedDept) {
            requestType.innerHTML = '<option value="">- Select Request Type -</option>';

            if (selectedDept === "") {
                requestType.disabled = true;
                return;
            }

            requestType.disabled = false;

            allOptions.forEach(option => {
                if (option.dataset.department === selectedDept) {
                    requestType.appendChild(option);
                }
            });

        }

        // 🔁 Run when user changes department
        department.addEventListener("change", function() {
            filterRequestTypes(this.value);
        });

        // ✅ RUN ON PAGE LOAD (THIS FIXES YOUR ISSUE)
        if (department.value !== "") {
            filterRequestTypes(department.value);
        }
    });

    document.getElementById("createNewTicket").addEventListener("submit", function() {
        document.getElementById("requestType").disabled = false;
    });
</script>