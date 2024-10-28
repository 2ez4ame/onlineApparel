<?php include('includes/header.php'); ?>

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
        height:350px;
    }
    /* Unique classes for each grid box */
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
        height:230px;
    }
    /* Unique classes for each grid box */
    .grid-box-8 {
    border: 2px solid #28a745; /* Green border */
    width: 730px; /* Same width as the image */
    height: 240px; /* Same height as the image */
    border-radius: 15px; /* Rounded corners */
    background-color: #f9f9f9; /* Light background */
    margin-top: 270px;
    margin-left: 330px;
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
    .btn{
        height: 100px;
        width: 670px;
        margin-top: 30px;
        background-color: #ffff;
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
</style>

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



