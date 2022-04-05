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
        <link rel="stylesheet" href="CSS/Homepage.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    </head>

    <body>
        <div class="wrapper">
            <section class="users">
                <header>

                    <?php 

                        include_once "Database/DatabaseConnection.php";
                        
                        $db = new Database;

                        $conn = $db->connect();

                        $username = $_SESSION['username'];

                        $query = "SELECT * FROM users WHERE username = '$username'";

                        $result = mysqli_query($conn, $query);;

                        if($result->num_rows > 0) {
                            $row = mysqli_fetch_assoc($result); 
                        }

                    ?>

                    <div class="content">
                        <img src="../messenger/Images/<?php echo $row["image"]; ?>" alt="">
                        <div class="details"> 
                            <span> <?php echo $row["firstname"]." ".$row["lastname"] ?> </span>
                            <p> 
                                <?php 
                                    if($row["status"] == "online") {
                                        echo "Active now";
                                    }
                                    else {
                                        echo "Offline";
                                    } 
                                ?> 
                            </p>
                        </div>
                    </div>
                    <button class="group-chat" id="groupChat"> <i class="fas fa-plus"></i> Create group chat </button>
                    <a href="Logout.php" class="logout"> Logout </a>
                </header>
                <div class="search">
                    <span class="text"> Select an user to start chat </span>
                    <input type="text" placeholder="Enter name to search user">
                    <button> <i class="fas fa-search"></i></button>
                </div>

                <div class="users-list"> </div>
            </section>
        </div>


        <form>
            <div class="modal" id="modalDialog">
                <div class="modal-header">
                    <h4> Create group chat </h4>
                    <button type="button" id="btn" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> X </span></button>
                </div>
            
                
                
                <div class="modal-body">

                    <label for="chatname"> Enter chat name: </label>
                    <input type="text" id="chatname" name="chatname" placeholder="Enter Group chat name">
                    <br> <hr>
                    <input multiple type="text" name="usernames" id="usernames">
                    <hr>

                    <?php

                        $usr = $_SESSION["username"];
                        $query = "SELECT * FROM users WHERE NOT username = '$usr'";

                        $result = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_assoc($result)) { ?>

                            <div class="content">
                                <img src="../messenger/Images/<?php echo $row["image"]; ?>" alt="">
                                <div class="details">
                                    <span> <?php echo $row["firstname"]." ".$row["lastname"]; ?> </span>
                                    <input hidden type="text" id="user" value="<?php echo $row["username"]; ?>">
                                </div>
                                <div>
                                    <i class="fa fa-circle" id="circle"></i>
                                </div>
                                    
                            </div>
                            <hr>

                        <?php

                        }
                    ?>

                    <button type="submit" id="submitBtn"> Submit </button>
                </div>
            </div>
        </form>

    </body>
</html>


<script src="Javascript/SearchUsers.js"> </script>
<script src="https://kit.fontawesome.com/49ff4a7b2e.js" crossorigin="anonymous"> </script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script>


    $('#groupChat').on('click', function() {
        $('#modalDialog').modal('show');
    });

    let circles = document.querySelectorAll(".modal-body .content #circle");

    for(i = 0; i < circles.length; i++) {

        const tag = circles[i];

        $(document).ready(function() {
            var username = [];
            
            

            $(tag).on('click', function() {
                if(!tag.classList.contains("active")) {
                    tag.classList.add("active");

                    $(".modal-body .content #user").each(function() {

                        var value = $(this).val();
                        username.push({
                            user: value
                        })

                        console.log(username)
                    })
                }

                else {
                    tag.classList.remove("active");

                    $(".modal-body .content #user").each(function() {

                        var value = $(this).val();
                        username.pop({
                            user: value
                        })

                        console.log(username)
                    })
                }
            })

        });
    }

    

</script>