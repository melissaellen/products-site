<?php
session_start();
$user = $_SESSION['user'];
if(!isset($user)){
header("Location:admin_login.php");
}
?>

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
        <?php include('includes/dbc.php');
        $query = "SELECT * FROM home_page ORDER BY id DESC";
        $result = mysqli_query($con, $query);
        if($result == false){
            $error_message - mysqli_error();
            echo"<p>There has been a query error: $error_message</p>";
        }
        if(mysqli_num_rows($result)==0){
            echo "No content is available at this time. Please check back soon.";
        }
        while($row=mysqli_fetch_assoc($result)){
            if(isset($user)){
                echo '<div style="float:right; padding: 10px;">';
                echo '<a href="ajax_edit.php? id='.$row['id'].'&table=home_page">Edit</a>';
                echo '</div>';
            }
            echo '<h2>'.$row['title'].'</h2>';
            echo '<p>'.$row['message'].'</p>';
        }
        mysqli_free_result($result);
        mysqli_close($con);
        ?>

	</section>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
