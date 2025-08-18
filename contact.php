
<?php
// Extra debugging output
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<pre>POST Data: ';
print_r($_POST);
echo '</pre>';

// Database connection settings
$host = 'localhost';
$db   = 'portfolio_contacts';
$user = 'root'; // default XAMPP/WAMP username
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    echo 'Database connection successful.<br>';
}

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

// Simple validation
if ($name && $email && $message) {
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    if (!$stmt) {
        echo 'Prepare failed: ' . $conn->error;
    } else {
        $stmt->bind_param("sss", $name, $email, $message);
        if ($stmt->execute()) {
            echo "Message sent successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
} else {
    echo "Please fill in all fields.";
}

$conn->close();
?>
