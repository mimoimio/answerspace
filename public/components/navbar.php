<?php
?>
<nav class='flex w-full justify-between p-4 pr-[10rem])'>
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <div class="">
            <?php echo "Username: " . $_SESSION['username']; ?>
        </div>
        <form action="" method="post">
            <input type="submit" name="logout" value="logout">
        </form>
    <?php else: ?>
        <div class="">
            <?php echo "Not logged in"; ?>
        </div>
        <form action="" method="post">
            <input type="submit" name="login" value="login">
        </form>
    <?php endif ?>
</nav>