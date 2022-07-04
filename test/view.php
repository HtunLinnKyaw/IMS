<h2>
    this is view.php
    <?php

    session_start();

    echo $_SESSION['name']."<br>";
    echo $_SESSION['age']."<br>";
    echo $_SESSION['country'];

    ?>
</h2>