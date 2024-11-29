<?php 
include('includes/header.php'); 
include('databaseconnection.php');

// Start session to store login status
session_start();

// Clear any previous session
session_unset();
session_destroy();

// Start a new session after destroying the previous one
session_start();

// Check if form is submitted
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email']; // User input for email
    $password = $_POST['password']; // User input for password

    // Check if input is a valid email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Query to check user by email
        $query = "SELECT * FROM users WHERE email = ?";

        // Prepare SQL statement
        if ($stmt = $conn->prepare($query)) {
            // Bind parameters and execute query
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if user exists
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // If the user is an admin, directly compare the password (unhashed)
                if ($user['role'] == 'admin') {
                    // Admin login, no password hashing, use the plain password from the database
                    if ($password === $user['password']) {
                        // Password is correct, start the session
                        $_SESSION['user_id'] = $user['user_id']; // Use 'user_id' here (as per your database schema)
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['first_name'] = $user['first_name']; // Make sure first_name is stored in the session
                        $_SESSION['email'] = $user['email'];

                        // Redirect to the admin side
                        header('Location: admin-page.php');
                        exit();
                    } else {
                        // Password is incorrect for admin
                        $error = "Invalid password. Please try again.";
                    }
                } else {
                    // For non-admin users, use password_verify for hashed password comparison
                    if (password_verify($password, $user['password'])) {
                        // Password is correct, start the session
                        $_SESSION['user_id'] = $user['user_id']; // Use 'user_id' here (as per your database schema)
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['first_name'] = $user['first_name']; // Store first_name in session
                        $_SESSION['email'] = $user['email'];

                        // Redirect to the user home page
                        header('Location: userhome.php');
                        exit();
                    } else {
                        // Password is incorrect for regular user
                        $error = "Invalid password. Please try again.";
                    }
                }
            } else {
                // No user found with that email
                $error = "No user found with that email address.";
            }

            $stmt->close();
        } else {
            // If SQL preparation failed
            $error = "There was an error with the login request. Please try again later.";
        }
    } else {
        // If the email format is invalid
        $error = "Please enter a valid email address.";
    }

    // Close database connection
    $conn->close();
}










?>


