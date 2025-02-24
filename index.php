<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Mior's AnswerSpace</title>

</head>

<body>

    <div class="container mx-auto flex flex-col p-4">
        <?php
        $db = new PDO("mysql:host=localhost;dbname=answerdb;charset=utf8", 'root', '');
        $db = new PDO("mysql:host=localhost;port=3306;dbname=answerdb;charset=utf8", 'root', '');
        $stmt = $db->prepare("SELECT * FROM answers");
        $stmt->execute();
        $answers = $stmt->fetchAll();
        // id, answer_text, user_id, time_created
        ?>
        <h1 class="text-[2rem] drop-shadow-[0_0_4rem_rgba(1,1,1,0.5)] text-center text-white tracking-[.5rem]">
            AnswerSpace
        </h1>
<!-- max-w-lg : what's this -->
        <div class="container shadow-md rounded-lg p-6 max-w-2xl mx-auto">
            <form action="submit.php" method="POST">
                <div class="mb-4">
                    <label for="answer_text" class="block text-gray-700 text-sm font-bold mb-2">
                        Your Answer
                    </label>
                    <textarea
                        id="answer_text"
                        name="answer_text"
                        rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300"
                        placeholder="Enter your answer here..."></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Submit
                    </button>
                </div>
            </form>
        </div>


        <div class="flex flex-col lg:grid lg:grid-cols-3 gap-4">
            <?php foreach ($answers as $answer): ?>
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                    <h2 class="text-xl font-semibold mb-2">Answer #<?php echo htmlspecialchars($answer['id']); ?></h2>
                    <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($answer['answer_text']); ?></p>
                    <p class="text-sm text-gray-500">User ID: <?php echo htmlspecialchars($answer['user_id']); ?></p>
                    <p class="text-sm text-gray-500">Created on: <?php echo htmlspecialchars($answer['time_created']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</body>

</html>