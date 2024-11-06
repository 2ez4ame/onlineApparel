<style>
     html,body {
  height: 100%;
 
  background-color: #D9D9D9; /* Optional: background color */
}
  .dashboard-container {
    display: grid;
    grid-template-columns: 1fr 1fr; 
    gap: 30px; 
    max-width: 1200px;
    width: 100%;
    margin-top: -670px;
    margin-left: -50px;
  }

  .small-box-container, .large-box-container {
    display: flex;
    flex-direction: column;
    gap: 20px; 
  }

  .large-box-container {
    margin-bottom: 10px;
    grid-row: span 2;
    width: 900px;
    position: relative; /* Added for positioning the profit text */
    display: flex;
    margin-top: 20px;
    flex-direction: column;
  }

  .overall-profit {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 16px;
    color: #4CAF50;
  }

  .dashboard-box {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
  }

  .small-box-container {
    margin-right: 30px; 
    padding: 0; 
    box-sizing: border-box; 
    width: 300px; 
    margin-left: 400px;
    margin-top: 20px;
  }

  .small-box-title {
    align-self: flex-start; 
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    color:#31511E;
  }

  .chart-container {
    position: relative;
    height: 400px; /* Increased height */
    width: 100%;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
  }

  .chart-container canvas {
    width: 100%; /* Ensure the canvas takes full width */
    height: 100%; /* Ensure the canvas takes full height */
  }

  .date-range-selector {
    margin-bottom: 10px;
  }

  .date-range-selector select {
    cursor: pointer; /* Apply cursor pointer to the select element */
  }

  #dateRange option{
    cursor: pointer;
  }

  .progress-bar-container {
    width: 100%;
    height: 10px;
    background-color: #e0e0e0;
    border-radius: 5px;
    overflow: hidden;
    padding: 2px;
  }

  .progress-bar {
    width: 45%;
    height: 100%;
    background-color: #4CAF50;
  }

  .history-box {
    display: flex;
    flex-direction: column;
    width: 100%;
  }

  .history-header {
    display: flex;
    justify-content: space-between;
    width: 100%;
    font-size: 16px;
    font-weight: bold;
    border-bottom: 1px solid #e0e0e0; /* Added separator */
    padding-bottom: 10px; /* Added padding for spacing */
    color:#31511E;
  }

  .history-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    width: 100%; /* Ensure the item takes full width */
  }

  .history-item .item-text {
    display: flex;
    align-items: center; /* Align items vertically */
    flex-grow: 1; /* Allow the text to take available space */
  }

  .history-item .item-time {
    text-align: right; 
    flex-shrink: 0; /* Prevent the time from shrinking */
    margin-left: 20px; /* Add space between text and time */
  }
  
  .icon {
    margin-top: 10px;
  }

  .stat-number{
    font-size: 45px;
    font-weight: bold;
    margin-right: 40px;
    margin-left: 40px; /* Added margin to the left */
  }

  .icons{
    margin-right: 25px;
  }

  .circle-box {
    width: 10px;
    height: 10px;
    background-color: #31511E;
    border-radius: 50%;
    display: inline-block;
    margin-right: 10px; /* Space between circle and text */
    vertical-align: middle; /* Align with text */
  }

  .circle-box span .hours{
    display: flex;
    justify-content: space-between;
  }

  .history-item span {
    display: flex;
    align-items: center; /* Align items vertically */
  }

  .showHistory{
    color: #4CAF50;
    cursor: pointer;
    border: none;
    background-color: transparent;
    padding:7px;
    border-radius: 5px;
    font-weight: bold;
  }
  .showHistory:hover{
    color: white;
    cursor: pointer;
    border: none;
    background-color: #508D4E;
    transition: 0.5s;
  }
  .history-item.hidden {
    display: none;
  }


  /* navbar --------------------------------*/
  .navbar {
  background-color: #fff; /* Adjust background color if necessary */
  padding: 20px;
  height: 75px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* For shadow effect */
}

.container {
  display: flex;
  
}

.btn-icon {
  border: none;
  padding: 0; /* Remove padding to eliminate extra space around the image */
  cursor: pointer;
  margin-left: -100px;
  margin-top:-19px;
  border-radius: 5px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5); /* For shadow effect */
}

.btn-icon img {
  display: block;
  border-radius: 5px;
  width: 60px;
  height: 50px;
  
}

.brand-text {
    display: flex;
  flex-direction: column;
  margin-left: -20px;
  margin-top: -55px;
}

.gz-text {
  font-size: 15px;
  margin: 0;
  margin-bottom: -10px;
  color: #9e9e9e; /* Adjust color as needed */
}

.container-notification{
    margin-right:50px;
    
}
.container-account{
    margin-right: 50px;
}

.center-text {
    text-align: center; 
    margin-top: 100px;
}
.display-1{
    font-weight: bold;
}
.btn-1{
    margin-top: 30px;
    height: 500px;
    width: 350px;
    border-radius: 20px;
}
.nav-link{
  margin-top:-25px;
  margin-right: 20px;

}


</style>