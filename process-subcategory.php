<?php
include("connection.php");

if(isset($_POST["category"])){

    $category= $_POST["category"];
    $categoryArr = [];
    $sql = "SELECT * FROM categories";
    if($result = $link ->query($sql))
    {
        $arr1 = "";
        while($rows = $result->fetch_array(MYSQLI_ASSOC))
        {
            $cat_id = $rows['cat_id'];
            $title = $rows['category_title'];
            $sql2 = "SELECT * FROM subcategories WHERE parent_id = '$cat_id'";
            if($result2 = $link ->query($sql2))
            {
                $arr2 = [];
                while($rows2 = $result2->fetch_array(MYSQLI_ASSOC))
                {
                    $subcat = $rows2['subcategory_title'];
                    array_push($arr2, $subcat);
                }
                $categoryArr[$title]= $arr2;
            }
        }
    }


     
    // Display city dropdown based on country name
    if($category !== '--Select Category--'){
        echo "<label for='subcategory'>Subcategory</label>
        <select class='form-control' name='subcategory' id='subcategory' required>;
        <option selected disabled>--Select Sub-Category--</option>";
        foreach($categoryArr[$category] as $value){
            echo "<option>". $value . "</option>";
        };
        echo "</select>";
    } 
}
?>