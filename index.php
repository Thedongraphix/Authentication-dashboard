<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Frontend Task</title>
</head>
<body>

<!-- Display Message -->
<?php
if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    echo "<div class='message'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}
?>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">
            <a href="#">Thedongraphix</a>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item"><a href="#">Home</a></li>
            <li class="nav-item"><a href="#">About</a></li>
            <li class="nav-item"><a href="#">Contact</a></li>
            <li class="nav-item"><a href="#">Help</a></li>
        </ul>
        <button class="menu-toggle" id="menu-toggle">
            <span class="hamburger">&#9776;</span>
            <span class="close" style="display: none;">&times;</span>
        </button>
        <div class="dropdown-menu" id="dropdown-menu">
            <a href="#" class="dropdown-item">Home</a>
            <a href="#" class="dropdown-item">About</a>
            <a href="#" class="dropdown-item">Contact</a>
            <a href="#" class="dropdown-item">Help</a>
        </div>
    </nav>
    <!--Login-->
    <div class="form-container" id="login-form">
        <div class="login-header">
            <header>Login</header>
        </div>
        <form action="connect.php" method="POST">
            <div class="input-box">
                <input type="text" name="email" class="input-field" placeholder="Email" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" class="input-field" placeholder="Password" autocomplete="off" required>
            </div>
            <div class="forgot">
                <section>
                    <a href="#">Forgot password</a>
                </section>
            </div>
            <div class="input-submit">
                <button class="signin-btn" id="submit-login"></button>
                <label for="submit-login">Sign In</label>
            </div>
            <div class="sign-up-link">
                <p>Don't have an account? <a href="#" id="show-signup">Sign Up</a></p>
            </div>
        </form>
    </div>
    <!--Sign Up-->
    <div class="form-container" id="signup-form" style="display: none;">
        <div class="login-header">
            <header>Sign Up</header>
        </div>
        <form action="connect.php" method="POST">
            <div class="input-box">
                <input type="text" name="username" class="input-field" placeholder="Username" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="email" name="email" class="input-field" placeholder="Email" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" class="input-field" placeholder="Password" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" name="cpassword" class="input-field" placeholder="Confirm Password" autocomplete="off" required>
            </div>
            <div class="forgot">
                <section>
                    <input type="checkbox" id="check-signup">
                    <label for="check-signup">Remember me</label>
                </section>
                <section>
                    <a href="#">Forgot password</a>
                </section>
            </div>
            <div class="input-submit">
                <button class="signup-btn" id="submit-signup"></button>
                <label for="submit-signup">Sign Up</label>
            </div> 
            <div class="sign-up-link">
                <p>Already have an account? <a href="#" id="show-login">Log In</a></p>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
