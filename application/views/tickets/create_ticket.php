<div class="d-flex justify-content-center w-100 new-ticket-container">
    <div class="rounded-3 p-4" style="background-color: #f2f2f2; width: 1100px;">
        <h5><i class="fa-solid fa-ticket mb-3 me-2"></i> New Ticket</h5>
        <form action="<?php base_url('tickets/createTicket') ?>" id="createNewTicket" method="POST"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8 col-sm-12 pe-3">
                    <div class="col-sm-12 form-group">
                        <label for="" class="form-label">Subject:</label>
                        <input type="text" name="ticketSubject" id="ticketSubject" class="form-control"
                            placeholder="Enter ticket subject...">
                    </div>
                    <div class="col-sm-12 form-group">
                        <label for="" class="form-label">Ticket Description:</label>
                        <textarea name="ticketDescription" id="ticketDescription" class="form-control"
                            style="height: 300px;" placeholder="Type here..."></textarea>


                    </div>
                    <div class="col-sm-12 form-group">
                        <label for="" class="form-label">Attachments</label>
                        <input type="file" name="fileUploads[]" id="files" class="form-control" multiple
                            accept=".jpg,.jpeg,.png,.pdf,.docx,.ppt,.zip,.pptx">
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
                                        <option value="<?= $department['department_id'] ?>">
                                            <?= $department['department_name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fa-solid fa-angle-down icon-dropdown"></i>
                            </div>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="" class="form-label">Request Type:</label>
                            <div class="input-wrapper">
                                <select name="requestType" id="requestType" class="form-control" disabled>
                                    <option value="">- Select Request Type -</option>
                                    <?php foreach ($ticket_types as $type): ?>
                                        <option value=" <?= $type['ticket_type_id'] ?>"
                                            data-department="<?= $type['department_id'] ?>">
                                            <?= $type['type_name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fa-solid fa-angle-down icon-dropdown"></i>
                            </div>

                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="" class="form-label">Level of Priority:</label>
                            <div class="input-wrapper">
                                <select name="priority" id="priority" class="form-control" disabled>
                                    <option value="">- Select Priority -</option>
                                    <option value="Critical">Critical</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                                <i class="fa-solid fa-angle-down icon-dropdown"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 280px;">
                        <div class="createBtns d-flex justify-content-between">
                            <div class="col-6 pe-2"><input type="reset" id="resetBtn"
                                    class="btn btn-danger form-control" value="Reset Fields"></div>
                            <div class="col-6 ps-2">
                                <input type="submit" class="btn btn-success form-control" value="Submit Ticket">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>
    </div>

</div>


<script>
    const input = document.getElementById('files');
    const fileList = document.getElementById('fileList');
    const resetBtn = document.getElementById('resetBtn')

    let selectedFiles = [];

    input.addEventListener('change', (e) => {
        const newFiles = Array.from(e.target.files);

        // Append instead of overwrite
        selectedFiles = [...selectedFiles, ...newFiles];

        updateInputFiles();
        renderList();
    });

    function renderList() {
        fileList.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const li = document.createElement('li');
            li.className = "list-group-item d-flex align-items-center";
            li.style.marginBottom = '10px';

            // 🔹 Wrapper div (THIS is what you want)
            const wrapper = document.createElement('div');
            wrapper.className = "ms-2 w-100 d-flex justify-content-between align-items-center";

            const fileInfo = document.createElement('div');
            fileInfo.innerHTML = `<span>${file.name}</span>`;

            // Remove button
            const btn = document.createElement('button');
            btn.textContent = 'Remove';
            btn.type = 'button'; // prevent form submit
            btn.style.marginLeft = '10px';
            btn.onclick = () => removeFile(index);

            const fileIcons = {
                pdf: 'assets/images/ticket_attachments/defaults/pdf.png',
                doc: 'assets/images/ticket_attachments/defaults/word.png',
                docx: 'assets/images/ticket_attachments/defaults/word.png',
                xls: 'assets/images/ticket_attachments/defaults/excel.png',
                xlsx: 'assets/images/ticket_attachments/defaults/excel.png',
                ppt: 'assets/images/ticket_attachments/defaults/ppt.png',
                pptx: 'assets/images/ticket_attachments/defaults/ppt.png',
                txt: 'assets/images/ticket_attachments/defaults/txt.png',
                zip: 'assets/images/ticket_attachments/defaults/zip.png',
                rar: 'assets/images/ticket_attachments/defaults/zip.png',
                default: 'assets/images/ticket_attachments/defaults/file.png'
            };

            const fileName = file.name.toLowerCase();
            const ext = fileName.split('.').pop();


            const img = document.createElement('img');
            // ✅ Image preview (FIXED: now inside loop)

            let previewElement;

            if (file.type.startsWith('image/')) {
                // Show actual image
                previewElement = document.createElement('img');
                previewElement.src = URL.createObjectURL(file);

            } else {
                // Show icon based on extension
                previewElement = document.createElement('img');

                const iconPath = fileIcons[ext] || fileIcons['default'];
                previewElement.src = "<?= base_url() ?>" + iconPath;

            }


            // Styling
            previewElement.style.display = 'block';
            previewElement.style.width = '50px';
            previewElement.style.marginBottom = '5px';
            li.appendChild(previewElement);

            wrapper.appendChild(fileInfo);
            wrapper.appendChild(btn);

            li.appendChild(wrapper);

            fileList.appendChild(li);


        });
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        updateInputFiles();
        renderList();
    }

    function updateInputFiles() {
        const dataTransfer = new DataTransfer();

        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;
    }


    resetBtn.addEventListener('click', () => {
        selectedFiles = [];
        updateInputFiles();
        renderList();
    });

    // Ticket Type per Department
    document.addEventListener("DOMContentLoaded", function() {
        const department = document.getElementById("selectDepartment");
        const requestType = document.getElementById("requestType");
        const priority = document.getElementById('priority');

        const allOptions = Array.from(requestType.querySelectorAll("option"));

        function filterRequestTypes(selectedDept) {
            requestType.innerHTML = '<option value="">- Select Request Type -</option>';

            if (selectedDept === "") {
                requestType.disabled = true;
                priority.disabled = true;
                return;
            }

            requestType.disabled = false;
            priority.disabled = false;

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
    });
</script>