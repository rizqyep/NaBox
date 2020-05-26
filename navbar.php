<style>
    #mainNavbar {
        background-color: #263238;
    }
</style>
<nav id="mainNavbar" class="navbar navbar-dark bg-dark navbar-expand-md" style="padding : 10px">
    <a class=" navbar-brand" href="index.php" style="font-size : 24px;font-weight : 400"> NaBox</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-label="toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto" style="font-size : 18px;font-weight : 300">

            <?php
            if (isset($_SESSION['user'])) {

                echo " <li class='nav-item'><a class='nav-link' href='logout.php'>LOGOUT</a></li>";
            } else {
                echo " <li class='nav-item'>
                    <a class='nav-link' href='login.php'>LOGIN</a>
                </li>";
                echo " <li class='nav-item'>
                <a class='nav-link' href='register.php'>REGISTRASI</a>
                </li>";
            }
            ?>
        </ul>
    </div>
</nav>