<style>
    .carousel-item1 img {
        
        object-fit: cover;
        border: 2px solid #28a745;
        border-radius: 15px;
        height:500px;
    }
    /* Unique classes for each grid box */
    .grid-box-1 {
        padding: 0px;
        border: 5px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
        height: 500px;
        margin-left: -120px;
    }

    .grid-box-2 {
        width: 550px;
        padding: 10px;
    }
    
    .carousel-item2 img {
        height: 250px;
        width: 600px;
        object-fit: cover;
        border: 2px solid #28a745;
        border-radius: 15px;
    }
    .grid-box-2 {
        padding: 0px;
        width: 650px;
        border: 2px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
        height: 200px;
    }
    .grid-box-3 {
    padding: 0px;
    width: 780px;
    border: 2px solid #ddd;
    border-radius: 10px;
    background-color: #f9f9f9;
    height: 900px; /* Same height as container-2 */
}
    .carousel-item3 img {
        height: 200px;
        object-fit: cover;
        border: 2px solid #28a745;
        border-radius: 15px;
    }
    .grid-box-3 {
        padding: 0px;
        border: 2px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
        height: 20px;
    }
    .carousel-item5 img {
        height: 190px;
        object-fit: cover;
        border: 2px solid #28a745;
        border-radius: 15px;
    }
    
    
    .grid-box-5 {
        padding: 0px;
        border: 2px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
        height: 100px;
        width: 700px;
    }
    .carousel-item6 img {
        height: 300px;
        object-fit: cover;
        border: 2px solid #28a745;
        border-radius: 15px;
    }
     
    .grid-box-6 {
        padding: 0px;
        border: 2px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
        height: 190px;
        width: 700px;
    }
    .carousel-item7 img {
        
        object-fit: cover;
        border: 2px solid #28a745;
        border-radius: 15px;
        height:260px;
    }
    /* Unique classes for each grid box */
    .grid-box-7 {
        padding: 0px;
        border: 5px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
        height: 270px;
        margin-left: -120px;
    }
    .carousel-item8 img {
       width: 740px !important; 
        object-fit: cover;
        
        border-radius: 15px;
        height:140px;
    }
    /* Unique classes for each grid box */
    .grid-box-8 {
    border: 2px solid #28a745; /* Green border */
    width: 730px; /* Same width as the image */
    height: 150px; /* Same height as the image */
    border-radius: 15px; /* Rounded corners */
    background-color: #f9f9f9; /* Light background */
    margin-top: 270px;
    margin-left: 330px;
}
.carousel-item9 img {
       width: 740px !important; 
        object-fit: cover;
        
        border-radius: 15px;
        height:20px;
    }
    /* Unique classes for each grid box */
    .grid-box-9 {
    border: 2px solid #28a745; /* Green border */
    width: 800px; /* Same width as the image */
    height: 700px; /* Same height as the image */
    border-radius: 15px; /* Rounded corners */
    
    margin-top: -60px;
    margin-left: 370px;
    background-color: #28a745;
}


    .carousel {
        background-color: #f8f9fa;
    }
    .create-box {
        border: 2px solid #28a745; /* Green border */
        width: 730px;
        height: 350px;
        border-radius: 15px; /* Rounded corners */
        background-color: #f9f9f9; /* Light background */
        display: inline-block; /* To make the box as small as the content */
        margin-top: 20px;
        background-color: #74AB6E;
    }

    .container-1 {
        height: 2px;
        margin-top: 5px;
        width: 75%;
        padding-left: 140px;
    }

    .container-2 {
        margin: 0 auto; /* Centers the container horizontally */
        text-align: center;
        width: 1000px;/* Ensure consistent width with grid-box-2 */
    }

    .container-3 {
     margin-left: 1120px;
    margin-top: -645px;
    width: 750px;
    height: auto; Same width as container-2
}

    .container-4 {
        text-align: center;
        margin-top: 50px;
        margin-right: 270px;
    
    }

    .container-5 {
        text-align: center;
        margin-top: 250px;
        margin-left: 1200px;
        
    }
    .container-6 {
        text-align: center;
        margin-top: 110px;
        margin-left: 1200px;
        
    }
    .container-7 {
        height: 2px;
        margin-top: -160px;
        width: 75%;
        padding-left: 140px;
    }
    .container-8 {
        height: 2px;
        margin-top: -160px;
        width: 85%;
        padding-left: 140px;
        
    }
    .container-9 {
    position: relative; /* or absolute, depending on your layout */
    z-index: 100; /* Higher value to bring it in front */
    height: 100px;
    margin-top: -260px;
    width: 70%;
    padding-left: 140px;
    
    
}
  
    .btn{
        height: 100px;
        width: 670px;
        margin-top: 30px;
        color: black; 
        background-color: #fff;
    }
  .create-box h2 {
    font-size: 50px; /* Increase/decrease font size as needed */
    font-weight: bold; /* Optional: Makes the text bolder */
    margin-top: 60px;
    color: white;
}
.create-box a{
    font-size: 50px;
    font-weight: bold;
    color: black;
}
 .form-control {
        border-radius: 20px;
        margin-top: 60px;
        margin-left: 5px;
        font-size: 20px;
        padding: 20px;
        width: 100%;
        height: 80px;
        border-color: black;
        border-width: 2px;
        text-align: center;
        font-weight: bold;
    }
    .form-text {
        
        margin-left: 600px;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    
    }
    .form-label {
        margin-top: 15px;
        margin-left: 300px;
        font-size: 80px;
        font-weight: bold;
        color: white;
    }
    .form-label-1 {
        color: white;
        font-size: 35px;
        font-weight: bold;
        margin-left: 150px;
    }
.grid-box-9 button {
        margin-top: 40px;
        margin-left: 50px;
        width: 650px;
        height: 70px;
        padding: 10px;
        font-size: 30px;
        font-weight: bold;
        margin-right: -10px;
       
        border-color: black;
        border-radius: 15px;
        
    }
    .grid-box-9 .btn {
        margin-top: 20px;
        padding: 15px;
        margin-left: 60px;
        
    }
    input::placeholder {
    font-size: 30px; /* Adjust font size as needed */
    color: gray; /* Optional: Change the placeholder text color */
    font-weight: bold; /* Optional: Add bold style */
}
</style>
<div class="container-1">
    <div class="row">
        <!-- First Box with Carousel -->
        <div class="col-md-4 grid-box grid-box-1">
            <div id="carousel1" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000">
            <div class="carousel-inner">
                    <div class="carousel-item active carousel-item1">
                        <img src="pimages/1.jpg" class="d-block w-100" alt="Image 1a">
                    </div>
                    <div class="carousel-item carousel-item1">
                        <img src="pimages/2.jpg" class="d-block w-100" alt="Image 1b">
                    </div>
                    <div class="carousel-item carousel-item1">
                        <img src="pimages/3.jpg" class="d-block w-100" alt="Image 1c">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-2">
    <!-- Second Box with Carousel -->
    <div class="col-md-4 grid-box grid-box-2">
        <div id="carousel2" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1400">
        <div class="carousel-inner">
                <div class="carousel-item active carousel-item2">
                    <img src="pimages/jersey1.jpg" class="d-block w-100" alt="Image 2a">
                </div>
                <div class="carousel-item carousel-item2">
                    <img src="pimages/jersey2.jpg" class="d-block w-100" alt="Image 2b">
                </div>
                <div class="carousel-item carousel-item2">
                    <img src="pimages/jersey3.jpg" class="d-block w-100" alt="Image 2c">
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-4">
    <!-- Create Box below Container-2 -->
    <div class="text-center my-4">
        <div class="create-box">
            <h2>Create your own design and Order now!</h2>
            <a href="login2.php" class="btn btn-success btn-lg">Create</a>
        </div>
    </div>
