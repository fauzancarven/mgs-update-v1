<div class="modal fade" id="modal-edit-proses-delivery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
          aria-labelledby="modal-edit-proses-delivery-label" aria-hidden="true" data-menu="project">
          <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h2 class="modal-title fs-5 fw-bold" id="modal-edit-proses-delivery-label">Data
                                                  Konfirmasi dan upload foto pengemasan</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-3">
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="DeliveryDateProses"
                                                            class="col-sm-2 col-form-label">Tanggal</label>
                                                  <div class="col-sm-10">
                                                            <input id="DeliveryDateProses" name="DeliveryDateProses"
                                                                      type="text"
                                                                      class="form-control form-control-sm input-form"
                                                                      value="">
                                                  </div>
                                        </div>
                                        <div class="row mb-1 align-items-center mt-2">
                                                  <label for="DeliveryDateProses"
                                                            class="col-sm-2 col-form-label pe-0">Lampiran</label>
                                                  <div class="col-sm-10">
                                                            <input type="file" class="d-none" accept="image/*,video/*"
                                                                      id="upload-produk" multiple>
                                                            <div class="col-sm-12 d-flex flex-wrap">
                                                                      <div class="d-flex flex-wrap">
                                                                                <div class="d-flex flex-wrap"
                                                                                          id="list-produk">
                                                                                          <div class="image-default-obi text-center"
                                                                                                    id="img-produk">
                                                                                                    <i class="ri-attachment-line"
                                                                                                              style="font-size:1rem"></i>
                                                                                                    <span>Tambah Foto
                                                                                                              atau
                                                                                                              Video</span>
                                                                                          </div>

                                                                                </div>
                                                                      </div>
                                                            </div>
                                                  </div>
                                        </div>
                              </div>
                              <div class="modal-footer p-2">
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary"
                                                  id="btn-proses-delivery">Simpan</button>
                              </div>
                    </div>
          </div>
</div>
<div id="modal-optional"></div>
<script>
var data_image = JSON.parse('<?= json_encode($image)?>');
$('#DeliveryDateProses').daterangepicker({
          "singleDatePicker": true,
          "startDate": moment('<?= $delivery->DeliveryDateProses?>'),
          locale: {
                    format: 'DD MMMM YYYY'
          }
});

$("#img-produk").on('click', function() {
          $("#upload-produk").trigger("click");
})
data_image.forEach(element => {
          fetch(element.url)
                    .then(res => res.blob())
                    .then(blob => load_file_el(blob))
});
load_file_el = function(file) {
          if (file) {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                              const fileType = file.type.split('/')[0];
                              if (fileType === 'image') {
                                        $("#img-produk").remove()
                                        $("#list-produk").append(`<div class="image-default-obi border"> 
            <img src="${reader.result}" draggable="true"> 
            <div class="action">  
              <a onclick="delete_image(this)" class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-title="Print Pengiriman"> 
                <iconify-icon icon="lucide:trash-2"></iconify-icon> 
              </a> 
            </div> 
          </div>`);
                              } else if (fileType === 'video') {
                                        $("#img-produk").remove()
                                        $("#list-produk").append(`<div class="image-default-obi border"> 
            <video src="${reader.result}" controls draggable="true"></video> 
            <div class="action"> 
              <a onclick="delete_image(this)" class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-title="Print Pengiriman"> 
                <iconify-icon icon="lucide:trash-2"></iconify-icon> 
              </a> 
            </div> 
          </div>`);
                              }
                              // Tambahkan event dragstart, dragover, dragleave, dan drop untuk setiap gambar atau video
                              var draggedImage = null;
                              $('.image-default-obi.border img, .image-default-obi.border video')
                                        .on('dragstart', function(event) {
                                                  draggedImage = $(
                                                            this
                                                  );
                                        });
                              $('.image-default-obi.border').on('dragover',
                                        function(event) {
                                                  event
                                                            .preventDefault();
                                                  $(this).addClass(
                                                            'dragover'
                                                  );
                                        });
                              $('.image-default-obi.border').on('dragleave',
                                        function() {
                                                  $(this).removeClass(
                                                            'dragover'
                                                  );
                                        });
                              $('.image-default-obi.border').on('drop',
                                        function(event) {
                                                  event
                                                            .preventDefault();
                                                  $(this).removeClass(
                                                            'dragover'
                                                  );
                                                  const existingImage =
                                                            $(this)
                                                            .find(
                                                                      'img, video'
                                                            );
                                                  if (draggedImage) {
                                                            const sourceDropzone =
                                                                      draggedImage
                                                                      .closest(
                                                                                '.image-default-obi.border'
                                                                      );
                                                            sourceDropzone
                                                                      .prepend(
                                                                                existingImage
                                                                      );
                                                            $(this).prepend(
                                                                      draggedImage
                                                            );
                                                  }
                                        });
                              $("#list-produk").append(`<div class="image-default-obi text-center" id="img-produk"> 
                                        <i class="ri-attachment-line" style="font-size:1rem"></i> 
          <span>Tambah Foto atau Video</span> 
        </div>`);
                              $("#img-produk").on('click', function() {
                                        $("#upload-produk")
                                                  .trigger(
                                                            "click"
                                                  );
                              })
                    }
          }
}
$("#upload-produk").on('change', function() {
          const files = this.files;
          for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    load_file_el(file);
          }
});

