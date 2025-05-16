<div class="modal fade" id="modal-finish-survey" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="modal-add-project-label" aria-hidden="true" data-menu="project">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="modal-add-project-label">Hasil Survey</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">  
                <div class="mb-1">
                    <label for="SurveyNote" class="col-form-label">Catatan</label> 
                    <div class="input-group"> 
                        <div id="SurveyHasil" class="w-100 border"></div>
                    </div>        
                </div>   
                <div class="mb-1">
                    <label for="SurveyAddress" class="col-form-label">Upload File Pendukung</label> 
                    <div class="drop-box">
                        <span class="fs-4 fw-bold ms-auto me-auto">Drop &amp; drag Files or click for uploads</span>
                    </div>    
                    <input type="file" id="file-input" multiple style="display: none;">
                    <ul class="list-group mt-2" id="listfile"> 
                    </ul>
                </div>   
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-finsih-project">Simpan</button>
            </div>
        </div>
    </div>
</div> 

<div id="modal-optional"></div>
<script>   
    console.log(<?= JSON_ENCODE($project->SurveyFinishDelta)?>)
    var quill = new Quill('#SurveyHasil',  { 
        placeholder: 'Tulis teks Anda di sini...',
        debug: 'false',
        modules: {
            toolbar: [['bold', 'italic', 'underline', 'strike'],[{ 'list': 'ordered'}]],
        },  
        theme: "bubble"//'snow'
        //theme: 'snow'
    }); 
    quill.enable(true);  
    quill.setContents(JSON.parse(<?= JSON_ENCODE($project->SurveyFinishDelta)?>));  

    var dropBox = document.querySelector('.drop-box');
    var fileInput = document.getElementById('file-input');
    var listFile = document.getElementById('listfile');

    dropBox.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        uploadFiles(files);
    });

    dropBox.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropBox.style.background = '#f0f0f0';
    });

    dropBox.addEventListener('dragleave', () => {
        dropBox.style.background = '';
    });

    dropBox.addEventListener('drop', (e) => {
        e.preventDefault();
        const files = e.dataTransfer.files;
        uploadFiles(files);
        dropBox.style.background = '';
    });

    function uploadFiles(files) {
        for (const file of files) {
            const fileSize = formatFileSize(file.size);
            const fileItem = `
            <li class="list-group-item align-items-center d-flex"> 
                <i class="fa-solid fa-file fa-2x me-2"></i>
                <div class="d-flex flex-column flex-fill ms-2">
                    <span class="fs-6">${file.name}</span>
                    <span class="text-muted">${fileSize}</span>
                </div>
                <button class="btn btn-outline btn-danger btn-sm float-end">
                    <i class="fa-solid fa-close "></i>
                </button>
            </li>
            `;
            listFile.innerHTML += fileItem;
        }
    }

    function formatFileSize(size) {
        if (size < 1024) {
            return size + ' bytes';
        } else if (size < 1024 * 1024) {
            return (size / 1024).toFixed(2) + ' KB';
        } else {
            return (size / (1024 * 1024)).toFixed(2) + ' MB';
        }
    }
    listFile.addEventListener('click', (e) => {
        if (e.target.closest('.btn-danger')) {
            const fileItem = e.target.closest('li');
            fileItem.remove();
        }
    });
    var data_file_old = [];
    <?php
        $files = scandir('assets/images/project/'.$project->SurveyId);
        $data = array();
        
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $filePath = 'assets/images/project/' .$project->SurveyId.'/'. $file;
                $data[] = array(
                    'name' => $file,
                    'size' => filesize($filePath)
                );
            }
        }
        
        echo 'console.log(`'.json_encode($data).'`);';
        echo 'data_file_old = '.json_encode($data).';';
    ?>

    data_file_old.forEach(file => {
        const fileSize = formatFileSize(file.size);
        const fileItem = `
            <li class="list-group-item align-items-center d-flex">
                <i class="fa-solid fa-file fa-2x me-2"></i>
                <div class="d-flex flex-column flex-fill ms-2">
                    <span class="fs-6">${file.name}</span>
                    <span class="text-muted">${fileSize}</span>
                </div>
                <button class="btn btn-outline btn-danger btn-sm float-end" data-file="${file.name}">
                    <i class="fa-solid fa-close "></i>
                </button>
            </li>
        `;
        listFile.innerHTML += fileItem;
    });
    $('#btn-finsih-project').on('click', function() {
        
        const fileItems = listFile.children;
        Array.from(fileItems).forEach(fileItem => {
            const fileName = fileItem.querySelector('.fs-6').textContent;
            console.log(fileName);
            data_file_old = data_file_old.filter(file => file.name !== fileName);
        }); 

        const formData = new FormData();
        const fileInputs = document.getElementById('file-input');
        const uploadedFiles = fileInputs.files;

        for (const file of uploadedFiles) {
            formData.append('files[]', file);
        }
        formData.append('remove_file', JSON.stringify(data_file_old));
        formData.append('delta', JSON.stringify(quill.getContents()));
        formData.append('html', quill.root.innerHTML.replace(/\s+/g, " "));

        $.ajax({
            dataType: "json",
            type: 'POST',
            url: '<?= base_url() ?>/action/edit-data-survey-finish/<?= $project->SurveyId ?>',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                //console.log(data); 
                if(data["status"]===true){
                    Swal.fire({
                        icon: 'success',
                        text: 'Simpan data berhasil...!!!',  
                        confirmButtonColor: "#3085d6", 
                    }).then((result) => {    
                        $("#modal-finish-survey").modal("hide");    
                        $(".icon-project[data-menu='survey'][data-id='<?= $project->ProjectId ?>']").trigger("click");   
                        
                        if($("#modal-finish-survey").data("menu") =="survey"){
                            loader_datatable(); 
                        }else{
                            $(".icon-project[data-menu='survey'][data-id='<?= $project->ProjectId ?>']").trigger("click"); 
                        }
                    });
                  
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: data, 
                        confirmButtonColor: "#3085d6", 
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    text: xhr["responseJSON"]['message'], 
                    confirmButtonColor: "#3085d6", 
                });
            },
        });
    });

</script>