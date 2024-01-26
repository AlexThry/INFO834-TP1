<?php
require_once "header.php";


function get_alert($type, $message_success, $message_error) {
    if ($type == "True\n") {
        $alert = '
            <div role="alert" class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>' . $message_success . '</span>
            </div>
            ';
    } else {        
        $alert = '
            <div role="alert" class="alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>'. $message_error .'</span>
            </div>
            ';
    }

    return $alert;
}

function create_account($email, $password) {
    global $conn;

    $sql = "SELECT * FROM USERS WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return "False\n";
    } else {
        $sql = "INSERT INTO USERS (email, password) VALUES ('$email', '$password')";
        $result = mysqli_query($conn, $sql);
        return "True\n";
    }
}
