<?php 
// * scolaricx
//  *
//  * An open source application development framework for PHP
//  *
//  * This content is released under the MIT License (MIT)
//  *
//  * Copyright (c) 2002 - 2022, Personnal project
//  *
//  * Permission is hereby granted, free of charge, to any person obtaining a copy
//  * of this software and associated documentation files (the "Software"), to deal
//  * in the Software without restriction, including without limitation the rights
//  * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
//  * copies of the Software, and to permit persons to whom the Software is
//  * furnished to do so, subject to the following conditions:
//  *
//  * The above copyright notice and this permission notice shall be included in
//  * all copies or substantial portions of the Software.
//  *
//  * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
//  * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
//  * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
//  * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
//  * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
//  * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
//  * THE SOFTWARE.
//  *
//  * @package	scolaricx
//  * @author	carelii dev
//  * @copyright	Copyright (c) 2020 - 2022, Carleii, Inc. (https://github.com/carleii)
//  * @license	http://opensource.org/licenses/MIT	MIT License
//  * @link	http://scolaricx.lescigales.org/
//  * @since	Version 1.0.0
//  * @filesource
//  */
?><?php 
require 'classe_package.php';
include 'database_connection.php';
require_once 'function.php';


if (isset($_GET['ktsp'])) {
session_start();
session_unset();
session_destroy();
// Suppression du cookie designPrefere
setcookie('user_cookie');
// Suppression de la valeur du tableau $_COOKIE
unset($_COOKIE['user_cookie']);
// code...
}


//VERIFY IF THE COOKIE EXIST EITHER GO TO HOME PAGE
if (isset($_COOKIE['user_cookie'])) {
header("Location: index.php");
# code...
}

$start = microtime(true);
// getcache("loginview.php");
?>
<?php
// CONNECTING TREATMENT
if (isset($_POST["connect"])) {
    $user_email =get_safe_input($_POST["user_email"]);
    $user_pssw =get_safe_input(base64_encode($_POST["user_pssw"]));
    $date_academique =($_POST["date_academique"]);
    $user = new user;
    //SEND THE USER CONNECTION REQUEST
    $result = $user->user_connection($user_pssw, $user_email, $date_academique);
    switch ($result) {
        case 'user_not_found':
?>
<div id="toast-container" class="toast-container toast-top-right">
    <div class="toast toast-warning" aria-live="assertive" style="display: block; opacity: 0.732461;">
        <div class="toast-progress" style="width: 0%;"></div>
        <div class="toast-title">Warning</div>
        <div class="toast-message">User not found! Verify The pasword and the Username !</div>
    </div>
</div>
<?php
            # code...
            break;
        case 'school_not_found':
            $user_email = base64_encode($user_email);
        ?>
<div id="toast-container" class="toast-container toast-top-right">
    <div class="toast toast-warning" aria-live="assertive" style="display: block; opacity: 0.732461;">
        <div class="toast-progress" style="width: 0%;"></div>
        <div class="toast-title">Warning</div>
        <div class="toast-message">School not found! <em>Doen't have a school?
                <a href="auth-register-school.php?kpjsc=<?php echo $user_email ?>"><i><span
                            style="color : black;"><u>Add your school here</u></span></i></a></em></div>
    </div>
</div>
<?php
            # code...
            break;

        default:

            if ($result == false) {
            ?>
<div id="toast-container" class="toast-container toast-top-right">
    <div class="toast toast-info" aria-live="assertive" style="display: block; opacity: 0.732461;">
        <div class="toast-progress" style="width: 0%;"></div>
        <div class="toast-title">Info</div>
        <div class="toast-message">There is a problem with this account! we are already fixing it! please wait while.
        </div>
    </div>
</div>
<?php
                # code...
            } elseif ($result == true) {
                //SET COOKIE
                $cookie = new cookie_session($date_academique, $user_email);

                //GET THE PLAFORM USER
                header("Location: index.php");
                # code...
                //CREATION OF THE ACTIVE USER SESSION

                # code...
}

break;
}
}
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <title>Login <?php include 'site_title.php'; ?> </title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/toastr.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->
    <!-- MANIFEST  -->
    <link rel="manifest" href="manifest.json">


</head>
<!-- END: Head-->
<!-- BEGIN: Body-->

<body
    class="vertical-layout vertical-menu-modern dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page"
    data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- login page start -->
                <section id="auth-login" class="row flexbox-container">
                    <div class="col-xl-8 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-md-6 col-12 px-0">
                                    <div
                                        class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Welcome Back</h4>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form method="POST">
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600" autofill for="user_email">User Name
                                                            or Email</label>
                                                        <input type="text" class="form-control" id="user_email"
                                                            name="user_email" placeholder="Nom d'utilisateur"
                                                            required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-bold-600" for="user_pssw">Password</label>
                                                        <input type="password" class="form-control" id="user_pssw"
                                                            name="user_pssw" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-bold-600" for="date_academique">Date
                                                            academique</label>
                                                        <input type="text" class="form-control" id="date_academique"
                                                            name="date_academique" placeholder="Date academique"
                                                            required="">
                                                    </div>
                                                    <button type="submit" name="connect"
                                                        class="btn btn-primary glow w-100 position-relative">Login<i
                                                            id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                    <!-- <center>Or</center> -->
                                                </form>
                                                <br>
                                                <span>
                                                    Create a new school here
                                                </span>
                                                <a href="auth-register.php"> Register<i id="icon-arrow"
                                                        class="bx bx-right-arrow-alt"></i>
                                                </a>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- right section image -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <div class="card-content">
                                        <img class="img-fluid" src="app-assets/images/pages/login.png"
                                            alt="branding logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <iframe src="./online.html" width="900px" frameborder="0" style="overflow:hidden"
                        scrolling="no"></iframe>
                </section>
                <!-- login page ends -->
            </div>
        </div>

    </div>

    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <script src="app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <script src="app-assets/js/scripts/components.js"></script>
    <script src="app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/extensions/toastr.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html><?="Execution time: ".round(microtime(true)- $start, 3);?>