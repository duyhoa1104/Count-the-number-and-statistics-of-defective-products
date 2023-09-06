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
	<title>Page Chi Tiet</title>
	<link rel="stylesheet" type="text/css" href="style.css">

     <style>
          body{
               display: flex;
               flex-direction: column;
               /* background-color: #dfd6d6; */
          }
          .card_table_title{
               display: flex;
               justify-content: space-between;
               background-color: #aaa;
               margin-left: 0; 
          }

          table tbody tr:nth-child(even){
               background-color:#c24646;	/*	#dfd6d6   rgb(232, 229, 229)   */
               
          }
          table tbody tr:nth-child(old){
               background-color:rgb(107, 179, 120);
          }
          h1{
               
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
    

     <div style="" class="body22">
               <div style="" class="card_table_title">  
                    <div style="display: flex; align-items: center; background-color: #aaa; margin-left: 10px ">
                         <form style="margin:0px 10px ;width: 40vh; height: 8vh;" class="TKTQ" action="home.php" method="" >
                              <!-- <input type="submit" name="submit"> -->
                              <button style="width: 40vh; height: 8vh; background-color:#db8181; font-weight: 700;	font-size: 22px; color: #4056a1;" name="submit">HOME</button>
                         </form>
                         <form style="margin:0px 10px ;width: 40vh; height: 8vh;" class="TKTQ" action="tongQuat.php" method="" >
                              <!-- <input type="submit" name="submit"> -->
                              <button style="width: 40vh; height: 8vh; background-color:#db8181; font-weight: 700;	font-size: 22px; color: #4056a1;" name="submit">THỐNG KÊ TỔNG QUÁT</button>
                         </form>
                         <form style="width: 40vh; height: 8vh; margin: 0px 5px;" class="TKCT" action="chiTiet.php" method="" >
                              <!-- <input type="submit" name="submit"> -->
                              <button style="width: 40vh; height: 8vh; background-color:#5cdb95; font-weight: 700;	font-size: 22px; color: #4056a1;" name="submit">THỐNG KÊ CHI TIẾT</button>
                         </form>
                         
                    </div>
                    
                    <div class="card_table_inputTypeDay">
                         <form style="background-color: #aaa" action="" method="post">
                              <!-- <label for="Input Date"></label> -->
                              <input type="date" name="search">
                              <!-- <input type="submit" name="submit"> -->
                              <button style="background-color: #4056a1" name="submit_search">Search</button>
                         </form>
                    </div>
               </div>
     
               <div style="" class="card_table_box">
                    <table id="table">
                        
                            <?php
                              $count = 1;
                            $conn = new mysqli($sname, $unmae, $password, $db_name);
                            if ($conn->connect_errno){
                                die("Connection failed: " . $conn_connect_error);
                            }
                        
                            if (isset($_POST['submit_search'])) {
                                $inputDate = $_POST['search'];
                                $cvt_date = date('Y_m_d', strtotime($inputDate));
                            
                            $sql = "SELECT id, error, Dayy, Timee, img_base64 FROM `mydata` WHERE Dayy='$cvt_date' AND error != 'dat chuan'"; 
                            $result = mysqli_query($conn,$sql);
                            if ($result){
                                if (mysqli_num_rows($result) > 0){
                                   echo '<h1 style=" padding: 1% 1%; color: #080c7f;">Kết quả chi tiết: '.$cvt_date.'</h1>';
                                    echo '<thead >
                                    <tr>
                                        <th>#</th>
                                        <th>ERROR</th>
                                        <th>IMAGE</th>
                                        <th>DAY</th>
                                        <th>TIME</th>
                                    </tr>
                                    </thead>
                                    ';
                                      while($row = mysqli_fetch_assoc($result)){
                                      echo '<tbody>
                                      <tr>
                                        <td>'.$count++ .'</td>
                                        <td>'.$row['error'].'</td>
                                        <td>
                                             <img style="width: 70px;" src="data:image/jpg;base64,'.$row['img_base64'].' " alt="error" >
                                        </td>
                                        <td>'.$row['Dayy'].'</td>
                                        <td>'.$row['Timee'].'</td>
                                      </tr>
                                      </tbody>
                                      ';
                                      }
                                      
                                }else{
                                   echo '<h1 style=" padding: 1% 1%; color: #080c7f;">No data found for: '.$cvt_date.'</h1>';
                                }
                            }
                            }
                            
                        
                            ?>  
                
                    </table>
                </div>
    </div>
     
</body>
</html>