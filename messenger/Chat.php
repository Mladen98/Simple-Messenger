<?php

    session_start();
    if(!isset($_SESSION["userID"])) {
        header("location: Login.php");
    }

?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Homepage </title>
        <link rel="stylesheet" href="CSS/Chat.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    </head>

    <body>
        <div class="wrapper">
            <section class="chat-area">
                <header>

                    <?php 

                        include_once "Database/DatabaseConnection.php";

                        $db = new Database;

                        $conn = $db->connect();

                        $username = mysqli_real_escape_string($conn, $_GET["username"]);

                        $query = "SELECT * FROM users WHERE username = '$username'";

                        $result = mysqli_query($conn, $query);;

                        if($result->num_rows > 0) {
                            $row = mysqli_fetch_assoc($result); 
                        }

                    ?>

                    <a href="Homepage.php" class="back-arrow"> <i class="fas fa-arrow-left"></i></a>
                    <img src="../messenger/Images/<?php echo $row["image"] ?>" alt="">
                    <div class="details">
                        <span>  <?php echo $row["firstname"]." ".$row["lastname"] ?> </span>
                        <p> 
                        <?php 
                            if($row["status"] == "online") {
                                echo "Active Now";
                            }
                            else {
                                echo "Offline";
                            }
                        ?> 
                        </p>
                    </div>
                </header> 

                <div class="chat-box">

                </div>

                <form action="#" class="typing-area" autocomplete="off">
                    <input type="text" name="messageFrom" value="<?php echo $_SESSION["username"]; ?>" hidden>
                    <input type="text" name="messageTo" value="<?php echo $username; ?>" hidden>

                    <input type="text" name="message" class="input-field" placeholder="Type a message here">
                    <button> <i class="fab fa-telegram-plane"></i> </button>
                </form>
            </section>
        </div>
    </body>
</html>

<script src="Javascript/Chat.js" > </script>
<script src="https://kit.fontawesome.com/49ff4a7b2e.js" crossorigin="anonymous"> </script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>