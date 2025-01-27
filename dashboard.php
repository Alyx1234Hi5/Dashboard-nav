<!--php
session_start();
if (!isset($_SESSION['user_role'])) {
    header('Location: login.php'); //will redirect the user if user_role is not set
    exit();
} -->

<?php
           $con = mysqli_connect("localhost","root"," ","laundry_ms");
            if(!$con){
                echo "Disconected!" . mysqli_connect_error();
            }else{
                $sql = "SELECT * FROM graph";
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_array($result)){
                    $day[]=$row['day'];
                    $total[] = $row['total'];
                }
            }
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-hrmPO4HCmSpvwyuLWHX5z5xXkz8TjJU5pXcFpFQwqfOeG8Bl/5+PtcO87NNb5O4" crossorigin="anonymous">
    <link href='https://unpkg.com/@fullcalendar/core@5.10.1/main.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"/>

  <!--link for graph-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name = "viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="progress"></div>
    <div class = "wrapper">
    <Aside id="sidebar">
        <div class="top">
            <button id="btnMenu" type="button">
                <i class="bx bx-menu-alt-left"></i>
            </button>

            <div class="sidebar-logo">
                <a href="#">Azia Skye</a>
            </div>
        </div>

        <div class="user">
            <img src="/system/images/laundry_logo.png" alt="Profile" class="user-image">
            <div>
                <!-- <p class="bold">
                    <?php echo $_SESSION['username']; ?>
                </p>
                <p>
                    <?php echo ucfirst($_SESSION['user_role']) ?>
                </p> -->
            </div>
        </div>

        <ul>
            <li>
                <a href="/system/dashboard/dashboard.html">
                    <i class="bx bxs-grid-alt"></i>
                    <span class="nav-item">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>

            <li>
                <a href="/system/my profile/profile.html">
                    <i class='bx bxs-user'></i>
                    <span class="nav-item">Profile</span>
                </a>
                <span class="tooltip">Profile</span>
            </li>

            <li>
                <a href="/system/users/users.html">
                    <i class='bx bxs-group'></i>
                    <span class="nav-item">Users</span>
                </a>
                <span class="tooltip">Users</span>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                    data-bs-target="#records" aria-expanded="false" aria-controls="records">
                    <i class='bx bxs-folder-open'></i>
                    <span class="nav-item">Records</span>
                </a>

                <ul id="records" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Customer</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Service</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Category</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="/system/transaction/transaction.html">
                    <i class='bx bx-transfer-alt'></i>
                    <span class="nav-item">Transaction</span>
                </a>
                <span class="tooltip">Transaction</span>
            </li>

            <li>
                <a href="/system/sales report/report.html">
                    <i class='bx bx-line-chart'></i>
                    <span class="nav-item">Report</span>
                </a>
                <span class="tooltip">Report</span>
            </li>

            <li>
                <a href="/system/settings/settings.html">
                    <i class='bx bxs-cog'></i>
                    <span class="nav-item">Settings</span>
                </a>
                <span class="tooltip">Settings</span>
            </li>

            <!--<?php if ($_SESSION['user_role'] == 'admin'): ?> -->
            <li>
                <a href="/system/archive/archive.html">
                    <i class='bx bxs-archive-in'></i>
                    <span class="nav-item">Archived</span>
                </a>
                <span class="tooltip">Archived</span>
            </li>
            <!-- <?php endif; ?> -->

            <li>
                <a href="logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="nav-item">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>
    </Aside>
    </div>
    

    <div class="main-content">
        <div class="cards-container">
            <h1>Dashboard</h1>
            <div class="cards">
                <div class="card">
                    <h3>Pick-up request</h3>
                    <p id="pickup-orders">0</p>
                    <!--<div class="progress">
                        <svg>
                            <circle cx='38' cy='38' r='36'></circle>
                        </svg>
                        <div class="number">
                            <p>56%</p>
                        </div> -->
                </div>
                <div class="card">
                    <h3>Delivery request</h3>
                    <p id="delivery-orders"></p>
                </div>
                <div class="card">
                    <h3>Rush request</h3>
                    <p id="rush-orders"></p>
                </div>
            </div>

        </div>

        <div class="charts-container"> <!-- chart -->
          <div class = "charts">
            <div class="chart">
                <h3>Orders In Day</h3>
                <canvas id="daychart" width="230" height="235"></canvas>
            </div>

            <div class="chart">
                <h3>Orders In Week</h3>
                <canvas id="weekchart" width="230" height="200"></canvas>
            </div>

            <div class="chart">
                <h3>Orders In Month</h3>
                <canvas id="monthchart" width="230" height="200"></canvas>
            </div>

            <div class="chart">
                <h3>Orders In Year</h3>
                <canvas id="yearchart" width="350" height="235"></canvas>
            </div>
            </div>
        </div>
        
    


       <!--start new calendar-->
       <div class = "container">
        <div class ="left-side">
            <div class ="calendar">
            <div class ="month">
                <i class ="fa fa-angle-left prev"></i>
                <div class ="date">November 2024</div>
                <i class="fas fa-angle-right next"></i>
            </div>
            <div class = "weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
            
            <div class="days"></div>

    </div>
</div>
<!--events-->
<div class="right">
    <div class="today-date">
    <h2>Service event</h2>
     <div class="event-day">wed</div> 
      <div class="event-date"> August 30 2024</div>
    </div>
    <div class="events"></div>
        <div class="add-event-wrapper">
        <div class="add-event-header">
        <div class="title">Add Event</div>
        <i class="fas fa-times close"></i>
      </div>
      <div class="add-event-body">
        <div class="add-event-input">
          <input type="text" placeholder="Event Name" class="event-name" />
        </div>
        <div class="add-event-input">
          <input
            type="text"
            placeholder="Event Time From"
            class="event-time-from"
          />
        </div>
        <div class="add-event-input">
          <input
            type="text"
            placeholder="Event Time To"
            class="event-time-to"
          />
        </div>
      </div>
      <div class="add-event-footer">
        <button class="add-event-btn">Add Event</button>
      </div>
    </div>
  </div>
  <button class="add-event">Add Event</button>
</div>
</div> <!---end ng container-->
</div><!--end-->
    <!-- <div class="calendar">
        <div id="calendar"></div>
    </div> -->
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
<script src="dashboard.js"></script>

</html>