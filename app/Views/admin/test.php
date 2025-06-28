<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/ti-icons/css/themify-icons.css"> 
    <!-- endinject -->
    <!-- Plugin css for this page --> 

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/select.dataTables.min.css">  
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/datatables.min.css">    
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/sweetalert2.min.css">  
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/vertical-layout-light/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/bootstrap-5.3.3/css/bootstrap.min.css">  
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/select2.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/daterangepicker.css"> 
    
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/croppie.css">  
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/quill.snow.css"> 
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/quill.bubble.css">  
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.2.2/quill.bubble.css" integrity="sha512-WQTpL51Eas4VrSAIGPsbEyoB5Uh8SL71rO35yGllJzaxuvP0LQB630JBYKI5dSxUdDLP4UYH0VXZ8ECiOPVqcA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.2.2/quill.snow.css" integrity="sha512-13R80ZrT2yyT/Fphe32GH8p3rn5Z6ZM4ComBrMSo2l4z4ZhoGXyMzKj306k54f6WUwzxmJ6zzT0/MngfkWmftw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/fontawesome.6.7.1/css/fontawesome.css") ?>" > 
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/fontawesome.6.7.1/css/solid.css") ?>" >  
    <!-- End plugin css for this page -->
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo/logo.png" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" 
	  href="https://static.eu1.mindsphere.io/mdsp-css/v2.7.0/css/mdsp-css.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/custom-view.css">  
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/custom-datatable.css">  
</head>
<body>
    <!-- plugins:js -->
    <script src="<?= base_url(); ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url(); ?>assets/vendors/chart.js/Chart.min.js"></script>   
    <script src="<?= base_url(); ?>assets/js/datatables.min.js"></script>  
    <script src="<?= base_url(); ?>assets/js/sweetalert2.min.js"></script> 

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    
    <script src="<?= base_url(); ?>assets/bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>assets/js/template.js"></script>
    <script src="<?= base_url(); ?>assets/js/settings.js"></script>
    <script src="<?= base_url(); ?>assets/js/todolist.js"></script>
    <script src="<?= base_url(); ?>assets/js/daterangepicker.js"></script>
    <script src="<?= base_url(); ?>assets/js/cleave.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/cleave-phone.id.js"></script>
     
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url(); ?>assets/js/dashboard.js"></script>
    <script src="<?= base_url(); ?>assets/js/Chart.roundedBarCharts.js"></script>
    
    <script src="<?= base_url(); ?>assets/js/select2.min.js"></script> 
    <!-- End custom js for this page-->

    <script src="<?= base_url(); ?>assets/js/croppie.min.js">  </script> 
    <!-- <script src="https://cdn.jsdelivr.net/npm/highlight.js@11.6.0/dist/highlight.min.js"></script>  -->
    <!-- <script src=" https://cdnjs.cloudflare.com/ajax/libs/quill/1.2.2/quill.min.js"></script>  -->
    <script src="<?= base_url(); ?>assets/js/quill.js">  </script>  
    <!-- <script src="<?= base_url(); ?>assets/quill-image-resize-module-master/image-resize.min.js">  </script>   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script> 


    <script src="<?= base_url(); ?>assets/js/jquery.redirect.js">  </script> 
    
    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js" integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+" crossorigin="anonymous"></script> 

    <h1>Belajar Object</h1>

    <div id="list-table" class="vh-100"></div>
 
    <div id="modal-optional"></div>
    
    <script>
        const BASEURL =  "<?= base_url() ?>";
        function select2OptionFormat(option) {
            var originalOption = option.element;
            if ($(originalOption).data('html')) {
                return $(originalOption).data('html');
            }          
            return option.text;
        }
        $(".navbar-toggler").click(function(){ 
            $.ajax({ 
                method: "POST",
                url: "<?= base_url() ?>admin/sidebar", 
                data:{
                    "sidebar": ($('body').attr("class") == "sidebar-icon-only" ? true : false)
                },
                success: function(data) {   
                },
                fail: function(xhr, textStatus, errorThrown){ 
                }
            }); 
        });
        const rupiah = (number)=>{
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                maximumFractionDigits: 0
            }).format(number);
        }
    </script>
    <script src="./../assets/tableCustom.js"></script> 
    <script>
        $(document).ready(function() {
            let component = new tableItem("list-table",{
                dataitem : [],
                baseUrl : "<?= base_url(); ?>"
            }); 

            component.on("subtotal",function(data){
                console.log(data);
            })
        });
    </script>
</body>
</html>