crop_image = function(el) {
          var image_crop = $(el).parent().parent().find('img');
          var flip = 0;
          $('#modal-edit').modal('show');

          $('#modal-edit').on('shown.bs.modal', function() {
                    $uploadCrop.croppie('bind', {
                              url: $(image_crop).attr('src')
                    }).then(function() {
                              console.log('jQuery bind complete');
                    });
          });
          rotate_image = function(val) {
                    $uploadCrop.croppie('rotate', parseInt(val));
          }
          flip_image = function(val) {
                    flip = flip == 0 ? val : 0;
                    $uploadCrop.croppie('bind', {
                              url: $(el).parent().parent().find('img').attr(
                                        'src'),
                              orientation: flip
                    });
          }

          $('#submit-crop').unbind().click(function(ev) {
                    $uploadCrop.croppie('result', {
                              type: 'base64',
                              format: 'png',
                              size: {
                                        width: 400,
                                        height: 400
                              }
                    }).then(function(resp) {
                              $(image_crop).attr('src', resp)
                              $('#modal-edit').modal('hide');
                    });
          });
}
delete_image = function(el) {
          $(el).parent().parent().remove();
}
$("#btn-proses-delivery").click(function() {
          //   var srcList = $("#list-produk img").not("#img-produk img").map(function() {
          //             return $(this).attr("src")
          //   }).get();
          var srcList = $("#list-produk img, #list-produk video").not(
                    "#img-produk img, #img-produk video").map(function() {
                    return $(this).attr("src");
          }).get().flat();
          if (srcList.length === 0) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Lampiran harus di upload...!!!',
                              confirmButtonColor: "#3085d6",
                    }).then(function() {
                              swal.close();
                    });
                    return;
          }
          $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/edit-proses-delivery/<?= $delivery->DeliveryId ?>",
                    data: {
                              "DeliveryDateProses": $("#DeliveryDateProses")
                                        .data('daterangepicker').startDate
                                        .format("YYYY-MM-DD"),
                              "DeliveryImageList": srcList,
                    },
                    success: function(data) {
                              if (data["status"] === true) {
                                        Swal.fire({
                                                  icon: 'success',
                                                  text: 'Simpan data berhasil...!!!',
                                                  confirmButtonColor: "#3085d6",
                                        }).then((result) => {
                                                  $.ajax({
                                                            dataType: "json",
                                                            method: "POST",
                                                            url: "<?= base_url() ?>get/data-proses-delivery-status/<?= $delivery->DeliveryId ?>",
                                                            success: function(
                                                                      data
                                                            ) {
                                                                      if (data["status"] ===
                                                                                true
                                                                      ) {

                                                                                $("#delivery-proses-<?= $delivery->DeliveryId ?>")
                                                                                          .replaceWith(
                                                                                                    data[
                                                                                                              'data'
                                                                                                    ]
                                                                                          );
                                                                      }
                                                            }
                                                  });
                                                  $("#modal-edit-proses-delivery")
                                                            .modal(
                                                                      "hide"
                                                            );
                                        });

                              } else {
                                        Swal.fire({
                                                  icon: 'error',
                                                  text: data,
                                                  confirmButtonColor: "#3085d6",
                                        });
                              }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                              Swal.fire({
                                        icon: 'error',
                                        text: xhr["responseJSON"]
                                                  [
                                                            'message'
                                                  ],
                                        confirmButtonColor: "#3085d6",
                              });
                    }
          });
})
</script>