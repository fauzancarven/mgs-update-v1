<div class="modal fade" id="modal-edit-payment-pembelian" data-bs-backdrop="static" data-bs-keyboard="false"
          tabindex="-1" aria-labelledby="modal-add-project-label" aria-hidden="true">
          <div class="modal-dialog">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h2 class="modal-title fs-5 fw-bold" id="modal-add-project-label">Ubah
                                                  Pembayaran Pembelian</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-3">
                                        <div class="mb-1">
                                                  <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                      <label for="grandtotal-payment"
                                                                                class="col-form-label">Total
                                                                                Pembelian:</label>
                                                                      <div class="input-group">
                                                                                <span
                                                                                          class="input-group-text font-std bg-base">Rp.</span>
                                                                                <input type="text"
                                                                                          class="form-control form-control-sm  input-form d-inline-block number-price"
                                                                                          id="grandtotal-payment"
                                                                                          value="<?= $project["GrandTotal"] ?>"
                                                                                          readonly>
                                                                      </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                      <label for="sisa-payment"
                                                                                class="col-form-label">Sisa
                                                                                Pembayaran:</label>
                                                                      <div class="input-group">
                                                                                <span
                                                                                          class="input-group-text font-std bg-base">Rp.</span>
                                                                                <input type="text"
                                                                                          class="form-control form-control-sm  input-form d-inline-block number-price"
                                                                                          id="sisa-payment"
                                                                                          value="<?= $project["GrandTotal"] - (array_sum(array_column($payments, 'PaymentTotal'))) + $payment->PaymentTotal ?>"
                                                                                          readonly>
                                                                      </div>
                                                            </div>
                                                  </div>
                                        </div>

                                        <div class="mb-1">
                                                  <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                      <label for="grandtotal-payment"
                                                                                class="col-form-label">Tanggal:</label>
                                                                      <input class="form-control form-control-sm input-form"
                                                                                style="width:100%" id="date-payment">
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                      <label for="sisa-payment"
                                                                                class="col-form-label">Type:</label>
                                                                      <select class="form-select form-select-sm"
                                                                                style="width:100%" id="type-payment">
                                                                                <option value="DP">DP</option>
                                                                                <option value="DP 10%">DP 10%</option>
                                                                                <option value="DP 20%">DP 20%</option>
                                                                                <option value="DP 30%">DP 30%</option>
                                                                                <option value="DP 40%">DP 40%</option>
                                                                                <option value="DP 50%">DP 50%</option>
                                                                                <option value="DP 60%">DP 60%</option>
                                                                                <option value="DP 70%">DP 70%</option>
                                                                                <option value="DP 80%">DP 80%</option>
                                                                                <option value="DP 90%">DP 90%</option>
                                                                                <option value="Pelunasan" selected>
                                                                                          Pelunasan</option>
                                                                      </select>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="mb-1">
                                                  <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                      <label for="method-payment"
                                                                                class="col-form-label">Metode
                                                                                Pembayaran:</label>
                                                                      <select class="form-select form-select-sm"
                                                                                style="width:100%" id="method-payment">
                                                                                <?php
                                    foreach($method as $row){
                                        echo '<option value="'.$row->MethodId.'">'.$row->MethodName.'</option>';
                                    }
                                ?>
                                                                                <!-- <option value="Mandiri">Bank Mandiri</option>
                                <option value="BNI">Bank BNI</option>
                                <option value="PERMATA">Bank PERMATA</option> -->
                                                                      </select>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                      <label for="total-payment"
                                                                                class="col-form-label">Total
                                                                                Pembayaran:</label>
                                                                      <div class="input-group">
                                                                                <span
                                                                                          class="input-group-text font-std bg-base">Rp.</span>
                                                                                <input type="text"
                                                                                          class="form-control form-control-sm  input-form d-inline-block number-price"
                                                                                          id="total-payment"
                                                                                          value="<?= $payment->PaymentTotal ?>">
                                                                      </div>
                                                            </div>
                                                  </div>
                                        </div>
                                        <div class="mb-1">
                                                  <label for="comment-payment" class="col-form-label">Catatan:</label>
                                                  <input class="form-control form-control-sm input-form"
                                                            style="width:100%" id="comment-payment"
                                                            value="<?= $payment->PaymentNote ?>">
                                        </div>
                                        <div class="mb-1">
                                                  <label for="bukti-project" class="col-form-label">Upload
                                                            Bukti:</label><button id="remove-image"
                                                            class="btn btn-sm btn-danger btn-action m-1" onclick=""><i
                                                                      class="fa-solid fa-close pe-2"></i>Delete</button>
                                                  <input class="form-control form-control-sm input-form d-none"
                                                            type="file" accept="image/*" style="width:100%"
                                                            id="bukti-payment">
                                                  <div class="text-center" id="dropzone">
                                                            <div class="dz-message">Tarik dan lepas file gambar di sini
                                                                      atau klik untuk memilih</div>
                                                            <img id="preview" width="200" height="200" />
                                                  </div>
                                        </div>
                              </div>
                              <div class="modal-footer p-2">
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary"
                                                  id="btn-add-payment">Simpan</button>
                              </div>
                    </div>
          </div>
</div>

