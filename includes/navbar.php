<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
        <a class="navbar-brand brand-logo" href="Dashboard.php"><p class="fw-bold"style="font-size:37px;color:#1f3864">Blue<b style="color:#00b0f0">River</b></p></a>
        <a class="navbar-brand brand-logo-mini" href="Dashboard.php"><img src="images/blueriverlogo.png" alt="logo"/></a>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-sort-variant"></span>
        </button>
    </div>  
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <?php
          $getDate = date("Y-m-d");
          $newform = date("d M, Y", strtotime($getDate));
        ?>

    <p class="mess" style="font-size:20px">Welcome To Blue River, <?= $_SESSION['LoggedInUser']['gns']?>. <?= $_SESSION['LoggedInUser']['firstname']?> | today is <?= $newform?></p>
    
    <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown me-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-message-text mx-0"></i>
                <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/messageIcon.png" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                    <h6 class="ellipsis font-weight-normal">David Grey
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                    </p>
                </div>
                </a>
                <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/messageIcon.png" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                    <h6 class="ellipsis font-weight-normal">Tim Cook
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                    </p>
                </div>
                </a>
                <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/messageIcon.png" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                    <h6 class="ellipsis font-weight-normal"> Johnson
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                    </p>
                </div>
                </a>
            </div>
        </li>
        <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                <img src="images/userIcon.png" alt="profile"/>
                <span class="nav-profile-name"><?= $_SESSION['LoggedInUser']['firstname'] .' '. $_SESSION['LoggedInUser']['lastname'] ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item">Careers</a>
                <a class="dropdown-item">Search Jobs</a>
                <a class="dropdown-item">My Applications</a>
                <a class="dropdown-item">My Favorities</a>
                <a class="dropdown-item">My Saved Searches</a>
                <a class="dropdown-item">My Account Information</a>
                <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
                </a>
                <a href="logout.php" class="dropdown-item">
                <i class="mdi mdi-logout text-primary"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
    </button>
    </div>
</nav>