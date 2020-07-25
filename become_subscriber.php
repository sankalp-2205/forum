
<?php
    include ('content_function.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Become A Subscriber</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>   
    </head>
    <body>
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <form id="apply" role="form" method="POST" action="#">

                    <legend class="text-center">Apply for subscriber</legend>

                    <fieldset>
                        <legend>Subscriber Details</legend>

                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" id="" placeholder="Email" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="contact">Contact Number</label>
                            <input type="number" class="form-control" name="contact" id="contact" placeholder="Contact Number" required>
                        </div>


                    </fieldset>

                    <fieldset>
                        <legend>Apply For</legend>

                        <div class="form-group col-md-6">
                            <label for="category">Category</label>
                            <select class="form-control category" name="category" id="category" required>
                                <option selected disabled>--Select Category--</option>
                                <?php displayallcategories(); ?>
                            </select>
                        </div>

                        <div id = "response" class="form-group col-md-6">
                            <label for="subcategory">Subcategory</label>
                            <select class="form-control" name="subcategory" id="subcategory" required>
                            <span id = "response"></span>
                            </select>
                        </div>
                    </fieldset>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">
                                Apply Now
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
    <script>
            $(document).ready(function(){
    $("select.category").change(function(){
        var selectedCategory = $(".category option:selected").val();
        $.ajax({
            type: "POST",
            url: "process-subcategory.php",
            data: { category : selectedCategory } 
        }).done(function(data){
            $("#response").html(data);
        });
    });
});

                    $("#apply").submit(function (event) {
            event.preventDefault();
            var datatopost = $("#apply").serializeArray();
            console.log(datatopost);
                     $.ajax({
                     url: "apply.php",
                     type: "POST",
                     data: datatopost,
                     success: function (data) {
                         if(data == "Please Select A category")
                         {
                             alert("Please Select A Category");
                         }
                         if(data == "Please Select A Subcategory")
                         {
                             alert("Please Select A SubCategory")
                         }
                        //  if(data == "success")
                        //      {
                        //          alert("Sub-Category Successfully Added");
                        //          location.reload(true);
                        //      }
                        //  else if(data == "Sub-Category Already Exists")
                        //     {
                        //           alert("This Sub-Category Already Exists");
                        //     }
                        // else if(data == "Cannot Add Sub-Category")
                        //     {
                        //           alert("Cannot Add Sub-Category. Please try again later");
                        //     }
                         console.log(data);
    },
    error: function () {
            alert("Can't apply right now.Please Try Later");
    },
             })
    })
    </script>
    </body>
    </html>