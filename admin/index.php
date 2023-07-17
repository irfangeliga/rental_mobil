<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo ("<script>location.href = 'login.php';</script>");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Admin</title>

    <link rel="stylesheet" href="../assets/admin/css/main/app.css" />
    <link rel="stylesheet" href="../assets/admin/css/main/app-dark.css" />
    <link rel="shortcut icon" href="../assets/admin/images/logo/favicon.svg" type="image/x-icon" />
    <link rel="shortcut icon" href="../assets/admin/images/logo/favicon.png" type="image/png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- table -->
    <link
      rel="stylesheet" href="../assets/admin/extensions/simple-datatables/style.css"/>
    <link rel="stylesheet" href="../assets/admin/css/pages/simple-datatables.css" />

    <link rel="stylesheet" href="../assets/admin/css/shared/iconly.css" />
</head>
<style>
    @media print{
    #main {
        margin-left: 0px;
        padding:0px;
        }
    }

    .loader {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row;
    }

    .slider {
    overflow: hidden;
    background-color: white;
    margin: 0 15px;
    height: 80px;
    width: 20px;
    border-radius: 30px;
    box-shadow: 15px 15px 20px rgba(0, 0, 0, 0.1), -15px -15px 30px #fff,
        inset -5px -5px 10px rgba(0, 0, 255, 0.1),
        inset 5px 5px 10px rgba(0, 0, 0, 0.1);
    position: relative;
    }

    .slider::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    border-radius: 100%;
    box-shadow: inset 0px 0px 0px rgba(0, 0, 0, 0.3), 0px 420px 0 400px #2697f3,
        inset 0px 0px 0px rgba(0, 0, 0, 0.1);
    animation: animate_2 2.5s ease-in-out infinite;
    animation-delay: calc(-0.5s * var(--i));
    }

    @keyframes animate_2 {
        0% {
            transform: translateY(250px);
            filter: hue-rotate(0deg);
        }

        50% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(250px);
            filter: hue-rotate(180deg);
        }
    }
</style>
<body >
    <script src="assets/js/initTheme.js"></script>
    <div id="app" class=" d-print-none">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active border border-2 border-light">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <h4><a href="?url=dashboard">Rental Mobil</a></h4>
                            <!--<a href="index.php"><img src="../../assets/images/logo/logo.svg" alt="Logo" srcset="" /></a>-->
                        </div>
                        <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input me-0" type="checkbox" id="toggle-dark"
                                    style="cursor: pointer" />
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler x" style="z-index:1000;">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu ">
                    <ul class="menu">
                        <li class="sidebar-item">
                            <a href="?url=data-mobil" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Data Mobil</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="../logout.php" class="sidebar-link">
                                <i class="bi bi-box-arrow-up-right"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="main" class="bg-light" >
        <header class="mb-3 ">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <?php include_once('navigator.php') ?>
    </div>
    <script src="../assets/admin/js/bootstrap.js"></script>
    <script src="../assets/admin/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="../assets/admin/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/admin/js/pages/dashboard.js"></script>

    <!-- data table -->
    <script src="../assets/admin/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="../assets/admin/js/pages/simple-datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>