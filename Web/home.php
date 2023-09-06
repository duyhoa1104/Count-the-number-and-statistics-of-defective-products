<?php
session_start();
$sname= "localhost";
$unmae= "root";
$password = "";
$db_name = "mydatabase";      // name database

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
?>

<?php 
}else{
     header("Location: index.php");
     exit();
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>HOME PAGE</title>
	<link rel="stylesheet" type="text/css" href="style.css">

     <style>
          body{
               display: flex;
               flex-direction: column;
               /* background-color: #bdc0c1; */
          }
     </style>

     <div id="header">
          <nav>
               <img class="logo_header" src="./img/logo_ute.png" />
               <h1 class="name_ht">HỆ THỐNG NHẬN DIỆN VÀ ĐẾM SẢN PHẨM LỖI CÚC ÁO </h1>
               <ul class="header_top_right">
                    <li><h1 class="login_user">User, <?php echo $_SESSION['username']; ?></h1></li> 
                    <li><a class="btn_logout" href="logout.php">Log out</a></li>
               </ul>
          </nav>
     </div>
</head>

<body >
    

     <div style="display: flex; flex-direction: column;" class="body22">
                    <div style="display: flex; align-items: center; background-color: #aaa; padding: 19px 10px ">
                         <form style="margin:0px 10px ;width: 40vh; height: 8vh;" class="TKTQ" action="home.php" method="" >
                              <!-- <input type="submit" name="submit"> -->
                              <button style="width: 40vh; height: 8vh; background-color:#5cdb95; font-weight: 700;	font-size: 22px; color: #4056a1;" name="submit">HOME</button>
                         </form>
                         <form style="margin:0px 10px ;width: 40vh; height: 8vh;" class="TKTQ" action="tongQuat.php" method="" >
                              <!-- <input type="submit" name="submit"> -->
                              <button style="width: 40vh; height: 8vh; background-color:#db8181; font-weight: 700;	font-size: 22px; color: #4056a1;" name="submit">THỐNG KÊ TỔNG QUÁT</button>
                         </form>
                         <form style="width: 40vh; height: 8vh; margin: 0px 5px;" class="TKCT" action="chiTiet.php" method="" >
                              <!-- <input type="submit" name="submit"> -->
                              <button style="width: 40vh; height: 8vh; background-color:#db8181; font-weight: 700;	font-size: 22px; color: #4056a1;" name="submit">THỐNG KÊ CHI TIẾT</button>
                         </form>
                         
                    </div>
     
               <div style="background-color: #bdc0c1;" class="card_table_box">
                    
                </div>
    </div>
</body>
</html>