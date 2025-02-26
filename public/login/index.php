<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header("Location: /");
    exit();
}

$db = new PDO("mysql:host=localhost;port=3306;dbname=answerdb;charset=utf8", 'root', '');

// Get posted username and password
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        header("Location: login?error=1");
        exit();
    }

    try {
        // Prepare statement to find the user by username
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and verify the password
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            header("Location: /");
            exit();
        } else {
            header("Location: login?error=1");
            exit();
        }
    } catch (PDOException $e) {
        // Optionally log the error
        header("Location: login?error=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - AnswerSpace</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <div class="flex flex-col items-center min-h-screen">
        <h1 class="text-[2rem] text-center text-white tracking-[.5rem]">
            AnswerSpace
        </h1>
        <div class="bg-[#fff2] shadow-md rounded-lg p-8 max-w-md w-full">
            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
            <?php if (isset($_GET['error'])): ?>
                <p class="mb-4 text-red-500 text-center">Invalid username or password.</p>
            <?php endif; ?>
            <form action="" method="post">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300" required placeholder="3 - 8 characters, e.g., Mior ">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300" required placeholder="3 - 8 characters, e.g., pass1234">
                </div>
                <div class="flex items-center justify-between">
                    <a href="register">Register</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>