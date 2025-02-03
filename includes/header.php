<?php include("includes/function.php"); ?>
<?php
if(!isset($_SESSION['LoggedInUser'])){
  $_SESSION['warning'] = "Please login to Procced";
  echo "<script>window.open('index.php', '_self')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Blue River</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/blueriverlogo.png" />
  <!-- using alertify js message -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  
</head>
<style>
  .nav-item.active{
    background:#85c1e9;
  }
  .mess {
    display: block;
  }

  .loading {
    position: fixed;
    top: 0;
    left: 0;
    background: black;
    z-index: 1000 !important;
    opacity: 0.5;
    filter: alpha(opacity=80);
    min-height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .center {
    position: relative;
  }

  .dot {
    width: 100px;
    height: 100px;
    border-radius: 50%;
  }

  .small {
    padding: 10px;
    border-top: 1px solid transparent;
    border-right: 1px solid transparent;
    border-bottom: 6px solid white;
    border-left: 6px solid white;
    border-radius: 50%;
    animation: small 2s linear infinite;
  }

  .large {
    padding: 10px;
    border-top: 1px solid transparent;
    border-right: 1px solid transparent;
    border-bottom: 4px solid #00b0f0;
    border-left: 4px solid #00b0f0;
    border-radius: 50%;
    animation: large 3s linear infinite;
  }

  .medium {
    padding: 10px;
    border-top: 4px solid #1f3864;
    border-right: 4px solid #1f3864;
    border-bottom: 2px solid transparent;
    border-left: 2px solid transparent;
    border-radius: 50%;
    animation: medium 2s linear infinite;
  }

  @keyframes small {
    0% {
      transform: rotate(720deg);
    }
    100% {
      transform: rotate(0deg);
    }
  }

  @keyframes medium {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(720deg);
    }
  }

  @keyframes large {
    0% {
      transform: rotate(360deg);
    }
    100% {
      transform: rotate(0deg);
    }
  }

  @media (max-width: 678px) {
    .mess {
      display: none;
    }
    .my-chart{
      width:140px;
      height:140px;
    }
  }
</style>

<body>
<?php
$userPIN = $_SESSION['LoggedInUser']['pin'];
if (isset($_SESSION["success"])) {
    ?>
    <script type="text/javascript">
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<?= $_SESSION["success"] ?>');
    </script>
    <?php
    // Clear the session message after displaying it
    unset($_SESSION["success"]);
}
// Danger message
if (isset($_SESSION["danger"])) {
    ?>
    <script type="text/javascript">
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('<?= $_SESSION["danger"] ?>');
    </script>
    <?php
    unset($_SESSION["danger"]);
}
// Warning message
if (isset($_SESSION["warning"])) {
    ?>
    <script type="text/javascript">
        alertify.set('notifier', 'position', 'top-right');
        alertify.warning('<?= $_SESSION["warning"] ?>');
    </script>
    <?php
    unset($_SESSION["warning"]);
}
?>
  <div class="loading" id="divLoader">
    <div class="center">
      <div class="large">
        <div class="medium">
          <div class="small">
            <img src="images/blueriverlogo.png" class="dot" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const loader = document.getElementById("divLoader");
    //loader.style.display = "flex"; // Show the loader immediately

    // Hide the loader when the page is fully loaded and all tasks are done
    window.addEventListener("load", function () {
      loader.style.display = "none"; // Hide loader after the page is fully loaded
    });
    // Example: Simulate some additional tasks (e.g., API calls or heavy calculations)
    document.addEventListener("DOMContentLoaded", function () {
      setTimeout(() => {
        // Simulating a delay to mimic heavy tasks
        console.log("Executing some tasks...");
        loader.style.display = "none"; // Hide the loader once tasks are complete
      }, 2000); // Simulate 2 seconds of work
    });
    // Show the loader during a page reload
    // window.addEventListener("beforeunload", function () {
    //   loader.style.display = "flex"; // Show the loader when navigating away or reloading
    // });
  </script>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
     <?php include("includes/navbar.php"); ?>
     <!-- partial -->
     <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
         <?php include("includes/sidebar.php"); ?>
         <!-- partial -->
         <div class="main-panel">
         <div class="content-wrapper" style="background-color:#85c1e9">