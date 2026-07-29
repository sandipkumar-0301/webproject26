<?php
$reqPath = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
$segments = array_values(array_filter(explode('/', $reqPath), 'strlen'));
if (!empty($segments) && $segments[0] === 'mysite') {
    array_shift($segments);
}
$depth = count($segments) > 1 ? count($segments) - 1 : 0;
$basePath = $depth > 0 ? str_repeat('../', $depth) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Saifi Trust & Associates | Boutique IP Law Firm</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo $basePath; ?>assets/images/favicon.png">
    <link rel="shortcut icon" href="<?php echo $basePath; ?>assets/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo $basePath; ?>assets/images/favicon.png">
    <!-- Bootstrap 5 CSS + Icons + Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/itr-filing.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/responsive.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="<?php echo $basePath; ?>assets/js/saifi_custom.js"></script>
</head>
<body>

<!-- Navigation Bar (fully responsive) -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $basePath; ?>index"><i class="fa-solid fa-scale-balanced"></i><br/>Saifi Trust<br/><span>& Associates</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item"><a class="nav-link" href="<?php echo $basePath; ?>index">Home</a></li>                
                <li class="nav-item dropdown position-relative">
                    <div class="d-flex align-items-center">
                            <a class="nav-link" href="<?php echo $basePath; ?>services/services.php">
                            Services
                        </a>

                        <a class="nav-link dropdown-toggle dropdown-toggle-split"
                           href="#"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">
                        </a>
                    </div>

                    <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo $basePath; ?>services/ipr.php">IPR</a></li>
                        <li><a class="dropdown-item" href="<?php echo $basePath; ?>family-matters">Family Matters</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $basePath; ?>about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $basePath; ?>blog.php">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $basePath; ?>our-team.php">Our Team</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $basePath; ?>contact">Contact</a></li>
                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                    <a class="btn btn-accent btn-sm" href="<?php echo $basePath; ?>contact">Appointment</a>
                </li>
            </ul>
        </div>
    </div>
</nav>