<h2>
    <?php
    //setcookie($name,$content,$expire,$path,$domain,$secure);

    $name = 'VisitCount';
    $content = $_COOKIE['VisitCount']+1;
    $expire = time()+(60*60*24*30); // give - operator to expire cookies

    setcookie($name,$content,$expire);
    print_r($_COOKIE)

    ?>
</h2>

<h1>Cookies</h1>