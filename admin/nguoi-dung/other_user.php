<?php 
	require_once '../../app/config/config.php';
    include_once APPROOT . '/db/connect.php';

    if (isset($_GET['targetUser'])) {
        $targetUser = $_GET['targetUser'];

        // Fetch other users excluding the one to be deleted
        $otherUserResult = mysqli_query($con, "SELECT id, firstname, lastname FROM users WHERE id != $targetUser ORDER BY id ASC");
        
        if ($otherUserResult) {
            $otherUsers = mysqli_fetch_all($otherUserResult, MYSQLI_ASSOC);
            $response = ['otherUsers' => $otherUsers];
            echo json_encode($response);
        } else {
            // Handle database query error
            $response = ['error' => 'Error querying the database'];
            echo json_encode($response);
        }
    } else {
        // Handle missing or invalid parameter
        $response = ['error' => 'Invalid request'];
        echo json_encode($response);
    }
?>