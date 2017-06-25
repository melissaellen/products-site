<?php
session_start();
$review = $_COOKIE['MyGameReview'];
if (isset($_POST['clear'])){
    $expire = time() -60*60*24*7*365;
    setcookie("MyGameReview", $review, $expire);
    header("Location:review.php");
}
if($review && $_GET['id']){
    $review .= ',' . $_GET['id'];
    $expire = time() +60*60*24*7*365;
    setcookie("MyGameReview", $review, $expire);
    header("Location:review.php");
}
if(!$review && $_GET['id']){
    $review = $_GET['id'];
    $expire = time() +60*60*24*7*365;
    setcookie("MyGameReview", $review, $expire);
    header("Location:review.php");
}

if($review && $_GET['remove_id']){
    $removed_item = $_GET['remove_id'];
    $arr = explode(",", $review);
    unset($arr[$removed_item-1]);
    $new_review = implode(",",$arr);
    $new_review = rtrim($new_review, ",");
    $expire = time() +60*60*24*7*365;
    setcookie("MyGameReview", $new_review, $expire);
    header("Location:review.php");
}

if(isset($_POST['Submit_Review'])){
    $name = $_POST['theName'];
    $comment = $_POST['comment'];
    
    if($name==""){
        $nameMsg = "<br><span style='color:red;'>Your name cannot be blank.</span>";
    }
    if($comment==""){
        $commentMsg = "<br><span style='color:red;'>Your review cannot be blank.</span>";
    }else{
        include('includes/dbc_admin.php');
        $items = explode(',', $review);
            foreach($items AS $item){
                $sql = "SELECT * FROM products WHERE id = '$item'";
                $result = mysqli_query($con, $sql);
            }
        $query = "INSERT INTO reviews (product_id, name, comment) VALUES ('$sql', '$name', '$comment')";
        $success = mysqli_query($con, $query);
        if($success){
            $inserted = "<h2>Thanks!</h2>";
        }else{
            $error_message = mysqli_error($con);
            $inserted = "There was an error: $error_message";
            exit($inserted);
        }
    }
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
	<h2>Add a Review</h2>
        <?php if(isset($inserted)){
            echo $inserted;
            }else{
            ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form2" onSubmit="return validateForm()">
        <p>
            <label>Name:</label><br><input type="text" id="theName" name="theName" required>
            <?php if(isset($nameMsg)){
            echo $nameMsg;
            } ?>
            <br><span id="nameMsg" style="color:red"></span>
        </p>
        <p>
            <label>Comments:</label><br>
            <input type="text" id="comment" name="comment" required>
            <?php if(isset($commentMsg)){
            echo $commentMsg;
            } ?>
            <br><span id="commentMsg" style="color:red"></span>
        </p>
            <p>
            <label>Product:</label><br>
                <?php
            $review=$_COOKIE['MyGameReview'];
            if($review){
                $i = 1;
                include('includes/dbc.php');
                $items = explode(',', $review);
                foreach($items AS $item){
                    $sql = "SELECT * FROM products WHERE id = '$item'";
                    $result = mysqli_query($con, $sql);
                    if($result == false){
                        $mysql_error = mysqli_error($con);
                        echo "There was a query error: $mysql_error";
                    }else{
                        while($row=mysqli_fetch_assoc($result)){
                            echo '<tr><td>'.$row['title'].'</td><br>';
                            echo '<td><a href="review.php?remove_id='.$i.'">Cancel</a></td></tr>';
                        } // end while
                        $i++;
                    } // end else
                } // foreach loop
            } // end if
            ?> 
                    
            </p>
        <p>
            <input type="submit" name="Sumbit_Review" value="Sumbit">
        </p>
        </form> <?php } ?>
	</section>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
