
<?php
session_start();
include ('../connection.php');
include ('comments.php');
if(!array_key_exists("adminemail",$_SESSION))
{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Ultimate Designs</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <form id = "logoutform" method = "POST">
                            <input name = "logout" type="hidden" value = "true" /> 
                            <button id = "logout" type = "button" class="dropdown-item">Logout</button>
                        </form>
                        
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="subscribers.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Subscribers
                            </a>
                            <a class="nav-link" href="users.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Users
                            </a>
                            <a class="nav-link" href="categories.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Categories - <?php echo displaycategoriesnum() ;?>
                            </a>
                            <a class="nav-link" href="categories.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Sub-Categories - <?php echo displaysubcategoriesnum() ;?>
                            </a>
                            <a class="nav-link" href="categories.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Topics - <?php echo displaytopicsnum() ;?>
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['adminemail'] ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Categories-Subcategories-Topics</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a style="color:black;" href = 'categories.php'>View More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Subscribers</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a style="color:black;" href = 'subscribers.php'>View More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Topics</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                            <?php echo displaytopicsnum() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div>
                        <div class="row">
                            <div class="col-xl-6">
<div class="container"><div class=" text-center mt-5 ">
        <h1>Add category</h1>
    </div>
    <div class="row ">
        <div class="col-lg-12 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="add_category" role="form" method="POST">
                            <div class="controls">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="category_name">Category Name*</label> <input id="category_name" type="text" name="category_name" class="form-control" placeholder="Category Name *" required="required" data-error="Category Name is required."> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="subcategory_name">Sub-Category Name*</label> <input id="subcategory_name" type="text" name="subcategory_name" class="form-control" placeholder="Sub Category Name *" required="required" data-error="Sub-Category Name is required."> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="subcategory_desc">Description *</label> <textarea id="subcategory_desc" name="subcategory_desc" class="form-control" placeholder="Write Sub-Category description here." rows="4" required="required" data-error="Sub-Category Description is required."></textarea> </div>
                                    </div>
                                    <div class="col-md-12"> <input type="submit" class="btn btn-success btn-send pt-2 btn-block " value="Add Category"> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>
                            </div>
                            <div class="col-xl-6">
<div class="container"> <div class=" text-center mt-5 ">
        <h1>Add Sub-Category</h1>
    </div>
    <div class="row ">
        <div class="col-lg-12 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="subcategory_form" role="form">
                            <div class="controls">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="category_name2">Please specify Category *</label> <select id="category_name2" name="category_name2" class="form-control" required="required" data-error="Please specify category.">
                                                <option value="" selected disabled>--Select Category--</option>
                                                    <?php displaycategories(); ?>
                                            </select> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="subcategory_name2">Sub-Category Name *</label> <input id="subcategory_name2" type="text" name="subcategory_name2" class="form-control" placeholder="Sub-Category Name *" required="required" data-error="Sub-Category Name is required."> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="subcategory_desc2">Sub-Category Description *</label> <textarea id="subcategory_desc2" name="subcategory_desc2" class="form-control" placeholder="Write Sub- Category Description Here." rows="4" required="required" data-error="Sub-Category Description is required."></textarea> </div>
                                    </div>
                                    <div class="col-md-12"> <input type="submit" class="btn btn-success btn-send pt-2 btn-block " value="Add Sub-Category"> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>
                        </div>
                            </div>
                            <br>
                            <br>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Comments
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Category</th>
                                                <th>Subcategory</th>
                                                <th>Topic</th>
                                                <th>Comment</th>
                                                <th>Date Posted</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                              <th>Username</th>
                                                <th>Category</th>
                                                <th>Subcategory</th>
                                                <th>Topic</th>
                                                <th>Comment</th>
                                                <th>Date Posted</th>
                                                <th>Delete</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php dispcomments(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script>
             $("#logout").click(function (event) {
            event.preventDefault();
            var datatopost = $("#logoutform").serializeArray();
  console.log(datatopost);
                     $.ajax({
                     url: "logoutcode.php",
                     type: "POST",
                     data: datatopost,
                     success: function (data) {
                         console.log(data);
                         location.href = "login.php";
    },
    error: function () {
            alert("Can't log out");
    },
             })
    })
            
        $("#add_category").submit(function (event) {
            event.preventDefault();
            var datatopost = $("#add_category").serializeArray();
            console.log(datatopost);
                     $.ajax({
                     url: "addcategory.php",
                     type: "POST",
                     data: datatopost,
                     success: function (data) {
                         if(data == "success")
                             {
                                 alert("Category Successfully Added");
                                 location.reload(true);
                             }
                         else if(data == "Category Already Exists")
                            {
                                  alert("Category Already Exists");
                            }
                        else if(data == "Cannot Add Category")
                            {
                                  alert("Cannot Add Category. Please try again later");
                            }
                         console.log(data);
    },
    error: function () {
            alert("Can't add category.Please Try Later");
    },
             })
    })
            
            $("#subcategory_form").submit(function (event) {
            event.preventDefault();
            var datatopost = $("#subcategory_form").serializeArray();
            console.log(datatopost);
                     $.ajax({
                     url: "addsubcategory.php",
                     type: "POST",
                     data: datatopost,
                     success: function (data) {
                         if(data == "success")
                             {
                                 alert("Sub-Category Successfully Added");
                                 location.reload(true);
                             }
                         else if(data == "Sub-Category Already Exists")
                            {
                                  alert("This Sub-Category Already Exists");
                            }
                        else if(data == "Cannot Add Sub-Category")
                            {
                                  alert("Cannot Add Sub-Category. Please try again later");
                            }
                         console.log(data);
    },
    error: function () {
            alert("Can't add sub-category.Please Try Later");
    },
             })
    })

        </script>
    </body>
</html>
