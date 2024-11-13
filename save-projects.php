<?php 
include 'includes/header.php';
include 'databaseconnection.php';
?>
  <link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">
  <title>Saved Projects</title>
<style>
.saved-projects-container {
    display: flex;
    justify-content: center;
    padding: 10px 0;
}

.saved-projects {
    display: flex;
    align-items: center;
    padding: 30px 15px;
    background-color: white;
    border-bottom: 1px solid #ddd;
    max-width: 1400px; /* Adjust this value as needed */
    width: 100%;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.saved-projects .title {
    font-size: 30px;
    font-weight: bold;
    margin-right: 10px; /* Adjusted margin */
}

.saved-projects  {
    font-size: 20px;
    color: #55;
    text-decoration: none;
    margin-left: 5px;
}

.add-new {
  text-decoration: none; 
  
}

.add {
  width: 100px;
  height: 40px;
  font-size: 15px;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  background-color: #abf600;
  cursor: pointer;
  color: black;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  
  
}

.add i {
  margin-right: 5px; 
  text-decoration: none;
  
}

.add:hover {
  background-color: #9BCF53;
  cursor: pointer;
  transition: 0.2s;
}

/* Separator styling */
.saved-projects .separator {
    width: 1px;
    height: 40px; /* Adjust height if necessary */
    background-color: #000; 
    margin-right: 10px; /* Adjusted margin */
    font-weight: bold;
}
.images {
      display: flex;
      justify-content: flex-start;
      margin-left: 50px;
      align-items: center;
      gap: 70px;
      
    }
    .images div {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 10px;
      
    }
</style>

<div class="saved-projects-container">
    <div class="saved-projects">
        <span class="title">Saved Projects</span>
        <div class="separator"></div> <!-- Separator placed here -->
        <a href="customize.php" class="add-new">
            <button class="add">
                <i class='bx bx-plus' style="font-size:20px;"></i> Add new
            </button>
        </a>
    </div>
</div>

<div class="title-design">
  <br>
  <div class="images">
        <div>
         <div class="tshirtTitle">
          <h3>Test Design</h3>
          
          <h5>Tshirt small</h5>
         </div>
         <a href="customize.php">
         <img src="icons/tshirt.png" alt="tshirt">
         </a>
          
        </div>
        <div>
        <div class="tshirtTitle">
          <h3>Untitle Design</h3>
         
          <h5>Polo medium</h5>
        </div>
        <a href="customize.php">
         <img src="icons/tshirt.png" alt="tshirt">
         </a>
        </div>
   
      </div>
</div>

<?php include('css/userhomestyle.php'); ?>