<?php 
   require("top.inc.php");
   if(isset($_GET["id"]) && $_GET["id"] != "") {
        $type = get_safe_value($con, $_GET["type"]);
        if($type == "status") {
            $operation = get_safe_value($con, $_GET["operation"]);
            $id = get_safe_value($con, $_GET["id"]);
            if($operation == "Active") {
                $status = 1;
            } else {
                $status = 0;
            }
            $update = "UPDATE categories SET status = '$status' WHERE id = '$id'";
            $res = mysqli_query($con, $update);
        }
    }

    if(isset($_GET['type']) && $_GET['type']=="delete") {
        $id = get_safe_value($con, $_GET['id']);
        $delete = "DELETE FROM categories WHERE id = '$id'";
        $result = mysqli_query($con, $delete);
    }

    $sql = "SELECT * FROM categories ORDER BY categories DESC";
    $result = mysqli_query($con, $sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Categories </h4>
                        <h4 class="box-link"><a href="manage_categories.php">Add Categories</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th class="avatar">Id</th>
                                        <th>Categories</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        while($row = mysqli_fetch_assoc($result))  {
                                    ?>
                                    <tr>
                                        <td class="serial"><?= $i ?></td>
                                        <td class="avatar">
                                            <?= $row['id'] ?>
                                        </td>
                                        <td><?= $row["categories"] ?> </td>
                                        <td><?php 
                                        if($row["status"] == 1) {
                                            echo "<span class='badge badge-complete'><a class='text-white' href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
                                        } else {
                                            echo "&nbsp;<span class='badge badge-pending'><a class='text-white' href='?type=status&operation=Active&id=".$row['id']."'>Deactive</a></span>";
                                        }
                                            echo "&nbsp;<span class='badge badge-primary'><a class='text-white' href='manage_categories.php?id=".$row['id']."'>Edit</a></span>";
                                            echo "&nbsp;<span class='badge badge-danger'><a class='text-white' href='?type=delete&id=".$row['id']."'>Delete</a></span>";
                                        ?>
                                        </td>
                                        
                                    </tr>
                                    <?php 
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require("footer.inc.php"); ?>