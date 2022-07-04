<h2>

    <?php

    session_start();

    $name = $_SESSION['name']='yoshi';
    $age = $_SESSION['age']='23';
    $country = $_SESSION['country']='UK';

    echo $name."<br>";
    echo $age."<br>";
    echo $country;

    ?>
</h2>