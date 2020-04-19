<?php
//Reference from https://www.youtube.com/watch?v=g0l28ta4XjA for facebook aPI login during college project
// session_start();
require './login-init.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="FinalProject.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<header class="container text-center bg-danger text-white">
    <div>
        <h2>Essentials Cart</h2>
    </div>
    <ul class="text-uppercase">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Menu</a></li>
        <li><a href="#">My Cart</a></li>
    </ul>
</header>
<main class=" container text-black">
    <div  class=" border border-danger text-center">
        <h1>Welcome To Essentials Cart!</h1>
    </div>
    <div class="row">
        <?php
        if(isset($_SESSION['access_token'])) :?>
            <a href="Logout.php">Logout</a>
        <?php else: ?>
        <?php   endif; ?>

        <a href="<?php echo $login_url; ?>">Login with Facebook</a>
        <div>
            <!--fb login here -->
            <?php  if(isset($_SESSION['access_token']))
            {

                try
                {
                    $fb->setDefaultAccessToken($_SESSION['access_token']);
                    $res = $fb->get('/me?locale=en_US&fields=name,email');
                    $user = $res->getGraphUser();

                    echo "Welcome " . $user->getField('name') . "!";
                    $mycart =['Carrors','Apples','Broccoli','toothpaste','flour','meat','cookies','tissue'];
                    $prices =[5.00,6.00,10.99,2.25,12.00,10.99,3.25,12.50];
                    ?>
                    <div class="text-center"> <h5>Fill your cart with your favourite grocery items</h5>
                        <?php for($i=0;$i<count($mycart);$i++)
                        {
                            echo "<div><input type=checkbox >$". $prices[$i] . "</input>" . "  <strong>". $mycart[$i]. "</strong></div>";
                        }

                        ?>
                        <input class="btn-danger" type="submit" value="Checkout" />
                    </div>
                    <?php
                } catch (Exception $exc)
                {
                    echo $exc->getTraceAsString();
                }
            }
            ?>
        </div>
        <div class="col-sm-4"><img src="cart.jpg" alt="grocery cart icon with vegetables" /></div>
    </div>
</main>
<footer class="container bg-secondary text-white">
    <div>
        <p>Copyright@EssentialsCart</p>
    </div>
</footer>

</body>
</html>