<?php include('includes/header.php'); ?>

<?php
include('databaseconnection.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate fields
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        echo "All fields are required.";
        return;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Account created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<div class="container-1">
    <div class="row">
        <!-- First Box with Carousel -->
        <div class="col-md-4 grid-box grid-box-1">
            <div id="carousel1" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000">
                <div class="carousel-inner">
                    <div class="carousel-item active carousel-item1">
                        <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1a">
                    </div>
                    <div class="carousel-item carousel-item1">
                        <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1b">
                    </div>
                    <div class="carousel-item carousel-item1">
                        <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1c">
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
                    <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 2a">
                </div>
                <div class="carousel-item carousel-item2">
                    <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 2b">
                </div>
                <div class="carousel-item carousel-item2">
                    <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 2c">
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
            <a  class="btn btn-success btn-lg" href="login.php">Create</a>
        </div>
    </div>
</div>
<div class="container-3">
    <!-- Second Box with Carousel -->
    <div class="col-md-4 grid-box grid-box-3">
        <div id="carousel3" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1100">
            <div class="carousel-inner">
                <div class="carousel-item active carousel-item2">
                    <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 2a">
                </div>
                <div class="carousel-item carousel-item2">
                    <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 2b">
                </div>
                <div class="carousel-item carousel-item2">
                    <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 2c">
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
                    <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 2a">
                </div>
                <div class="carousel-item carousel-item5">
                    <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 2b">
                </div>
                <div class="carousel-item carousel-item5">
                    <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 2c">
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
                    <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 2a">
                </div>
                <div class="carousel-item carousel-item6">
                    <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 2b">
                </div>
                <div class="carousel-item carousel-item6">
                    <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 2c">
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
                        <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1a">
                    </div>
                    <div class="carousel-item carousel-item7">
                        <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1b">
                    </div>
                    <div class="carousel-item carousel-item7">
                        <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1c">
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
                        <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1a">
                    </div>
                    <div class="carousel-item carousel-item8">
                        <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1b">
                    </div>
                    <div class="carousel-item carousel-item8">
                        <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1c">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-9">
    <s="text-center my-4">
        <div class="create-box-9">
        <div class="title-container-11">
                <h1 class="title-h1">GZEL</h1>
                <h3 class="title-h3">Digital Design and Printing</h3>
            </div>
        <div class="container-11">
    <div class="row">
        <!-- First Box with Carousel -->
        <div class="col-md-4 grid-box grid-box-11">
            <div id="carousel1" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000">
                <div class="carousel-inner">
                    <div class="carousel-item active carousel-item11">
                        <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1a">
                    </div>
                    <div class="carousel-item carousel-item11">
                        <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1b">
                    </div>
                    <div class="carousel-item carousel-item11">
                        <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1c">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-10">
                 <div class="text-center my-4">
                    <div class="create-box-10">  
                    <div class="title-container-10">
                <!-- H2 Heading with 'Log In' as a clickable link -->
                <h1 style="font-size:50px; margin-left:-250px; margin-top: 30px;">Create an account</h1>
                <h2 style="font-size:30px; margin-left:-210px; margin-bottom:50px;">Already have an account? 
                <a href="login.php" class="breadcrumb-link" style="font-size:25px; font-weight:bold;">Log In</a>
                </h2>
            </div>


    <form class="row g-3" action="createaccount.php" method="POST">
  <div class="col-md-6">
   
    <input type="text" name="firstname"  class="form-control-0" id="inputEmail4" placeholder="First name">
  </div>
  <div class="col-md-6">
    
    <input type="text" name="lastname" class="form-control-01" id="inputLastname" placeholder="Last name">
  </div>
  <div class="col-12">
    
    <input type="email" name="email" class="form-control-1" id="inputAddress" placeholder="Email">
  </div>
  <div class="col-12">
    
    <input type="password" name="password" class="form-control-2" id="inputpassword" placeholder="Enter your password">
  </div>

  <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">I agree to the
  <a href="login.php" class="breadcrumb-link" style="font-size:18px; font-weight:bold;">Terms & Conditions</a>
  </label>
</div>
      <button type="submit" class="btn btn-primary">Create account</button>
      <div class="col-md-6">
   
      <button type="submit" class="btn-1 btn-primary">
    <img src="icons/google.png" alt="Google Icon" style="width: 30px; height: 30px; margin-right: 20px; margin-top:-6px;">
    Google
</button>
  </div>
  <div class="col-md-6">
    
  <button type="submit" class="btn-01 btn-primary">
    <img src="icons/facebook.png" alt="Google Icon" style="width: 30px; height: 30px; margin-right: 20px; margin-top:-6px">
    Facebook
</button>
  </div>
  <div class="col-12"></div>
        </div>
    </div>
</div>



    </div>
</div>
<?php include('css/createaccountstyle.php'); ?>


