<?php
session_start();
include '../connection.php';
date_default_timezone_set('Asia/Kolkata');
$cat = $_POST['category_name'];
$sub_cat = $_POST['subcategory_name'];
$desc = $_POST['subcategory_desc'];
$sql =  "SELECT * FROM categories WHERE category_title = '$cat'";
if($result = $link ->query($sql))
{
    if($result->num_rows == 1)
    {
        echo "Category Already Exists";
        exit;
    }
}
else
{
    echo "Cannot Add Category";
    exit;
}
$sql =  "INSERT INTO categories (`category_title`) VALUES ('".$cat."')";
if(!$result = $link ->query($sql))
{
    echo "Cannot Add Category";
    exit;
}
$sql =  "SELECT * FROM categories WHERE category_title = '$cat'";
if($result = $link ->query($sql))
{
    while($rows = $result->fetch_array(MYSQLI_ASSOC))
    {
        $cat_id = $rows['cat_id'];
    }
}
else
{
    echo "Cannot Add Category";
    exit;
}
$sql =  "INSERT INTO subcategories (`parent_id`,`subcategory_title`,`subcategory_desc`) VALUES ('".$cat_id."','".$sub_cat."','".$desc."')";
if(!$result = $link ->query($sql))
{
    echo "Cannot Add Category";
    exit;
}
else
{
    echo "success";
}
?>