<?php

    include_once "../Database/DatabaseConnection.php";
    session_start();

    $db = new Database;

    $conn = $db->connect();

    $searchTerm = mysqli_real_escape_string($conn, $_POST["searchTerm"]);

    $username = $_SESSION["username"];

    $output = "";
    $query = "SELECT * FROM users WHERE NOT username='$username' AND (firstname LIKE '%{$searchTerm}%' OR lastname LIKE '%{$searchTerm}%')";

    $result = mysqli_query($conn, $query);

    if($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {

            $infoMsg = $row["username"];
            $query2 = "SELECT * FROM messages WHERE (messageTo = '$infoMsg' OR messageFrom = '$infoMsg') 
                AND (messageFrom = '$username' OR messageTo = '$username') ORDER BY messageID DESC LIMIT 1";

            $result2 = mysqli_query($conn, $query2);

            $row2 = $result2->fetch_assoc();

            if($result2->num_rows > 0) {
                $resMsg = $row2["message"];
            }
            else {
                $resMsg = "No messages available";
            } 

            (strlen($resMsg) > 28) ? $msg = substr($resMsg, 0, 28)."..." : $msg = $resMsg;

            ($row["status"] == "offline") ? $offline = "offline" : $offline = "";

            $output .= '
            <a href="Chat.php?username='.$row["username"].'">
                <div class="content">
                    <img src="../messenger/Images/'.$row["image"].'" alt="">
                    <div class="details">
                        <span>'. $row["firstname"]." ".$row["lastname"]. '</span>
                        <p>'. $msg . '</p>
                    </div>
                </div>
                <div class="status-dot '. $offline .' "> <i class="fas fa-circle"> </i> </div>
            </a>';
        }
    }
    else {
        $output .= "No users found related to your search term!";
    }

    echo $output;

?>