<?php
    if(!isset($_POST["subcategory"])){
        echo "Please Select A Subcategory";
        exit;
    }
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    
?>