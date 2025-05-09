    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-menu">
                        <div class="logo">
                            <a href="./index.html">
                                <img src="img/logo.gif" alt="">
                            </a>
                        </div>
                        <nav class="mobile-menu">
                            <ul>
                                <li><a href="./index.php">Home</a></li>
                                <li><a href="./about-us.php">About us</a></li>
                                <li><a href="./Plans.php">PLANS</a></li>
                                <li><a href="./Trainers.php">MY WORKOUTS</a></li>
                                <li><a href="./Progress.php">PROGRESS</a></li>
                                <li><a href="./contact.php">Contact</a></li>
                                <li class="search-btn search-trigger"><i class="fa fa-search"></i></li>

                                 <!-- Show Logout if logged in, otherwise show Login -->
                                 <?php if (isset($_SESSION["user_id"])): ?>
                                 <li><a href="php/logout.php" class="mobile-menu">Logout</a></li>
                             <?php else: ?>
                                 <li><a href="Login.html" class="mobile-menu">Login</a></li>
                             <?php endif; ?>
                            </ul>
                        </nav>
                        <div id="mobile-menu-wrap"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->