<?php
session_start();

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>

    * {
        box-sizing: border-box;
    }

    body {
        background: #f1f5f9;
        font-family: Arial, sans-serif;
        color: #1e293b;
    }


    .navbar {
        background: #ffffff;
        padding: 18px 0;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    }

    .navbar-brand {
        color: #2563eb !important;
        font-size: 22px;
        font-weight: 800;
    }

    .nav-link {
        color: #475569 !important;
        font-weight: 600;
        margin-left: 15px;
    }

    .nav-link:hover {
        color: #2563eb !important;
    }

    .username {
        color: #334155;
        font-weight: 600;
    }

    .logout-btn {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        padding: 9px 17px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
    }

    .logout-btn:hover {
        background: #dc2626;
        color: white;
    }

    .container {
        max-width: 1150px;
    }

    .welcome-card {
        background: linear-gradient(135deg, #2563eb, #1e40af);
        color: white;
        border-radius: 18px;
        overflow: hidden;
        position: relative;
    }

    .welcome-card h1 {
        font-size: 32px;
        font-weight: 800;
    }

    .welcome-card p {
        color: #dbeafe;
    }

    .welcome-icon {
        font-size: 90px;
        opacity: 0.2;
    }

    .explore-btn {
        background: white;
        color: #2563eb;
        border: none;
        padding: 11px 22px;
        border-radius: 8px;
        font-weight: bold;
        transition: 0.3s;
    }

    .explore-btn:hover {
        background: #dbeafe;
        color: #1e40af;
    }

    /* SECTION TITLE */

    .section-title {
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 22px;
    }

    /* DASHBOARD CARDS */

    .dashboard-card {
        background: white;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        transition: 0.3s;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .card-body {
        padding: 25px;
    }

    .card-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        margin-bottom: 18px;
    }

    .icon-green {
        background: #dcfce7;
        color: #16a34a;
    }

    .icon-blue {
        background: #dbeafe;
        color: #2563eb;
    }

    .icon-yellow {
        background: #fef3c7;
        color: #d97706;
    }

    .card-title {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .card-text {
        font-size: 13px;
        color: #64748b;
        line-height: 1.7;
    }

    .session-id {
        word-break: break-all;
        background: #f1f5f9;
        padding: 9px;
        border-radius: 7px;
        color: #2563eb;
    }

    /* FOOTER */

    footer {
        text-align: center;
        padding: 30px 10px;
        color: #94a3b8;
        font-size: 13px;
    }

    @media (max-width: 768px) {

        .welcome-card h1 {
            font-size: 25px;
        }

        .welcome-icon {
            display: none;
        }

        .navbar {
            padding: 14px 0;
        }

        .navbar-brand {
            font-size: 17px;
        }

        .username {
            display: none;
        }
    }

</style>
</head>

<body>

<nav class="navbar navbar-expand">
    <div class="container">

        <a class="navbar-brand" href="dashboard.php">
            <i class="bi bi-shield-lock-fill me-2"></i>
            SessionAuthSystem
        </a>

        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link active" href="dashboard.php">
                    <i class="bi bi-grid-fill me-1"></i>
                    Dashboard
                </a>
            </li>
        </ul>

        <div class="d-flex align-items-center gap-3">

            <span class="username">
                <i class="bi bi-person-circle me-1"></i>
                <?= htmlspecialchars($_SESSION['username']) ?>
            </span>

            <a href="logout.php" class="logout-btn">
                <i class="bi bi-box-arrow-right me-1"></i>
                Logout
            </a>

        </div>

    </div>
</nav>


<div class="container py-5">

    <div class="card border-0 welcome-card shadow-sm mb-5">

        <div class="card-body p-5">

            <div class="row align-items-center">

                <div class="col-md-9">

                    <p class="text-uppercase fw-bold small mb-2">
                        Dashboard Overview
                    </p>

                    <h1>
                        Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!
                    </h1>

                    <p class="mb-4">
                        This page is protected and only visible to logged-in users.
                    </p>

                    <a href="#details" class="btn explore-btn">
                        Explore Dashboard
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>

                </div>

                <div class="col-md-3 text-center">
                    <i class="bi bi-person-workspace welcome-icon"></i>
                </div>

            </div>

        </div>

    </div>

    <h4 class="section-title" id="details">
        <i class="bi bi-grid me-2 text-primary"></i>
        Account Information
    </h4>


    <div class="row g-4">

        <div class="col-md-4">

            <div class="card dashboard-card h-100">

                <div class="card-body">

                    <div class="card-icon icon-green">
                        <i class="bi bi-shield-check"></i>
                    </div>

                    <h6 class="card-title">
                        Account Status
                    </h6>

                    <span class="badge bg-success mb-3">
                        Active
                    </span>

                    <p class="card-text">
                        Your session is active and protected against Session Fixation using
                        <code>session_regenerate_id(true)</code>.
                    </p>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card dashboard-card h-100">

                <div class="card-body">

                    <div class="card-icon icon-blue">
                        <i class="bi bi-person-badge"></i>
                    </div>

                    <h6 class="card-title">
                        User Details
                    </h6>

                    <p class="card-text mb-2">
                        <strong>User ID:</strong>
                        <?= (int)$_SESSION['user_id'] ?>
                    </p>

                    <p class="card-text mb-0">
                        <strong>Username:</strong>
                        <?= htmlspecialchars($_SESSION['username']) ?>
                    </p>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card dashboard-card h-100">

                <div class="card-body">

                    <div class="card-icon icon-yellow">
                        <i class="bi bi-key"></i>
                    </div>

                    <h6 class="card-title">
                        Active Session ID
                    </h6>

                    <p class="card-text mb-2">
                        <strong>Current Session ID:</strong>
                    </p>

                    <code class="session-id d-block mb-3">
                        <?= htmlspecialchars(session_id()) ?>
                    </code>

                    <p class="card-text mb-0">
                        Generated after login call to
                        <code>session_regenerate_id(true)</code>.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


<footer>
    <p class="mb-0">
        &copy; <?= date('Y') ?> SessionAuthSystem. All Rights Reserved.
    </p>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
window.addEventListener('pageshow', function (e) {
    if (e.persisted) location.reload();
});
</script>

</body>
</html>