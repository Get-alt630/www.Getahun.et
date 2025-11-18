<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data Management System</title>

<link rel="stylesheet" href="./Gebeze.css">



</head>
<body>
    <header>
        <div class="container">
            <div class="header-top">
            <div class="university-name">Gebezemaryiam high school and priparatory school</div>
            <div class="date-display" id="currentDate">Wednesday, August 6, 2025 </div>
            <p id="TimeForm">0:0:0</p>
            </div>
            <div class="header-bottom">
            <nav>
            <ul>
            <li><a  style="background-color:yellow; text-decoration:none" href="#" class="active">Home</a></li>
            <li><a style="background-color:yellow; text-decoration:none" href="#">Gebez Web Site</a></li>
            </ul>
            </nav>
             <a style="background-color: yellow; text-decoration:none" href="./RegisterStud.php" >Register</a>
            </div>
        </div>
    </header>
    <div class="container">
        <header>
            <h1>Student Data Management System</h1>
        </header>
        <div class="success-message" id="successMessage"></div>
        <div class="error-message" id="errorMessage"></div>
        <div class="form-container">
            <form id="studentForm">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" name="fullName" required>
                    <div class="error" id="nameError"></div>
                </div><br>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                    <div class="error" id="emailError"></div>
                </div><br>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" required>
                    <div class="error" id="phoneError"></div>
                </div><br>
                
                <div class="form-group">
                    <label for="course">Course/Program</label>
                    <input type="text" id="course" name="course" required>
                    <div class="error" id="courseError"></div>
                </div><br>
    
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" required>
                    <div class="error" id="dobError"></div>
                </div><br>
                
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                    <div class="error" id="addressError"></div>
                </div>
                <br>
                <button type="submit">Submit</button><br>
            </form>
        </div>
    </div>


    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Database configuration
        $servername = "localhost";
        $username = "root"; // Change if needed
        $password = ""; // Change if needed
        $dbname = "phprunner";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            sendResponse(false, "Connection failed: " . $conn->connect_error);
            exit();
        }
        
        // Get form data
        $fullName = sanitizeInput($_POST['fullName']);
        $email = sanitizeInput($_POST['email']);
        $phone = sanitizeInput($_POST['phone']);
        $course = sanitizeInput($_POST['course']);
        $dob = sanitizeInput($_POST['dob']);
        $address = sanitizeInput($_POST['address']);
        
        // Validate data
        if (empty($fullName) || empty($email) || empty($phone) || empty($course) || empty($dob) || empty($address)) {
            sendResponse(false, "All fields are required.");
            exit();
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            sendResponse(false, "Invalid email format.");
            exit();
        }
        
        // Check if email already exists
        $checkEmail = $conn->prepare("SELECT id FROM students WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();
        
        if ($checkEmail->num_rows > 0) {
            sendResponse(false, "Email already exists.");
            $checkEmail->close();
            exit();
        }
        $checkEmail->close();
        
        // Insert data into database
        $stmt = $conn->prepare("INSERT INTO students (full_name, email, phone, course, dob, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $fullName, $email, $phone, $course, $dob, $address);
        
        if ($stmt->execute()) {
            sendResponse(true, "Student data saved successfully!");
        } else {
            sendResponse(false, "Error: " . $stmt->error);
        }
        
        $stmt->close();
        $conn->close();
    }
    
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    function sendResponse($success, $message) {
        header('Content-Type: application/json');
        echo json_encode(['success' => $success, 'message' => $message]);
        exit();
    }
    ?>

    <script src="./Gebeze.js"></script>

<a href="./Gebeze.php" style="text-decoration: none;">Back to home</a>
      <footer>
        <div class="container">
            <p>Copyright 2025</p>
        </div>
    </footer>
</body>
</html>