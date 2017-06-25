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
	<h2>Products</h2>
        <table width="%100">
        <tr>
        <th>Item Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Buy</th>
            <th>Add Review</th>
            <th>Read Reviews</th>
        </tr>
            <?php include('includes/dbc.php');
            $sql = "SELECT * FROM products ORDER BY id ASC";
            $result = mysqli_query($con, $sql);
            if($result == false){
                $error_message = mysqli_error($con);
                echo "<p>There has been a query error: $error_message</p>";
            }else{
                if(mysqli_num_rows($result)==0){
                    echo '<tr><td colspan="4">Sorry... No data</td></tr>';
                }else{
                    while ($row=mysqli_fetch_assoc($result)){
                        echo '<tr><td align="center">' . $row['title'] . '</td>';
                        echo '<td align="center">' . $row['description'] . '</td>';
                        echo '<td align="center">' . $row['price'] . '</td>';
                        echo '<td align="center"><a href="my_cart.php?id=' . $row['id'] . '">Add to Cart</a>';
                        echo '<td align="center"><a href="review.php?id=' . $row['id'] . '">Add Review</a>';
                        echo '<td align="center"><a href="read_reviews.php?">Read Reviews</a>';
                        echo '</tr>';
                    } // end while
                } // end else
            } // end if
            ?>
        </table>
	</section>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
