<?php
// We need to use sessions, so you should always start sessions using the below code.
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: index.html');
  exit;
}
?>
<style>
  .custom-orange-sidebar {
    background-color: #A0522D
      /* Replace with your desired color value */
  }

  .custom2 {
    background-color: #B19470
      /* Replace with your desired color value */
  }

  .custom3 {
    background-color: #F8FAE5
      /* Replace with your desired color value */
  }

  /* If you want to keep the text color white on the sidebar, you can add the following style */
  .custom-orange-sidebar .nav-link {
    color: #F8FAE5;
  }

  .b {
    color: black
  }
</style>
<!-- Sidebar -->
<ul class="navbar-nav custom-orange-sidebar sidebar sidebar-dark accordion " id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="homes.php">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Tong <sup>Stock</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="homes.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>หน้าหลัก</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    ADMIN

  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>ครัวกลาง</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Pick the Action:</h6>
        <a class="collapse-item" href="addmid.php">เพิ่มเข้าครัวกลาง</a>
        <a class="collapse-item" href="senditem.php">ส่งไปสาขาต่างๆ</a>
      </div>
    </div>
  </li>



  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>จัดการข้อมูล</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Pick the Action:</h6>
        <a class="collapse-item" href="branch.php">สาขา</a>
        <a class="collapse-item" href="item.php">สินค้า</a>
      </div>
    </div>
  </li>



  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-wrench"></i>
      <span>สต็อก</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">SelectBranch:</h6>
        <a class="collapse-item" href="stock17.php">ซอย17</a>
        <a class="collapse-item" href="stock13.php">ซอย13</a>
       
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    รายงาน
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsestock" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span>ข้อมูลสต็อก</span>
    </a>
    <div id="collapsestock" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Select:</h6>
        <a class="collapse-item" href="Reportmid.php">ครัวกลาง</a>
        <a class="collapse-item" href="report13.php">ซอย13</a>
        <a class="collapse-item" href="report17.php">ซอย17</a>
        <div class="collapse-divider"></div>
        
      </div>
    </div>
  </li>

  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span>รายการสินค้าที่ต้องสั่งเพิ่ม</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Select:</h6>
        <a class="collapse-item" href="omid.php">ครัวกลาง</a>
        <a class="collapse-item" href="o13.php">ซอย13</a>
        <a class="collapse-item" href="o17.php">ซอย17</a>
        <div class="collapse-divider"></div>
       
      </div>
    </div>
  </li>



  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="history.php">
      <i class="fas fa-fw fa-table"></i>
      <span>ประวัติ</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light custom2 topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 custom3">
        <i class="fa fa-bars b "></i>
      </button>



      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">

              <span style="color: white;"><?php echo $_SESSION['name']; ?></span>


            </span>
            <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="logout.php">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
            
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

            <form action="logout.php" method="POST">

              <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

            </form>


          </div>
        </div>
      </div>
    </div>