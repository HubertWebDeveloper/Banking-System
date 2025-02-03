<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1);
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color:#1f3864">
    <ul class="nav">
        <li class="nav-item <?= $page == 'Dashboard.php' ? 'active':''; ?>">
            <a class="nav-link" href="Dashboard.php">
                <i class="mdi mdi-home menu-icon text-white"></i>
                <span class="menu-title text-white">Overview</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="budget.php">
                <i class="mdi mdi-attachment  menu-icon text-white"></i>
                <span class="menu-title text-white">My Budget/Plan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="debitManagement.php">
                <i class="mdi mdi-cash-multiple  menu-icon text-white"></i>
                <span class="menu-title text-white">Debt Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="creditManagement.php">
                <i class="mdi mdi-cash-multiple  menu-icon text-white"></i>
                <span class="menu-title text-white">Credit Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="assetsManagement.php">
                <i class="mdi mdi-wallet-travel  menu-icon text-white"></i>
                <span class="menu-title text-white">Assets Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="property.php">
                <i class="mdi mdi-case-sensitive-alt  menu-icon text-white"></i>
                <span class="menu-title text-white">Properties/Business</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="mdi mdi-file-word  menu-icon text-white"></i>
                <span class="menu-title text-white">My Reports</span>
            </a>
        </li>
        
    </ul>
</nav>