</div>

<div class="container-3">
    <!-- Second Box with Carousel -->
    <div class="col-md-4 grid-box grid-box-3">
        <div id="carousel3" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1100">
        <div class="carousel-inner">
                <div class="carousel-item active carousel-item2">
                    <img src="pimages/polo4.jpg" class="d-block w-100" alt="Image 2a">
                </div>
                <div class="carousel-item carousel-item2">
                    <img src="pimages/polo5.jpg" class="d-block w-100" alt="Image 2b">
                </div>
                <div class="carousel-item carousel-item2">
                    <img src="pimages/polo6.jpg" class="d-block w-100" alt="Image 2c">
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-5">
    <!-- Second Box with Carousel -->
    <div class="col-md-4 grid-box grid-box-5">
        <div id="carousel5" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1200">
        <div class="carousel-inner">
                <div class="carousel-item active carousel-item5">
                    <img src="pimages/tote1.jpg" class="d-block w-100" alt="Image 2a">
                </div>
                <div class="carousel-item carousel-item5">
                    <img src="pimages/tote2.jpg" class="d-block w-100" alt="Image 2b">
                </div>
                <div class="carousel-item carousel-item5">
                    <img src="pimages/tote3.jpg" class="d-block w-100" alt="Image 2c">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-6">
    <!-- Second Box with Carousel -->
    <div class="col-md-4 grid-box grid-box-6">
        <div id="carousel5" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1300">
        <div class="carousel-inner">
                <div class="carousel-item active carousel-item6">
                    <img src="pimages/tshirt1.jpg" class="d-block w-100" alt="Image 2a">
                </div>
                <div class="carousel-item carousel-item6">
                    <img src="pimages/tshirt2.jpg" class="d-block w-100" alt="Image 2b">
                </div>
                <div class="carousel-item carousel-item6">
                    <img src="pimages/tshirt3.jpg" class="d-block w-100" alt="Image 2c">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-7">
    <div class="row">
        <!-- First Box with Carousel -->
        <div class="col-md-4 grid-box grid-box-7">
            <div id="carousel1" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                <div class="carousel-item active carousel-item7">
                        <img src="pimages/cap1.jpg" class="d-block w-100" alt="Image 1a">
                    </div>
                    <div class="carousel-item carousel-item7">
                        <img src="pimages/cap2.jpg" class="d-block w-100" alt="Image 1b">
                    </div>
                    <div class="carousel-item carousel-item7">
                        <img src="pimages/cap3.jpg" class="d-block w-100" alt="Image 1c">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-8">
    <div class="row">
        <!-- First Box with Carousel -->
        <div class="col-md-4 grid-box grid-box-8">
            <div id="carousel8" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                    <div class="carousel-item active carousel-item8">
                        <img src="pimages/shirty1.jpg" class="d-block w-100" alt="Image 1a">
                    </div>
                    <div class="carousel-item carousel-item8">
                        <img src="pimages/shirty2.jpg" class="d-block w-100" alt="Image 1b">
                    </div>
                    <div class="carousel-item carousel-item8">
                        <img src="pimages/shirty3.jpg" class="d-block w-100" alt="Image 1c">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-9">
    <div class="row">
        <!-- First Box with Carousel -->
        <div class="col-md-4 grid-box grid-box-9">
        <form method="POST" action=""> 
                <label class="form-label">GZEL</label><br>
                <label class="form-label-1">Digital Design and Printing</label>
                <div class="mb-3" style="text-align:center;">
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Email address" required style="text-align: center;">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required style="text-align: center; text-decoration:none;">
                <div id="emailHelp" class="form-text"><a href="createaccount.php">Create account</a></div>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
               
             </form>

        
        </div>
    </div>
</div>
