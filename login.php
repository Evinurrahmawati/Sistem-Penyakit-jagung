<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="admin/style.css">
    <link rel="shortcut icon" href="assets/logo.png" />
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 400px;
        }

        .login-title {
            font-size: 24px;
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
        }

        .login-btn {
            width: 100%;
            padding: 12px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <center>
        <img src="assets/logo.png" alt="Logo" width="150">
            </center>
            <h2 class="login-title">Login Admin</h2>
            <form action="admin/process_login.php" method="POST">
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" required class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" required class="form-input">
                </div>
                <button type="submit" class="btn btn-primary login-btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html>