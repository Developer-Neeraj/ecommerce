<?php
    require("top.inc.php"); 
    $msg = "";
    if(isset($_GET['id']) && $_GET['id']!="") {
        $id = get_safe_value($con, $_GET['id']);
        $select = "SELECT * FROM categories WHERE id='$id'";
        $result = mysqli_query($con, $select);
        if(mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_assoc($result);
            $cat = $row["categories"];
        } else {
            header("location: categories.php");
            die();
        }
    }
    if(isset($_POST["submit"])) {
        $categorie = get_safe_value($con, $_POST["Categorie"]);
        $select = "SELECT * FROM categories WHERE id='$categorie'";
        $result = mysqli_query($con, $select);
        if(mysqli_num_rows($result)>0) { 
            $msg = "Categories Already Exists";
        }
         else {
            if(isset($_GET['id']) && $_GET['id']!="") {
                mysqli_query($con, "UPDATE categories SET categories='$categorie' WHERE id='$id'");
            } else {
                mysqli_query($con, "INSERT INTO categories(`categories`, `status`) VALUES('$categorie', 1)");  
            }
            header("location: categories.php");
            die();
        }
    }
    ?>
    <div class="content pb-0">
        <div class="animated fadeIn">
           <div class="row">
              <div class="col-lg-12">
                 <div class="card">
                    <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                    <div class="card-body card-block">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <div class="form-group">
                                <label for="company" class=" form-control-label">Categorie</label>
                                <input type="text" value="<?= $cat ?>" id="company" name="Categorie" placeholder="Enter your categorie name" class="form-control" required>
                            </div>
                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                        </form>
                        <?= $msg ?>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
<?php 
    require("footer.inc.php");
?>
