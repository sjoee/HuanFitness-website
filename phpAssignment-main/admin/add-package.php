<?php 
session_start();
error_reporting(0);
include 'include/config.php'; 

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $AddPackage = $_POST['addPackage'];
        $category = $_POST['category'];
        if ($_POST['edit_id'] != "") {
            // Update existing package
            $sql = "UPDATE tblpackage SET PackageName=:Package, cate_id=:category WHERE id=:edit_id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':edit_id', $_POST['edit_id'], PDO::PARAM_INT);
        } else {
            // Add new package
            $sql = "INSERT INTO tblpackage (PackageName, cate_id) VALUES (:Package, :category)";
            $query = $dbh->prepare($sql);
        }
        $query->bindParam(':Package', $AddPackage, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->execute();

        if ($_POST['edit_id'] != "") {
            $msg = "Package updated successfully";
        } else {
            $lastInsertId = $dbh->lastInsertId();
            $msg = $lastInsertId > 0 ? "Package added successfully" : "Failed to add package";
        }
        echo "<script>window.location.href='add-package.php'</script>";
    }

    // Delete Record
    if (isset($_REQUEST['del'])) {
        $uid = intval($_GET['del']);
        $sql = "DELETE FROM tblpackage WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $uid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Record deleted successfully');</script>";
        echo "<script>window.location.href='add-package.php'</script>";
    }

    // Edit Package
    if (isset($_GET['edit'])) {
        $eid = intval($_GET['edit']);
        $sql = "SELECT * FROM tblpackage WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $eid, PDO::PARAM_STR);
        $query->execute();
        $editResult = $query->fetch(PDO::FETCH_OBJ);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin | Add Package Type</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl">
    <?php include 'include/header.php'; ?>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
    <main class="app-content">
        <h3>Package Types</h3>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <div class="tile">
                    <?php if ($msg) { ?>
                        <div class="alert alert-success"><?php echo htmlentities($msg); ?></div>
                    <?php } elseif ($errormsg) { ?>
                        <div class="alert alert-danger"><?php echo htmlentities($errormsg); ?></div>
                    <?php } ?>
                    
                    <form method="post">
                        <div class="form-group">
                            <label>Add Category</label>
                            <select class="form-control" name="category">
                                <option value="NA">--Select--</option>
                                <?php 
                                $stmt = $dbh->prepare("SELECT * FROM tblcategory ORDER BY category_name");
                                $stmt->execute();
                                $categories = $stmt->fetchAll();
                                foreach ($categories as $category) {
                                    $selected = ($category['id'] == @$editResult->cate_id) ? 'selected' : '';
                                    echo "<option value='".$category['id']."' $selected>".$category['category_name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Add Package</label>
                            <input class="form-control" name="addPackage" type="text" value="<?php echo @$editResult->PackageName; ?>" placeholder="Enter Package Name">
                            <input type="hidden" name="edit_id" value="<?php echo @$editResult->id; ?>">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <?php if (isset($_GET['edit'])) { ?>
                            <a href="add-package.php" class="btn btn-secondary">Cancel</a>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Category</th>
                                <th>Package</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM tblpackage JOIN tblcategory ON tblpackage.cate_id=tblcategory.id";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {
                            ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt); ?></td>
                                    <td><?php echo htmlentities($result->category_name); ?></td>
                                    <td><?php echo htmlentities($result->PackageName); ?></td>
                                    <td>
                                        <a href="add-package.php?edit=<?php echo htmlentities($result->id); ?>" class="btn btn-primary">Edit</a>
                                        <a href="add-package.php?del=<?php echo htmlentities($result->id); ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php $cnt++; } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/plugins/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script>$('#sampleTable').DataTable();</script>
</body>
</html>
 ?>
