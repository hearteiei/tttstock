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
        .custom4{
            color: #76453B;
        }
    </style>
</head>

<body id="page-top">



    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">รายงานซอย 17</h1>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 font-weight-bold custom4">รายงาน</h6>
                </div>
                <div>
                    <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#additem">Add Item</button> -->
                </div>
            </div>

            <div class="card-body">
                <div id="alert_message"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="item_data" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ชื่อ</th>
                                <th>ขั้นต่ำ</th>
                                <th>คงเหลือ</th>
                            </tr>
                        </thead>
                    </table>
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

        function fetch_data() {
            var dataTable = $('#item_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "datafetchr17.php",
                    type: "POST"
                }

            });
        }

        function update_data(id, column_name, value) {
            $.ajax({
                url: "update17.php",
                method: "POST",
                data: {
                    id: id,
                    column_name: column_name,
                    value: value
                },
                success: function(data) {
                    $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                    $('#item_data').DataTable().destroy();
                    fetch_data();
                }
            });
            setInterval(function() {
                $('#alert_message').html('');
            }, 5000);
        }

        $(document).on('blur', '.update', function() {
            var id = $(this).data("id");
            var column_name = $(this).data("column");
            var value = $(this).text();
            update_data(id, column_name, value);
        });

        // $('#add').click(function() {
        //     var html = '<tr>';
        //     html += '<td contenteditable id="data1"></td>';
        //     html += '<td contenteditable id="data2"></td>';
        //     html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
        //     html += '</tr>';
        //     $('#item_data tbody').prepend(html);
        // });


        // $(document).on('click', '.delete', function() {
        //     var id = $(this).attr("id");
        //     if (confirm("Are you sure you want to remove this?")) {
        //         $.ajax({
        //             url: "delete.php",
        //             method: "POST",
        //             data: {
        //                 id: id
        //             },
        //             success: function(data) {
        //                 $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
        //                 $('#item_data').DataTable().destroy();
        //                 fetch_data();
        //             }
        //         });
        //         setInterval(function() {
        //             $('#alert_message').html('');
        //         }, 5000);
        //     }
        // });
    });
</script>