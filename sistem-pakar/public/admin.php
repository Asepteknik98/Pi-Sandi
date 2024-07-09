<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <ul>
        <li><a href="admin.php?action=manage_users">Manage Users</a></li>
        <li><a href="admin.php?action=manage_posts">Manage Posts</a></li>
        <li><a href="admin.php?action=manage_settings">Manage Settings</a></li>
        <!-- Add more links as needed -->
    </ul>
    
    <?php
    // Check if an action is requested
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        
        // Perform actions based on the action parameter
        switch ($action) {
            case 'manage_users':
                echo "<h2>Manage Users</h2>";
                // Code for managing users
                break;
            case 'manage_posts':
                echo "<h2>Manage Posts</h2>";
                // Code for managing posts
                break;
            case 'manage_settings':
                echo "<h2>Manage Settings</h2>";
                // Code for managing settings
                break;
            default:
                echo "<p>Invalid action!</p>";
        }
    }
    ?>
</body>
</html>
