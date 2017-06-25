<!DOCTYPE html>
<html>
<head>
<title>My Gaming Products Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include('includes/header.inc');?>

<?php include('includes/nav.inc');?>

<div id="wrapper">


	<?php include('includes/aside.inc');?>


	<section>
<h2>The Reviews</h2>
        <table width="100%" cellpadding="5">
        <tr>
            <th>Product</th>
            <th>Name</th>
            <th>Review</th>
        </tr>
            <?php
            include ('includes/dbc.php');
            $query = "SELECT * FROM reviews ORDER BY id";
            $result = mysqli_query($con,$query);
            if($result == false){
                $error_message = mysqli_error();
                echo"<p>There has been a query error: $error_message</p>";
            }
            if(mysqli_num_rows($result)==0){
                echo "No one has written any reviews.<br><a href='review.php?'>Write a review</a>";
            }
            while($row=mysqli_fetch_assoc($result)){
                echo'<tr><td style="text-align:center;">' . $row['product_id'] . '</td>';
                echo '<td style="text-align:center;">' . $row['name'] . '</td>';
                echo '<td style="text-align:center;">' . $row['comment'] . '</td></tr>';
            }
            ?>
        </table>
        
	</section>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
