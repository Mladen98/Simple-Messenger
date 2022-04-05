<?php

    session_start();
    if(isset($_SESSION["username"])) {
        include_once "../Database/DatabaseConnection.php";

        $db = new Database;

        $conn = $db->connect();

        $messageFrom = mysqli_real_escape_string($conn, $_POST["messageFrom"]);
        $messageTo = mysqli_real_escape_string($conn, $_POST["messageTo"]);

        $output = "";

        $query = "SELECT * FROM messages LEFT JOIN users ON users.username = messages.messageFrom
                WHERE (messageFrom = '$messageFrom' AND messageTo = '$messageTo') OR (messageFrom = '$messageTo' AND messageTo = '$messageFrom') 
                ORDER BY messageID ASC";

        $result = mysqli_query($conn, $query);

        if($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                
                if($row["messageFrom"] === $messageFrom) {
                    $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'. $row["message"] . '</p>
                                    </div>
                                </div>';
                }
                else {
                    $output .= '<div class="chat incoming">
                                    <img src="../messenger/Images/'.$row["image"].'" alt="">
                                    <div class="details">
                                        <p>' . $row["message"] . '</p>
                                    </div>
                                </div>';
                }
            }

            echo $output;
        }
    }
    else {
        header("location: Login.php");
    }

?>