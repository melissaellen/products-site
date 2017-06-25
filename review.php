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

if(isset($_POST['Sumbit_Review'])){
    $name = $_POST['theName'];
    $comments = $_POST['theComments'];
    $prod_id = $_POST['product'];
    
    if($name==""){
        $nameMsg = "<br><span style='color:red;'>Your name cannot be blank.</span>";
    }
    if($comments==""){
        $commentsMsg = "<br><span style='color:red;'>Your review cannot be blank.</span>";
    }else{
        include('includes/dbc_admin.php');
        $query = "INSERT INTO reviews (product_id,name,comment) VALUES ('$prod_id','$name','$comments')";
        $success = mysqli_query($con, $query);
        if($success){
        $inserted = "<h2>Thanks!</h2><h3><a href='read_reviews.php?'>Read Reviews</a></h3>";
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
    
    <script type="text/javascript">
        function validateForm(){
            var theName = document.form2.theName.value;
            var theComments = document.form2.theComments.value;
            var nameMsg = document.getElementById('nameMsg');
            var commentsMsg = document.getElementById('commentsMsg');
            if(theName==""){
                nameMsg.innerHTML = "Your name cannot be blank."; return false;
            }
            if(theComments)==""){
                commentsMsg.innerHTML = "Your phone number cannot be blank."; return false;
            }
    </script>
</head>

<body>
<?php include('includes/header.inc');?>

<?php include('includes/nav.inc');?>

<div id="wrapper">


	<?php include('includes/aside.inc');?>


	<section>
	<h2>Write a Review</h2>
        <?php if(isset($inserted)){
            echo $inserted;
            }
            ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form2" onSubmit="return validateForm()">
        <p>
            <label>Name:</label><br><input type="text" id="theName" name="theName">
            <?php if(isset($nameMsg)){
            echo $nameMsg;
            } ?>
            <br><span id="nameMsg" style="color:red"></span>
        </p>
        <p>
            <label>Review:</label><br>
            <input type="text" id="theComments" name="theComments">
            <?php if(isset($commentsMsg)){
            echo $commentsMsg;
            } ?>
            <br><span id="commentsMsg" style="color:red"></span>
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
                            $GLOBAL = $row['id'];
                            echo '<tr><td>'.$row['id'].'</td><br>';
                            echo '<td><a href="review.php?remove_id='.$i.'">Cancel</a></td></tr><br>';
                        } // end while
                        $i++;
                    } // end else
                } // foreach loop
            } // end if
            ?>
                <br>*NOTE*<br>
                Make sure you select the correct radio button associated with the product you are wishing to review. Thank you. <br><br>
                <input type="radio" name="product" id="product1" value="1" required>1
                <input type="radio" name="product" id="product2" value="2">2<br>
            </p>
            
        <p>
            <input type="submit" name="Sumbit_Review" value="Sumbit">
        </p>

        </form> 
        
        
	</section>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>