<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
include('includes/header.php');
include('includes/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tables Example</title>

    <!-- Custom fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        .button-container {
            display: flex;
            gap: 10px;
            /* Adjust the gap value as needed */
        }

        .custom-card-height {
            height: 400px;
            /* Adjust the height value as needed */
        }

        .custom-large-button {
            font-size: 28px;
            /* Adjust the font size as needed */
            padding: 5px 10px;
            /* Adjust the padding as needed */
        }

        .custom4 {
            color: #76453B;
        }
    </style>
</head>

<body id="page-top">
    <div class="container-fluid ">
        <h1 class="h3 mb-2 custom4">หน้าหลัก</h1>
        <!-- <button type="button" name="withdraw" class="btn btn-danger btn-xs line">เบิกสินค้า</button> -->

        <div class="row">
            <!-- First Report Table (Left) -->
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 font-weight-bold custom4">ซอย13 ของหมด</h6>
                        </div>
                        <div></div>
                    </div>
                    <div class="card-body">
                        <div id="alert_message_1"></div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="report1" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ชื่อ</th>
                                        <th>สั่งเพิ่ม</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Report Table (Right) -->
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 font-weight-bold custom4">ซอย17 ของหมด</h6>
                        </div>
                        <div></div>
                    </div>
                    <div class="card-body">
                        <div id="alert_message_2"></div>
                        <div class="table-responsive ">
                            <table class="table table-bordered" id="report2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ชื่อ</th>
                                        <th>สั่งเพิ่ม</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 font-weight-bold custom4">ครัวกลางของหมด</h6>
                        </div>
                        <div></div>
                    </div>
                    <div class="card-body">
                        <div id="alert_message_3"></div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="reportmid" width="100%" cellspacing="0">
                                <thead>
                                    <th>ชื่อ</th>
                                    <th>สั่งเพิ่ม</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Kunasin 2024</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</body>

</html>
<script type="text/javascript" language="javascript">
    $(document).ready(function() {

        fetch_data();
        fetch_data2();
        fetch_data3();

        function fetch_data() {
            var dataTable = $('#report1').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "pageLength": 25,
                "ajax": {
                    url: "datafetch13o.php",
                    type: "POST"
                }

            });
        }

        function fetch_data2() {
            var dataTable = $('#report2').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "pageLength": 25,
                "ajax": {
                    url: "datafetch17o.php",
                    type: "POST"
                }

            });
        }

        function fetch_data3() {
            var dataTable = $('#reportmid').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "pageLength": 25,
                "ajax": {
                    url: "datafetchmido.php",
                    type: "POST"
                }

            });
        }
        $(".line").click(function(){
        $.ajax({
            url: "line.php",
            type: "GET", 
            success: function(response) {
                console.log(response); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });


    });
</script>