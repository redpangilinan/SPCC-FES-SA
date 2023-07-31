<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

<div id="nav-core">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div><i class="fa-solid fa-user px-2"></i><?php echo $_SESSION['fullname'] ?></div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo"> <i class='bx bxs-school nav_logo-icon'></i> <span class="nav_logo-name">SPCC Caloocan</span> </a>
                <div class="nav_list">
                    <?php
                    if ($_SESSION['user_type'] == 'admin') {
                    ?>
                        <a href="./dashboard.php" class="nav_link <?php echo (strpos($_SERVER['REQUEST_URI'], 'dashboard.php') !== false) ? 'active' : ''; ?>">
                            <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                        <a href="./users.php" class="nav_link <?php echo (strpos($_SERVER['REQUEST_URI'], 'users.php') !== false) ? 'active' : ''; ?>">
                            <i class='bx bx-group nav_icon'></i>
                            <span class="nav_name">Users</span>
                        </a>
                        <a href="./student_list.php" class="nav_link <?php echo (strpos($_SERVER['REQUEST_URI'], 'student_list.php') !== false) ? 'active' : ''; ?>">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Student List</span>
                        </a>
                        <a href="./categories.php" class="nav_link <?php echo (strpos($_SERVER['REQUEST_URI'], 'categories.php') !== false) ? 'active' : ''; ?>">
                            <i class='bx bx-message-square-detail nav_icon'></i>
                            <span class="nav_name">Categories</span>
                        </a>
                        <a href="./questions.php" class="nav_link <?php echo (strpos($_SERVER['REQUEST_URI'], 'questions.php') !== false) ? 'active' : ''; ?>">
                            <i class='bx bx-question-mark nav_icon'></i>
                            <span class="nav_name">Questions</span>
                        </a>
                        <a href="./evaluations.php" class="nav_link <?php echo (strpos($_SERVER['REQUEST_URI'], 'evaluations.php') !== false) ? 'active' : ''; ?>">
                            <i class='bx bx-check-double nav_icon'></i>
                            <span class="nav_name">Evaluations</span>
                        </a>
                    <?php
                    } else if ($_SESSION['user_type'] == 'student') {
                    ?>
                        <a href="../../index.php" class="nav_link active">
                            <i class='bx bx-message-dots nav_icon'></i>
                            <span class="nav_name">Evaluate</span>
                        </a>
                    <?php
                    } else if ($_SESSION['user_type'] == 'faculty') {
                    ?>
                        <a href="./faculty.php" class="nav_link active">
                            <i class='bx bx-lock-open-alt nav_icon'></i>
                            <span class="nav_name">Access Code</span>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <a href="?logout" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sign out</span> </a>
        </nav>
    </div>
</div>


<script src="../../public/js/navbar.js"></script>