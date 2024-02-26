<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
include('includes/header.php');
include('includes/navbar.php');
?>
<style>
    .button-container {
    display: flex;
    gap: 10px; 
    height: 400px; 
}
.custom-large-button {
    font-size: 28px; 
    padding: 5px 10px; 
}


</style>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">เลือกสาขา</h1>
    </div>

    <div class="col-xl-20 col-md-20 mb-9">
        <div class="card  shadow custom-card-height py-2">
            <div class="card-body ">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold custom4 text-uppercase mb-1">เลือกสาขา</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                            <div class="button-container">
                                <?php
                                include 'connect.php';

                                $query = "SELECT * FROM branch";
                                $result = mysqli_query($connect, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $branchname = $row['branch_name'];

                                    echo "<a href='outstockmid.php?branch=$branchname'><button style='color: white;' class='custom-large-button btn custom-orange-sidebar btn-icon-split'>$branchname</button></a>";

                                }

                                mysqli_close($connect);
                                ?>
                            </div>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas  fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>