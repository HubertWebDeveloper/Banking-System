<?php include("includes/function.php"); ?>

<?php

$userId = $_SESSION['LoggedInUser']['ID']; // Replace with your method of retrieving the logged-in user ID
$uploadDir = 'profiles/';
$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Handle uploaded file
    if ($_POST['type'] === 'upload' && isset($_FILES['profileImage'])) {
        $file = $_FILES['profileImage'];
        $fileName = basename($file['name']);
        $targetFilePath = $uploadDir . $fileName;

        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowedTypes) && move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            updateProfileImage($con, $userId, $fileName, $uploadDir);
        } else {
            $response['message'] = 'Invalid file type or upload failed.';
        }
    }

    // Handle selected avatar
    if ($_POST['type'] === 'avatar' && isset($_POST['avatarPath'])) {
        $avatarPath = $_POST['avatarPath'];
        updateProfileImage($con, $userId, $avatarPath, $uploadDir, false);
    }

    $conn->close();
}

echo json_encode($response);

// Update profile image in the database
function updateProfileImage($con, $userId, $fileName, $uploadDir, $isUpload = true) {
    global $response;

    // Check and delete the existing profile image
    $result = $con->query("SELECT profile FROM users WHERE id = $userId");
    $user = $result->fetch_assoc();

    if ($user && !empty($user['profile'])) {
        $existingFile = $uploadDir . $user['profile'];
        if ($isUpload && file_exists($existingFile)) {
            unlink($existingFile);
        }
    }

    // Update the database
    $stmt = $con->prepare("UPDATE users SET profile = ? WHERE id = ?");
    $stmt->bind_param('si', $fileName, $userId);
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['message'] = 'Failed to update profile image.';
    }
    $stmt->close();
}
?>