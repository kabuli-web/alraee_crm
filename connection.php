<?php
$servername = "localhost";  // Change this to your MySQL server address
$username = "root";  // Change this to your MySQL username
$password = "";  // Change this to your MySQL password
$dbname = "raee_db";  // Change this to the desired database name

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // echo "Database initiated \n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

// Close the connection
$conn->close();

// Connect to the newly created database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'users' table exists
$tableCheck = "SELECT 1 FROM users LIMIT 1";
$result = $conn->query($tableCheck);

// If the table does not exist, create it
if ($result === FALSE) {
    $createTableSQL = "CREATE TABLE IF NOT EXISTS users (
        id INT PRIMARY KEY,
        st_id VARCHAR(30),
        assign VARCHAR(30),
        project_type VARCHAR(30),
        username VARCHAR(30),
        email VARCHAR(30),
        mobile VARCHAR(30),
        industry VARCHAR(30),
        comment TEXT
    )";

    if ($conn->query($createTableSQL) === TRUE) {
        echo "Table 'users' created successfully\n";
    } else {
        echo "Error creating table: " . $conn->error . "\n";
    }

    
} else {
    // Check if all columns exist, and add missing columns if necessary
    $columnsToCheck = array('st_id', 'assign', 'project_type', 'username', 'email', 'mobile', 'industry', 'comment');
    $existingColumns = array();

    // Fetch existing columns
    $columnsQuery = "SHOW COLUMNS FROM users";
    $columnsResult = $conn->query($columnsQuery);

    while ($column = $columnsResult->fetch_assoc()) {
        $existingColumns[] = $column['Field'];
    }

    // Add missing columns
    foreach ($columnsToCheck as $column) {
        if (!in_array($column, $existingColumns)) {
            $addColumnSQL = "ALTER TABLE users ADD $column VARCHAR(30)";
            if ($conn->query($addColumnSQL) === TRUE) {
                echo "Column '$column' added to 'users' table\n";
            } else {
                echo "Error adding column: " . $conn->error . "\n";
            }
        }
    }

    // Rename 'name' column to 'username'
    if (in_array('name', $existingColumns)) {
        $renameColumnSQL = "ALTER TABLE users CHANGE name username VARCHAR(30)";
        if ($conn->query($renameColumnSQL) === TRUE) {
            echo "Column 'name' renamed to 'username' in 'users' table\n";
        } else {
            echo "Error renaming column: " . $conn->error . "\n";
        }
    }
}

// If the Login table does not exist, create it
$loginsql = "CREATE TABLE IF NOT EXISTS login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($loginsql) === TRUE) {
    // echo "Table 'login' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
// Close the connection
$conn->close();


$con  = mysqli_connect('localhost','root','','raee_db');
if(mysqli_connect_errno())
{
    echo 'Database Connection Error';
}

