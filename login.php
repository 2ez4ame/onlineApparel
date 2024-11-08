<?php include('includes/header.php'); ?>
<?php
include('databaseconnection.php');

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error_message = "Both email and password fields are required.";
    } else {
        error_log("Email entered: " . $email);

        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $user_id;

                // Get firstname for session
                $stmt->close(); // Close previous statement
                $stmt = $conn->prepare("SELECT firstname FROM users WHERE id = ?");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $stmt->bind_result($firstname);
                $stmt->fetch();
                $_SESSION['firstname'] = $firstname;
                $stmt->close();

                // Redirect based on email
                if (strtolower($email) == '123@gmail.com') {
                    header("Location: admin-page.php");
                } else {
                    header("Location: userhome.php");
                }
                exit();
            } else {
                $error_message = "Invalid password. Please try again.";
                error_log("Invalid password entered for email: " . $email);
            }
        } else {
            $error_message = "No user found with that email address.";
            error_log("No user found with email: " . $email);
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="errorModalBody">
                <?php echo $error_message; ?>
            </div>
        </div>
    </div>
</div>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($error_message)): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    });
</script>
<?php endif; ?>

<!-- Styles -->
<style>
    .carousel-item1 img {
        object-fit: cover;
        border: 2px solid #28a745;
        border-radius: 15px;
        height: 500px;
    }
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
        height: 900px;
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
        height: 395px;
        object-fit: cover;
        border: 2px solid #28a745;
        border-radius: 15px;
    }
    .grid-box-6 {
        padding: 0px;
        border: 2px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
        height: 200px;
        width: 700px;
    }
    .carousel-item7 img {
        object-fit: cover;
        border: 2px solid #28a745;
        border-radius: 15px;
        height: 350px;
    }
    .grid-box-7 {
        padding: 0px;
        border: 5px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
        height: 350px;
        margin-left: -120px;
    }
    .carousel-item8 img {
        width: 740px !important;
        object-fit: cover;
        border-radius: 15px;
        height: 230px;
    }
    .grid-box-8 {
        border: 2px solid #28a745;
        width: 730px;
        height: 240px;
        border-radius: 15px;
        background-color: #f9f9f9;
        margin-top: 270px;
        margin-left: 330px;
    }
    .create-box-9 .form-text a {
        text-decoration: none;
    }
    .carousel {
        background-color: #f8f9fa;
    }
    .create-box {
        border: 2px solid #28a745;
        width: 730px;
        height: 350px;
        border-radius: 15px;
        background-color: #f9f9f9;
        display: inline-block;
        margin-top: 20px;
    }
    .create-box-9 {
        width: 700px;
        height: 750px;
        max-width: 1000px;
        margin: 0 auto;
        margin-left: 550px;
        padding: 10px;
        background-color: #74AB6E;
        border-radius: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }
    .create-box-9 .form-control {
        border-radius: 20px;
        margin-top: 60px;
        margin-left: -15px;
        font-size: 20px;
        padding: 20px;
        width: 100%;
        height: 80px;
        border-color: black;
        border-width: 2px;
        text-align: center;
        font-weight: bold;
    }
    .create-box-9 .form-text {
        color: white;
        margin-left: 400px;
        font-size: 18px;
        font-weight: bold;
        color: darkgreen;
        text-decoration: none;
    }
    .create-box-9 .form-label {
        margin-top: 15px;
        font-size: 60px;
        font-weight: bold;
        color: white;
    }
    .create-box-9 .form-label-1 {
        color: white;
        font-size: 35px;
        font-weight: bold;
    }
    .create-box-9 button {
        margin-top: 40px;
        margin-left: -15px;
        width: 650px;
        height: 70px;
        padding: 10px;
        font-size: 30px;
        font-weight: bold;
        margin-right: 10px;
        background-color: white;
        border-color: black;
        border-radius: 10px;
    }
    .create-box-9 {
        display: flex;
        align-items: center;
        padding: 40px;
    }
    .create-box-9 .btn {
        margin-top: 20px;
        padding: 15px;
    }
</style>
>

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
            <a href="create_page.php" class="btn btn-success btn-lg">Create</a>
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
    <div class="text-center my-4">
        <div class="create-box-9">
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
                <button type="submit" class="btn-1 btn-primary">G</button>
                <button type="submit" class="btn-2 btn-primary">F</button>
                <button type="submit" class="btn-3 btn-primary">E</button>
             </form>

            
        </div>
    </div>
</div>