<div id="modal-optional"></div>
<script>
$('#date-payment').daterangepicker({
          "singleDatePicker": true,
          "startDate": moment("<?= $payment->PaymentDate ?>"),
          "endDate": moment(),
          locale: {
                    format: 'DD MMMM YYYY'
          }
});
$(".number-price").each(function() {
          new Cleave(this, {
                    numeral: true,
                    delimeter: ",",
                    numeralDecimalScale: 0,
                    numeralThousandGroupStyle: "thousand"
          });
});

$("#type-payment").select2({
          dropdownParent: $('#modal-add-payment .modal-content'),
          tags: true,
}).on("select2:select", function(e) {
          var data = e.params.data;
          var val_dp = parseInt(data.text.replace("DP", ""));
          var instance = $('#total-payment').data('cleave-instance');
          if (instance) {
                    console.log(val_dp)
                    if (isNaN(val_dp)) {
                              console.log("nan")
                              instance.setRawValue($("#sisa-payment").val().replace(/[^0-9]/g,
                                        ''))
                    } else {

                              instance.setRawValue($("#sisa-payment").val().replace(/[^0-9]/g,
                                                  '') / 100 *
                                        val_dp)
                    }
          }
})
$('#type-payment').append(new Option('<?= $payment->PaymentType ?>', '<?= $payment->PaymentType ?>', true, true))
          .trigger('change');

$("#method-payment").select2({
          dropdownParent: $('#modal-edit-payment-pembelian .modal-content'),
});
$("#method-payment").val("<?= $payment->PaymentMethod ?>").trigger("change");

var file;
$('#dropzone').on('dragover', function(e) {
          e.preventDefault();
          $(this).addClass('dragover');
});

$('#dropzone').on('dragleave', function(e) {
          $(this).removeClass('dragover');
});

$('#dropzone').on('drop', function(e) {
          e.preventDefault();
          $(this).removeClass('dragover');
          file = e.originalEvent.dataTransfer.files[0];
          if (file.type.match('image.*')) {
                    tampilkanPreview(file);
          } else {
                    alert('Hanya file gambar yang diperbolehkan!');
          }
});

$('#dropzone').on('click', function() {
          $('#bukti-payment').trigger('click');
});

$('#bukti-payment').on('change', function() {
          file = this.files[0];
          if (file.type.match('image.*')) {
                    tampilkanPreview(file);
          } else {
                    alert('Hanya file gambar yang diperbolehkan!');
          }
});

var image_payment = "<?= $image ?>";
if (image_payment != "") {
          $("#dropzone .dz-message").hide();
          $('#preview').attr('src', image_payment);
          $('#preview').show();
} else {

          $("#dropzone .dz-message").show();
          $('#preview').hide();
}

function tampilkanPreview(file) {
          var reader = new FileReader();
          reader.onload = function(e) {
                    $("#dropzone .dz-message").hide();
                    $('#preview').attr('src', e.target.result);
                    $('#preview').show();
          };
          reader.readAsDataURL(file);
}
$("#remove-image").click(function() {
          $('#preview').attr('src', "");
          $('#preview').hide();
          $("#dropzone .dz-message").show();
});



$("#btn-add-payment").click(function() {
          if ($("#total-payment").val() == 0) {
                    Swal.fire({
                              icon: 'error',
                              text: 'Total payment harus diisi...!!!',
                              confirmButtonColor: "#3085d6",
                    }).then(function() {
                              swal.close();
                              setTimeout(() => $("#total-payment").focus(),
                                        300);
                    });
                    return;
          }

          $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "<?= base_url() ?>action/edit-data-payment/<?= $payment->PaymentId?>",
                    data: {
                              "PaymentDate": $("#date-payment").data(
                                                  'daterangepicker').startDate
                                        .format("YYYY-MM-DD"),
                              "PaymentType": $("#type-payment").val(),
                              "PaymentMethod": $("#method-payment").val(),
                              "PaymentTotal": $("#total-payment").val().replace(
                                        /[^0-9]/g, ''),
                              "PaymentNote": $("#comment-payment").val(),
                              "TemplateId": 1,
                              "image": $("#preview").attr('src'),
                              "PaymentRef": '<?= $payment->PaymentRef ?>',
                              "PaymentRefType": '<?= $payment->PaymentRefType ?>',
                              "ProjectId": '<?= $payment->ProjectId ?>',
                    },
                    success: function(data) {
                              if (data["status"] === true) {
                                        Swal.fire({
                                                  icon: 'success',
                                                  text: 'Simpan data berhasil...!!!',
                                                  confirmButtonColor: "#3085d6",
                                        }).then((result) => {
                                                  $("#modal-edit-payment-pembelian")
                                                            .modal(
                                                                      "hide"
                                                            );
                                                  if ($("#modal-edit-payment-pembelian")
                                                            .data(
                                                                      "menu"
                                                            ) ==
                                                            "sample"
                                                  ) {
                                                            loader_datatable
                                                                      ();
                                                  } else if (
                                                            $(
                                                                      "#modal-edit-payment-pembelian"
                                                            )
                                                            .data(
                                                                      "menu"
                                                            ) ==
                                                            "Invoice"
                                                  ) {
                                                            table.ajax
                                                                      .reload();
                                                  } else {
                                                            loader_data_project
                                                                      ('<?= $payment->ProjectId ?>',
                                                                                '<?= strtolower($payment->PaymentRefType) ?>'
                                                                      )
                                                  }
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
});
</script>