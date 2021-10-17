<?php
session_start();
if (empty($_SESSION["user"])) {
    header("location:login.php");
} else {
    $user = $_SESSION["user"];
}
$lang = "en";
if (!empty($_SESSION["lang"])) {
    $lang = $_SESSION["lang"];
}
if (isset($_SESSION["lang"]) && $_SESSION["lang"] == "ar") require_once("messages_ar.php");
else require_once("messages_en.php");

require_once("header.php");

?>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">
                <h1><?= $masseges["ELGADED"] ?></h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><img src="assets/images/testi-1.jpg" alt="user_photo" class="mx-2" style="width: 50px;"></li>
                    <li class="nav-item">
                        <h6 class="nav-link text-white "><?=$user['name'];?></h6>
                    </li>
                    <li class="nav-item"><a class="nav-link active p-2 mx-2" aria-current="page" href="#">
                            <h6><?= $masseges["Home"] ?></h6>
                        </a></li>
                    <li class="nav-item"><a class="badge bg-info text-decoration-none link-light  " href="logout.php">
                            <h6><?= $masseges["LOG OUT"] ?></h6>
                        </a></li>
                </ul>
            </div>
        </div>
    </nav>
   