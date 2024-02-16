<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
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
    <!-- Your modal -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="withdrawModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0 font-weight-bold custom4" id="withdrawModalLabel">เบิกสินค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p class="h4 mb-1 text-gray-800" id="withdrawItemName"></p>
                    <div class="row">
                        <div class="col">
                            <p class="h4 mb-1 text-gray-800 m-0">คงเหลือ</p>
                        </div>
                        <div class="col">
                            <p class="h4 mb-1 text-gray-800 m-0" id="remain"></p>
                        </div>
                    </div>
                    <div class="col">
                        <p class="h4 mb-1 text-gray-800 m-0">เบิกจำนวน</p>
                    </div>
                    <!-- Input field on the next line -->
                    <div class="row mt-3">
                        <div class="col">
                            <input type="text" class="form-control" id="withdrawInput" placeholder="Enter Quantity">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="withdrawModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0 font-weight-bold custom4" id="withdrawModalLabel">เบิกสินค้าสำเร็จ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p class="h4 mb-1 text-gray-800" id="withdrawItemName"></p>
                    <div class="row">
                        <div class="col">
                            <p class="h4 mb-1 text-gray-800 m-0">จำนวน</p>
                        </div>
                        <div class="col">
                            <p class="h4 mb-1 text-gray-800 m-0" id="withdrawInputs"></p>
                        </div>
                    </div>
                    <div class="col">
                        <p class="h4 mb-1 text-gray-800 m-0">คงเหลือ</p>
                    </div>
                    <!-- Input field on the next line -->
                    <div class="row mt-3">
                        <div class="col">
                            <p class="h4 mb-1 text-gray-800 m-0" id="remains"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeee" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">สต็อกซอย 17</h1>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 font-weight-bold custom4">สต็อก</h6>
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
                                <th>คงเหลือ</th>
                                <th>เบิก</th>
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
                    url: "datastock17.php",
                    type: "POST"
                }

            });
        }

        $(document).on('click', '.withdraw', function() {
            var itemName = $(this).closest('tr').find('td:first').text();
            var remainingValue = $(this).closest('tr').find('td:eq(1)').text(); // Extract item name from the first column of the clicked row
            $('#withdrawItemName').text(itemName); // Set the modal's item name text
            $('#withdrawModal').modal('show'); // Show the modal
            $('#remain').text(remainingValue);
        });
        $('#withdrawModal').on('click', '.btn-success', function() {
            // Get the input value
            var inputValue = $('#withdrawInput').val();
            var name = $('#withdrawItemName').text();
            var remain = parseInt($('#remain').text());
            var branch = 'soi17';
            var remainnew = remain - inputValue;
            $('#remains').text(remainnew);
            $('#withdrawInputs').text(inputValue);
            if (inputValue > remain) {
                alert("Input quantity cannot be greater than remaining quantity.");
                return; // Exit function early
            }else if (isNaN(inputValue) || inputValue <= 0) {
                alert("Error: Please input correct Data");
                return;
            }
            $.ajax({
                url: 'updatestock.php', // Your server-side script to handle database update
                method: 'POST',
                data: {
                    input: inputValue,
                    name: name,
                    branch: branch,
                    remainnew:remainnew
                },
                success: function(response) {
                    console.log(response); // Log the response from the server
                    // Optionally, you can show a success message or perform other actions here
                    $('#successModal').modal('show');
                    
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log any errors to the console
                }
            });

            // Close the modal
            $('#withdrawModal').modal('hide');
        });
        $('#successModal').on('click', '.closeee', function() {
            location.reload();

        });


    });
</script>