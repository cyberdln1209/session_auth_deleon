<?php
session_start();
require 'db.php';

if (isset($_SESSION['user_id'])) { header('Location: dashboard.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (strlen($username) < 3)       $error = 'Username must be at least 3 characters.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error = 'Please enter a valid email.';
    elseif (strlen($password) < 6)   $error = 'Password must be at least 6 characters.';
    else {
        $check = $pdo->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
        $check->execute([$username, $email]);
        if ($check->fetch()) {
            $error = 'Username or email already taken.';
        } else {
            $ins = $pdo->prepare('INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)');
            $ins->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);
            header('Location: index.php?registered=1');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Create Account</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(135deg, #dbeafe, #eff6ff, #f8fafc);
        font-family: Arial, sans-serif;
    }

    .register-card {
        width: 100%;
        max-width: 420px;
        background: white;
        border: none;
        border-radius: 18px;
        padding: 35px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
    }

    .register-icon {
        width: 65px;
        height: 65px;
        background: #dbeafe;
        color: #2563eb;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 18px;
    }

    .form-control {
        padding: 12px;
        border-radius: 9px;
        border: 1px solid #d1d5db;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .form-label {
        font-weight: 600;
        color: #374151;
    }

    .btn-register {
        background: #2563eb;
        color: white;
        padding: 12px;
        border-radius: 9px;
        font-weight: bold;
        border: none;
        transition: 0.3s;
    }

    .btn-register:hover {
        background: #1d4ed8;
        color: white;
        transform: translateY(-2px);
    }

    .login-link {
        color: #2563eb;
        text-decoration: none;
        font-weight: bold;
    }

    .login-link:hover {
        text-decoration: underline;
    }

    .subtitle {
        color: #64748b;
        font-size: 14px;
    }
</style>
</head>

<body>

<div class="container min-vh-100 d-flex align-items-center justify-content-center py-4">

    <div class="card register-card">

        <div class="register-icon">
            &#128100;
        </div>

        <h3 class="text-center fw-bold mb-2">Create Account</h3>

        <p class="text-center subtitle mb-4">
            Register to get started
        </p>

        <?php if ($error): ?>
            <div class="alert alert-danger py-2">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post" autocomplete="off">

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username"
                       class="form-control"
                       placeholder="Enter your username"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email"
                       class="form-control"
                       placeholder="Enter your email"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                       class="form-control"
                       placeholder="Enter your password"
                       required>
            </div>

            <button type="submit" class="btn btn-register w-100">
                Create Account
            </button>

        </form>

        <p class="text-center mt-4 mb-0 text-secondary">
            Already have an account?
            <a href="index.php" class="login-link">Login</a>
        </p>

    </div>

</div>

</body>
</html>
