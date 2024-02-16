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
<style>
    .button-container {
    display: flex;
    gap: 10px; /* Adjust the gap value as needed */}
    .custom-card-height {
    height: 400px; /* Adjust the height value as needed */
}
.custom-large-button {
    font-size: 28px; /* Adjust the font size as needed */
    padding: 5px 10px; /* Adjust the padding as needed */
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
                                $conn = mysqli_connect("localhost", "root", "", "tttstock");
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $query = "SELECT * FROM branch";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $branchname = $row['branch_name'];

                                    echo "<a href='outstockmid.php?branch=$branchname'><button style='color: white;' class='custom-large-button btn custom-orange-sidebar btn-icon-split'>$branchname</button></a>";

                                }

                                mysqli_close($conn);
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