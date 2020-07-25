<?php
include '../connection.php';
date_default_timezone_set('Asia/Kolkata');
$cat = $_POST['category_name2'];
$sub_cat = $_POST['subcategory_name2'];
$desc = $_POST['subcategory_desc2'];
$sql =  "SELECT * FROM subcategories WHERE subcategory_title = '$sub_cat'";
if($result = $link ->query($sql))
{
    if($result->num_rows == 1)
    {
        echo "Sub-Category Already Exists";
        exit;
    }
}
else
{
    echo "Cannot Add Sub-Category";
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
    echo "Cannot Add Sub-Category";
    exit;
}
$sql =  "INSERT INTO subcategories (`parent_id`,`subcategory_title`,`subcategory_desc`) VALUES ('".$cat_id."','".$sub_cat."','".$desc."')";
if(!$result = $link ->query($sql))
{
    echo "Cannot Add Sub-Category";
    exit;
}
else
{
    echo "success";
}
?>