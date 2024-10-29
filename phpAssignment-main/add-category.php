<?php 
session_start();
error_reporting(0);
include 'include/config.php'; 

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
} else {

    // Add Category
    if (isset($_POST['submit'])) {
        $category = $_POST['category'];
        $sql = "INSERT INTO tblcategory (category_name) VALUES (:category)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        $msg = $lastInsertId > 0 ? "Category added successfully" : "Data not inserted successfully";
    }

    // Delete Category
    if (isset($_REQUEST['del'])) {
        $uid = intval($_GET['del']);
        $sql = "DELETE FROM tblcategory WHERE id = :id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $uid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Record deleted successfully');</script>";
        echo "<script>window.location.href='add-category.php'</script>";
    }

    // Edit Category
    if (isset($_POST['update'])) {
        $category_id = intval($_POST['category_id']);
        $category_name = $_POST['category_name'];
        $sql = "UPDATE tblcategory SET category_name = :category_name WHERE id = :category_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':category_name', $category_name, PDO::PARAM_STR);
        $query->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $query->execute();
        $msg = "Category updated successfully";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Categories</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl">
    <?php include 'include/header.php'; ?>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
    
    <main class="app-content">
        <h3>Categories</h3>
        <hr />

        <div class="row">
            <div class="col-md-6">
                <div class="tile">
                    <?php if ($msg) { ?>
                        <div class="alert alert-success"><?php echo htmlentities($msg); ?></div>
                    <?php } ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="category">Add Category</label>
                            <input type="text" name="category" id="category" class="form-control" placeholder="Enter Category Name">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
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
                                <th>No.</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM tblcategory";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;

                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo htmlentities($result->category_name); ?></td>
                                        <td>
                                            <a href="edit-category.php?cid=<?php echo htmlentities($result->id); ?>" class="btn btn-primary">Edit</a>
                                            <a href="add-category.php?del=<?php echo htmlentities($result->id); ?>" class="btn btn-danger">Delete</a>
                                            <a href="add-category.php" class="btn btn-secondary">Cancel</a>
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
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script src="js/plugins/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script>$('#sampleTable').DataTable();</script>
</body>
</html>
<?php } ?>
