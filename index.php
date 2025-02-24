<?php
// phpinfo();
// exit;

?>
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
        echo $stmt->execute();

        //$coffeeshops = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <h1 class="text-[2rem] drop-shadow-[0_0_4rem_rgba(1,1,1,0.5)] text-center text-white tracking-[.5rem]">
            AnswerSpace</h1>
        <div class="flex flex-col lg:grid lg:grid-cols-3 gap-4">
            <?php for ($i = 0; $i < 10; $i++): ?>
                <div class="answer-item gap-4">
                    <h2>Answer #1</h2>
                    <hr>
                    <p>Lorem Ipsum aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                        text-overflow: 'ellipsis';
                        text-align: justify;</p>
                </div>
            <?php endfor; ?>
        </div>

    </div>

</body>

</html>