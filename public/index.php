<?php
// echo "<script>alert('Not logged In')</script>";
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: /');
    exit;
} else if (isset($_POST['login'])) {
    session_destroy();
    header('Location: /login');
    exit;
}

if (!isset($_SESSION['logged_in'])) {
    // echo "<script>alert('Not logged In: $_SESSION')</script>";
    // header("Location: login");
    // exit();
}
// $db = new PDO("mysql:host=localhost;dbname=answerdb;charset=utf8", 'root', '');
// $db = new PDO("mysql:host=localhost;port=3306;dbname=answerdb;charset=utf8", 'root', '');
$db = new PDO("mysql:host=db;port=3306;dbname=answerdb;charset=utf8", 'root', 'mior');

// id, answer_text, user_id, time_created

if (isset($_POST['answer_text'])) {
    $stmt = $db->prepare("INSERT INTO answers(answer_text, user_id) values( :answer_text, :user_id)");
    $stmt->execute(
        [
            'answer_text' => $_POST['answer_text'],
            'user_id' => $_SESSION['user_id']
        ]
    );
    header('Location: /');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/styles.css">
    <title>Mior's AnswerSpace</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>

<body>
    <?php
    include 'components/navbar.php';
    ?>

    <div class="container mx-auto flex flex-col p-4 gap-4">
        <h1 class="text-[8dvw] drop-shadow-[0_0_4rem_rgba(1,1,1,0.5)] text-center text-white tracking-[.5rem]">
            AnswerSpace
        </h1>
        <div class="bg-[#88f4] container rounded-lg p-6 max-w-2xl mx-auto">
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="answer_text" class="block text-gray-700 text-sm font-bold mb-2">
                        Your Answer
                    </label>
                    <textarea
                        id="answer_text"
                        name="answer_text"
                        rows="4"
                        class="disabled:bg-[#88a4] disabled:border-gray-500 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300"
                        <?php
                        if (!isset($_SESSION['logged_in'])) {
                            echo "disabled placeholder='Log in to enter your answer'";
                        } else {
                            echo "placeholder='Enter your answer here...'";
                        } ?>></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        type="submit"
                        <?php
                        if (!isset($_SESSION['logged_in'])) {
                            echo "disabled";
                        }
                        ?>
                        class="disabled:bg-[#88a8] bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Submit
                    </button>
                </div>
            </form>
        </div>


        <div class="flex flex-col lg:grid lg:grid-cols-3 gap-4">
            <?php
            $sql = "
                SELECT answers.answer_text, answers.user_id, users.username, answers.time_created, users.background
                FROM answers
                INNER JOIN users
                ON users.id = answers.user_id
                ORDER BY answers.time_created DESC;
                ";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $answers = $stmt->fetchAll();
            ?>
            <?php foreach ($answers as $answer): ?>
                <div class="bg-[#88f4] shadow-md rounded-lg p-4 mb-4 answer-item">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex gap-4">
                            <div
                                class="p-4 bg-white rounded-full"
                                style="background: <?php $answer['background'] ?>;">
                            </div>
                            <h2 class="text-xl font-semibold "><?php echo htmlspecialchars($answer['username']); ?></h2>
                        </div>
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $answer['user_id']): ?>
                            <box-icon name="dots-vertical-rounded" color="#fff"></box-icon>
                        <?php endif; ?>






                    </div>
                    <pre class="text-gray-700 mb-4 text-wrap break-words"><?php echo htmlspecialchars($answer['answer_text']); ?></pre>
                    <p style="color: #668;"><?php echo htmlspecialchars($answer['time_created']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</body>

</html>