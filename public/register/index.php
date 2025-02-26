<?php
session_start();
// if already logged in, go to root dir
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // header("Location: /");
    exit();
}

$db = new PDO("mysql:host=localhost;port=3306;dbname=answerdb;charset=utf8", 'root', '');

// Get posted username and password
if (isset($_POST['username']) && isset($_POST['password'])) {
    echo "<script>alert('username and password is set')</script>";
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        // Prepare statement to find the user by username
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists
        if ($user['username'] == $username) {
            echo "<script>alert('$username is already registered')</script>";
        } else {
            $stmt = $db->prepare("INSERT INTO users(username, password) VALUES(:username, :password)");
            $data = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];
            $result = $stmt->execute($data);

            // if successful insertion
            if ($result) {
                $stmt = $db->prepare("SELECT * FROM users where username = :username LIMIT 1");
                $stmt->execute(['username' => $username]);
                $user = $stmt->fetch();

                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];
                echo "<script>alert('session successful')</script>";
            } else {
                echo "<script>alert('session unsuccessful')</script>";
                session_destroy();
            }
            header("Location: /");
            exit();
        }
    } catch (PDOException $e) {
        // Optionally log the error
        header("Location: register?error=1");
        exit();
    }
} else {
    // echo "<script>alert('pls fill: ')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - AnswerSpace</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-gray-100">
    <div class="flex flex-col items-center min-h-screen">
        <h1 class="text-[2rem] drop-shadow-[0_0_4rem_rgba(1,1,1,0.5)] text-center text-white tracking-[.5rem]">
            AnswerSpace
        </h1>
        <div class="bg-[#fff2] shadow-md rounded-lg p-8 max-w-md w-full">
            <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
            <!-- <?php if (isset($_GET['error'])): ?>
                <p class="mb-4 text-red-500 text-center">Invalid username already registered.</p>
            <?php endif; ?> -->
            <form action="" method="post">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300" required minlength="3" maxlength="8">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300" required minlength="3" maxlength="8">
                </div>
                <!-- <div class="mb-6">
                    <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Re-enter Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300" required minlength="3" maxlength="8">
                </div> -->
                <div class="flex items-center justify-between">
                    <a href="login">Return to Login</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>