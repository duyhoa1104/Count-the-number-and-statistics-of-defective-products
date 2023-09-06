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
	<title>Page Tong Quat</title>
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

          #piechart_3d{
               padding-left: 20%;
               width: 1200px; 
               height: 340px;
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

     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     
     

</head>
<body >
    

     <div style="" class="body22">
               <div style="" class="card_table_title">  
                    <div style="display: flex; align-items: center; background-color: #aaa; margin-left: 15px ">
                         <form style="width: 40vh; height: 8vh; margin: 0px 5px;" class="TKCT" action="home.php" method="" >
                              <!-- <input type="submit" name="submit"> -->
                              <button style="width: 40vh; height: 8vh; background-color:#db8181; font-weight: 700;	font-size: 22px; color: #4056a1;" name="submit">HOME</button>
                         </form>
                         <form style="margin:0px 10px ;width: 40vh; height: 8vh;" class="TKTQ" action="tongQuat.php" method="" >
                              <!-- <input type="submit" name="submit"> -->
                              <button style="width: 40vh; height: 8vh; background-color:#5cdb95; font-weight: 700;	font-size: 22px; color: #4056a1;" name="submit">THỐNG KÊ TỔNG QUÁT</button>
                         </form>
                         <form style="width: 40vh; height: 8vh; margin: 0px 5px;" class="TKCT" action="chiTiet.php" method="" >
                              <!-- <input type="submit" name="submit"> -->
                              <button style="width: 40vh; height: 8vh; background-color:#db8181; font-weight: 700;	font-size: 22px; color: #4056a1;" name="submit">THỐNG KÊ CHI TIẾT</button>
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

                            $conn = new mysqli($sname, $unmae, $password, $db_name);
                            if ($conn->connect_errno){
                                die("Connection failed: " . $conn_connect_error);
                            }
                        
                            if (isset($_POST['submit_search'])) {
                                   $inputDate = $_POST['search'];
                                   $cvt_date = date('Y_m_d', strtotime($inputDate));
                            
                                   //    $sql = "SELECT * FROM `mydata` WHERE Dayy='$cvt_date'"; 
                          
                                   # lan 1
                                   $query = "SELECT COUNT(*) AS datchuan FROM mydata WHERE error = 'dat chuan' AND Dayy='$cvt_date'";
                                   $result = mysqli_query($conn,$query);
                                   if (mysqli_num_rows($result) > 0){
                                   $row_d = mysqli_fetch_assoc($result);
                                   }
                                   # lan 2
                                   $query = "SELECT COUNT(*) AS loi1 FROM mydata WHERE error = 'loi 1' AND Dayy='$cvt_date'";
                                   $result1 = mysqli_query($conn,$query);
                                   if (mysqli_num_rows($result1) > 0){
                                   $row_l1 = mysqli_fetch_assoc($result1);     
                                   }
                                   # lan 3
                                   $query = "SELECT COUNT(*) AS loi2 FROM mydata WHERE error = 'loi 2' AND Dayy='$cvt_date'";
                                   $result2 = mysqli_query($conn,$query);
                                   if (mysqli_num_rows($result2) > 0){
                                   $row_l2 = mysqli_fetch_assoc($result2);   
                                   }
                                   $sum =  intval($row_d['datchuan']) + intval($row_l1['loi1']) + intval($row_l2['loi2']);
                                   ?>

                                   <script type="text/javascript">
                                        google.charts.load("current", {packages:["corechart"]});
                                        google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                             ['Task', 'Hours per Day'],
                                             ['Đạt chuẩn',     <?php echo $row_d['datchuan']?>],
                                             ['Lỗi màu',      <?php echo $row_l1['loi1']?>],
                                             ['Lỗi hình dạng',    <?php echo $row_l2['loi2']?>]
                                        ]);

                                        var options = {
                                             title: 'Số lượng loại sản phẩm mỗi ngày',
                                             
                                        };

                                        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                                        chart.draw(data, options);
                                        }
                                   </script>
                              
                                    <?php
                            
                                   if ($result){
                                        if ($row_d['datchuan'] != 0){
                                             echo '<h1 style=" padding: 1% 1%; color: #080c7f;">Kết quả tổng quát: '.$cvt_date.' </h1>';
                                             
                                             echo '<thead>
                                             <tr>
                                                  <th>TỔNG</th>
                                                  <th>ĐẠT CHUẨN</th>
                                                  <th>LỖI 1 (MÀU)</th>
                                                  <th>LỖI 2 (HÌNH DẠNG)</th>
                                             </tr>
                                             </thead>
                                             ';
                                             
                                             echo '<tbody>
                                             <tr>
                                                  <td>'.$sum.'</td>
                                                  <td>'.$row_d['datchuan'].'</td>
                                                  <td>'.$row_l1['loi1'].'</td>
                                                  <td>'.$row_l2['loi2'].'</td>
                                             </tr>
                                             </tbody>
                                             ';
                                             
                                             // echo '<div id="piechart_3d" style="width: 900px; height: 500px;"></div>';
                                             $flag = 1;
                                             
                                        }else{
                                             echo '<h1 style=" padding: 1% 1%; color: #080c7f;">No data found for: '.$cvt_date.'</h1>';
                                             $flag = 0;
                                        }
                                   }    // show result

                                   if ($row_d['datchuan'] != 0){
                                        echo '<div id="piechart_3d" style=" "></div>';
                                   }
                                   
                              } // search
                                   ?>  
                    </table>
                </div>   <!-- box table -->
               
    </div>  <!-- box result -->
</body>
</html>