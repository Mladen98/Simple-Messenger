<?php

    include_once "../Database/DatabaseConnection.php";

    session_start();
    
    $db = new Database();

    $conn = $db->connect();

    $username = $_SESSION["username"];

    $query = "SELECT * FROM users WHERE NOT username = '$username'";

    $result = mysqli_query($conn, $query);
    $output = "";

    if($result->num_rows == 0) {
        $output .= "No users are available to chat";
    }
    elseif($result->num_rows > 0) {
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

            $query3 = "SELECT COUNT(*) AS cnt FROM messages WHERE (messageTo = '$infoMsg' OR messageFrom = '$infoMsg') 
                AND (messageFrom = '$username' OR messageTo = '$username')";

            $result3 = mysqli_query($conn, $query3);

            $row3 = $result3->fetch_assoc();

            (strlen($resMsg) > 28) ? $msg = substr($resMsg, 0, 28)."..." : $msg = $resMsg;
            global $you;

            if($row3["cnt"] > 0) {
                ($username == $row2["messageFrom"]) ? $you = "You: " : $you = "";
            }

            ($row["status"] == "offline") ? $offline = "offline" : $offline = "";

            $output .= '
            <a href="Chat.php?username='.$row["username"].'">
                <div class="content">
                    <img src="../messenger/Images/'.$row["image"].'" alt="">
                    <div class="details">
                        <span>'. $row["firstname"]." ".$row["lastname"]. '</span>
                        <p>' . $you.$msg . '</p>
                    </div>
                </div>
                <div class="status-dot '. $offline .' "> <i class="fas fa-circle"> </i> </div>
            </a>';
        }
    }

    echo $output;

?>