<?php
$HostName = "localhost";
$UserName = "root";
$Password = "";
$DataBase = "dating_app";

// Create a new mysqli connection
$con = new mysqli($HostName, $UserName, $Password, $DataBase);

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get the user_id from the URL parameter
$userId = $_GET['user_id'];

// Prepare a statement to retrieve the user's hobbies from the database
$query = "SELECT hobbies FROM user_hobbies WHERE user_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$userHobbies = $result->fetch_assoc()['hobbies'];

// Prepare a statement to find potential matches based on hobbies
$query = "SELECT u.user_id, u.name, uh.hobbies
          FROM user_profiles u
          INNER JOIN user_hobbies uh ON u.user_id = uh.user_id
          WHERE uh.hobbies IN (SELECT hobbies FROM user_hobbies WHERE user_id = ?)
          AND u.user_id != ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ii", $userId, $userId);
$stmt->execute();
$result = $stmt->get_result();

// Prepare the response array for potential matches
$matches = array();
while ($row = $result->fetch_assoc()) {
    $match = array(
        'id' => $row['user_id'],
        'name' => $row['name'],
        'hobbies' => explode(',', $row['hobbies'])
    );
    $matches[] = $match;
}

// Sort potential matches based on compatibility (e.g., number of shared hobbies)
usort($matches, function ($a, $b) use ($userHobbies) {
    $scoreA = count(array_intersect($userHobbies, $a['hobbies']));
    $scoreB = count(array_intersect($userHobbies, $b['hobbies']));
    return $scoreB - $scoreA;
});

// Prepare the JSON response
$response = array(
    'user_id' => $userId,
    'matches' => $matches
);

// Set the appropriate HTTP headers
header('Content-Type: application/json');

// Send the JSON response back to the client
echo json_encode($response);

// Close the database connection
$stmt->close();
$con->close();
?>
