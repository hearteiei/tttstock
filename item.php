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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

        body {
            background-color: #e6e6e6;
            width: 100%;
            height: 100%;
        }

        #successall .page-body {
            max-width: 300px;
            background-color: #FFFFFF;
            margin: 10% auto;
        }

        #successall .page-body .head {
            text-align: center;
        }

        /* #successall .tic{
  font-size:186px;
} */
        #successall .close {
            opacity: 1;
            position: absolute;
            right: 0px;
            font-size: 30px;
            padding: 3px 15px;
            margin-bottom: 10px;
        }

        #successall .checkmark-circle {
            width: 150px;
            height: 150px;
            position: relative;
            display: inline-block;
            vertical-align: top;
        }

        .checkmark-circle .background {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #1ab394;
            position: absolute;
        }

        #successall .checkmark-circle .checkmark {
            border-radius: 5px;
        }

        #successall .checkmark-circle .checkmark.draw:after {
            -webkit-animation-delay: 300ms;
            -moz-animation-delay: 300ms;
            animation-delay: 300ms;
            -webkit-animation-duration: 1s;
            -moz-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-timing-function: ease;
            -moz-animation-timing-function: ease;
            animation-timing-function: ease;
            -webkit-animation-name: checkmark;
            -moz-animation-name: checkmark;
            animation-name: checkmark;
            -webkit-transform: scaleX(-1) rotate(135deg);
            -moz-transform: scaleX(-1) rotate(135deg);
            -ms-transform: scaleX(-1) rotate(135deg);
            -o-transform: scaleX(-1) rotate(135deg);
            transform: scaleX(-1) rotate(135deg);
            -webkit-animation-fill-mode: forwards;
            -moz-animation-fill-mode: forwards;
            animation-fill-mode: forwards;
        }

        #successall .checkmark-circle .checkmark:after {
            opacity: 1;
            height: 75px;
            width: 37.5px;
            -webkit-transform-origin: left top;
            -moz-transform-origin: left top;
            -ms-transform-origin: left top;
            -o-transform-origin: left top;
            transform-origin: left top;
            border-right: 15px solid #fff;
            border-top: 15px solid #fff;
            border-radius: 2.5px !important;
            content: '';
            left: 35px;
            top: 80px;
            position: absolute;
        }

        @-webkit-keyframes checkmark {
            0% {
                height: 0;
                width: 0;
                opacity: 1;
            }

            20% {
                height: 0;
                width: 37.5px;
                opacity: 1;
            }

            40% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }

            100% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }
        }

        @-moz-keyframes checkmark {
            0% {
                height: 0;
                width: 0;
                opacity: 1;
            }

            20% {
                height: 0;
                width: 37.5px;
                opacity: 1;
            }

            40% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }

            100% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }
        }

        @keyframes checkmark {
            0% {
                height: 0;
                width: 0;
                opacity: 1;
            }

            20% {
                height: 0;
                width: 37.5px;
                opacity: 1;
            }

            40% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }

            100% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }
        }

        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body id="page-top">
    <script type="text/javascript">
        <?php
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
        }
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            // Display message based on status
            if ($status == 'success') {
                echo '$(document).ready(function(){ $("#additemdata").modal("show"); });';
                echo 'window.history.replaceState({}, document.title, window.location.pathname);';
            } elseif ($status == 'already') {
                echo '$(document).ready(function(){ $("#already").modal("show"); });';
                echo 'window.history.replaceState({}, document.title, window.location.pathname);';
            } elseif ($status == 'char') {
                echo '$(document).ready(function(){ $("#char").modal("show"); });';
                echo 'window.history.replaceState({}, document.title, window.location.pathname);';
            } elseif ($status == 'successall') {
                echo '$(document).ready(function(){ $("#successall").modal("show"); });';
                echo 'window.history.replaceState({}, document.title, window.location.pathname);';
            }
        }
        ?>
    </script>

    <!--success Modal -->
    <div id="successall" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <a class="close" href="#" data-dismiss="modal">&times;</a>
                <div class="page-body">
                    <div class="head">
                        <h3 style="margin-top:5px;">เพิ่มรายการสินค้าสำเร็จ</h3>
                        <!-- <h4>Lorem ipsum dolor sit amet</h4> -->
                    </div>

                    <h1 style="text-align:center;">
                        <div class="checkmark-circle">
                            <div class="background"></div>
                            <div class="checkmark draw"></div>
                        </div>
                        <h1>

                </div>
            </div>
        </div>
    </div>

    <!-- char modal -->
    <div class="modal fade" id="char" tabindex="-1" role="dialog" aria-labelledby="submitSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitSuccessModalLabel">Erorr</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="insert.php" method="POST">

                    <div class="modal-body">
                        <img src="https://100dayscss.com/codepen/alert.png" width="44" height="38" />
                        กรุณาใส่ชื่อและหน่วยโดยไม่ใช้ช่องว่างหรืออักขระพิเศษ
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- already modal -->
    <div class="modal fade" id="already" tabindex="-1" role="dialog" aria-labelledby="submitSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitSuccessModalLabel">Erorr</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="insert.php" method="POST">

                    <div class="modal-body">
                        <img src="https://100dayscss.com/codepen/alert.png" width="44" height="38" />
                        the name is alredy exit
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- additem modal -->
    <div class="modal fade" id="additem" tabindex="-1" role="dialog" aria-labelledby="submitSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitSuccessModalLabel">กรุณากรอกข้อมูล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="insertform" action="insert.php" method="POST" onsubmit="return validateForm()">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Name </label>
                            <input type="text" name="name" class="form-control" placeholder="กรุณาใส่ชื่อ">
                            <span id="nameError" class="error-message"></span>
                        </div>

                        <div class="form-group">
                            <label> Unit </label>
                            <input type="text" name="unit" class="form-control" placeholder="กรุณาใส่หน่วย">
                            <span id="unitError" class="error-message"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- add itemdata modal -->
    <div class="modal fade" id="additemdata" tabindex="-1" role="dialog" aria-labelledby="submitSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitSuccessModalLabel">กรุณากรอกข้อมูล</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <form action="insertitemdata.php" method="POST">

                    <div class="modal-body">
                        <?php
                        include 'connect.php';
                        $query_branch = "SELECT * FROM branch";
                        $branch = mysqli_query($connect, $query_branch);



                        while ($row = mysqli_fetch_assoc($branch)) {
                            $branchname = $row['branch_name'];
                            if ($branchname == 'soi17') {
                                $b = "17";
                            } elseif ($branchname == 'soi13') {
                                $b = "13";
                            }


                            echo '<div class="form-group">
                            <label>คงเหลือปัจจุบันซอย' . $b . '</label>
                            <input type="number" name="remain' . $b . '" class="form-control" placeholder="กรุณากรอกข้อมูล">
                            </div>';

                            echo '<div class="form-group">
                            <label>' . "ขั้นต่ำซอย" . $b . '</label>
                            <input type="number" name="min' . $b . '"  class="form-control" placeholder="กรุณากรอกข้อมูล">
                            </div>';




                            // echo "<a href='outstockmid.php?branch=$branchname'><button style='color: white;' class='custom-large-button btn custom-orange-sidebar btn-icon-split'>$branchname</button></a>";
                        }

                        // mysqli_close($connect);

                        ?>
                        <div class="form-group">
                            <label> ครัวกลางคงเหลือ </label>
                            <input type="number" name="remainmid" class="form-control" placeholder="ครัวกลางคงเหลือ">
                        </div>
                        <div class="form-group">
                            <label> ขั้นต่ำครัวกลาง </label>
                            <input type="number" name="minmid" class="form-control" placeholder="ขั้นต่ำครัวกลาง">
                        </div>

                        <input type="hidden" name="name" value="<?php echo $name; ?>">



                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button> -->
                        <button type="submit" name="insertitemdata" class="btn btn-primary">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">รายการสินค้า</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 font-weight-bold custom4">รายงานรายการสินค้า</h6>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#successall">Open Modal</button>
                </div>
                <div>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#additem">เพิ่มรายการสินค้า</button>
                </div>
            </div>

            <div class="card-body">
                <div id="alert_message"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="item_data" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ชื่อ</th>
                                <th>หน่วย</th>
                                <th>ลบ</th>
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
    function validateForm() {
        var specialChars = /[!@#$%^&*()+\-=\[\]{};':"\\|,.<>\/?]/;
        var nameInput = document.forms["insertform"]["name"].value;
        var unitInput = document.forms["insertform"]["unit"].value;
        var errorMessage = document.getElementById("nameError");
        var errorMessage2 = document.getElementById("unitError");
        if (nameInput == "") {
            errorMessage.innerHTML = "กรุณากรอกชื่อ!!!";
            return false;
        } else if (specialChars.test(nameInput)) {
            errorMessage.innerHTML = "ห้ามใช้อักษรพิเศษ!!!!";
            return false;
        } else {
            errorMessage.innerHTML = ""; // Clear the error message if input is not empty
        }
        if (unitInput == "") {
            errorMessage2.innerHTML = "กรุณากรอกหน่วย!!!";
            return false;
        } else if (specialChars.test(unitInput)) {
            errorMessage2.innerHTML = "ห้ามใช้อักษรพิเศษ!!!!";
            return false;
        } else {
            errorMessage2.innerHTML = ""; // Clear the error message if input is not empty
        }
        return true;
    }
    $(document).ready(function() {

        fetch_data();

        function fetch_data() {
            var dataTable = $('#item_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "datafetch.php",
                    type: "POST"
                }

            });
        }

        function update_data(id, column_name, value) {
            $.ajax({
                url: "update.php",
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

        $('#add').click(function() {
            var html = '<tr>';
            html += '<td contenteditable id="data1"></td>';
            html += '<td contenteditable id="data2"></td>';
            html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
            html += '</tr>';
            $('#item_data tbody').prepend(html);
        });


        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            if (confirm("Are you sure you want to remove this?")) {
                $.ajax({
                    url: "delete.php",
                    method: "POST",
                    data: {
                        id: id
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
        });
    });
</script>