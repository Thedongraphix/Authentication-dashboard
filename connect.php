<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "userdatabase";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'])) {
        // Sign Up Process
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if ($password !== $cpassword) {
            $_SESSION['message'] = "Passwords do not match!";
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $_SESSION['message'] = "Error: Email is already registered. Please use a different email.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $email, $hashed_password);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "Sign Up successful!";
                } else {
                    $_SESSION['message'] = "Error: " . $stmt->error;
                }
            }
            $stmt->close();
        }
    } elseif (isset($_POST['email']) && isset($_POST['password'])) {
        // Login Process
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['message'] = "Login successful!";
            } else {
                $_SESSION['message'] = "Error: Invalid password.";
            }
        } else {
            $_SESSION['message'] = "Error: No account found with that email.";
        }
        $stmt->close();
    }

    header("Location: index.php");
    exit();

    if ($stmt->execute()) {
        $_SESSION['message'] = "Sign Up successful!";
        header("Location: index.php?form=signup");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();    

}

$conn->close();
?>
