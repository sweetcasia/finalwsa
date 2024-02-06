<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
   

 <style>
        body {
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(to bottom , #0f0c29, #302b63, #24243e);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            
        }

        .navbar {
           
            overflow: hidden;
            position: relative;
            justify-content:center;
            align-items:center;
            text-align: center; /* Center text */
           
        }

        .content img {
            display: block;
            margin: 150px auto 10px auto;
            max-width: 100%; 
            max-height: 100vh; 
        }


            
                .user-section {
            float: right;
            padding: 14px 16px;
            color: white;
            font-size: 16px;
        }

        .user-section a {
            display: inline-block; /* Change from block to inline-block */
            color: white;
            text-align: center;
            padding: 14px 16px; /* Adjust padding as needed */
            text-decoration: none;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }

            .navbar a,
            .user-section a {
                display: inline-block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                letter-spacing: 1px;
                transition: color 0.3s ease, background-color 0.3s ease; /* Smooth transition for color and background */
            }

            /* Hover effect for navbar links */
            .navbar a:hover {
                background-color: #ddd; /* Change background color on hover */
                color: black; /* Change text color on hover */
            }

          
            
        .navbar a {
            margin-right: 10px; /* Add margin between navbar links */
        }



            


        .content {
            padding: 16px;
        }

                

    </style>
    

</head>
<body>
<div class="navbar">
    <a href="index.php"><i class='bx bx-home'></i>Patient Registration</a>
    <a href="sched.php"><i class='bx bxs-user-check'></i>Schedules</a>
    <a href="app.php"><i class='bx bxs-notepad'></i>Appointments</a>
    
   
    
</div>
