<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "admin";
 $conn = new mysqli($servername, $username, $password, $dbname);

 $sql = "SELECT * FROM `product`";
 $result=mysqli_query($conn,$sql);
 $output="";
 if(mysqli_num_rows($result)>0){
    $output='<table border="1" width="100%" cellspacing="0" my-6 cellpadding="0">
                <tr>
                    <th width="100px">ID</th>
                    <th width="100px">Name</th>
                    <th width="300px">describtion</th>
                    <th width="90px">image</th>
                    <th width="80px">price</th>
                    <th width="100px">Category</th>
                    <th width="100px">Delete</th>
                </tr>  
            ';
 
            while($row=mysqli_fetch_assoc($result)){
                $output.="
                <tr>
                    <td>$row[sno]</td>
                    <td>$row[pname]</td>
                    <td>$row[description]</td>
                    <td><img src='$row[image]' height='90px' width'90px'></td>
                    <td>$row[price]</td>
                    <td>$row[category]</td>
                    <td><button  class='btn btn-outline-danger delete-btn'data-id='$row[sno]'>DELETE</button></td>     
                </tr>";
            }
    $output.='</table>';
    mysqli_close($conn);
    echo $output;
 }else{
    echo"No Data Here";
 }
 
?>                           