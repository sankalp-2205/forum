<?php
function dispcomments()
{
    include ('../connection.php');
    $sql = "SELECT * FROM replies ORDER BY date_posted DESC";
if($result = $link ->query($sql))
{
    while($rows = $result->fetch_array(MYSQLI_ASSOC))
    {
        $cid = $rows['category_id'];
        $scid = $rows['subcategory_id'];
        $tid = $rows['topic_id'];
       $sql2 =  "SELECT categories.category_title,topics.title, subcategories.subcategory_title, replies.reply_id,replies.author, comment, replies.date_posted FROM categories, subcategories, 
									  topics, replies WHERE ($cid = replies.category_id) AND ($scid = replies.subcategory_id)
									  AND ($tid = replies.topic_id) AND ($cid = categories.cat_id) AND 
									  ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id) ORDER BY reply_id DESC";
           if($result2 = $link ->query($sql2))
           {
            while($rows2 = $result2->fetch_array(MYSQLI_ASSOC))
            {
                echo "<tr>
                        <td>".$rows2['author']."</td>
                        <td>".$rows2['category_title']."</td>
                        <td>".$rows2['subcategory_title']."</td>
                        <td>".$rows2['title']."</td>
                        <td>".$rows2['comment']."</td>
                        <td>".$rows2['date_posted']."</td>
                      <td> <button name = delete_".$rows2['reply_id']."type='button'> Delete </button></td>
                     </tr>";
            }
           }
    }
}
}

function displaycategories()
{
    include ('../connection.php');
    $categories = "";
     $sql = "SELECT * FROM categories";
    if($result = $link ->query($sql))
    {
        while($rows = $result->fetch_array(MYSQLI_ASSOC))
        {
            $category = $rows['category_title'];
            $categories.= "<option>".$category."</option>";
        }
        echo $categories;
    }
}

function display_subscribers()
{
    include ('../connection.php');
     $sql = "SELECT * FROM subscribers WHERE status = 'active'";
    if($result = $link ->query($sql))
    {
        while($rows = $result->fetch_array(MYSQLI_ASSOC))
        {
            $name = $rows['subscriber_name'];
            $email = $rows['subscriber_email'];
            $contact = $rows['subscriber_contact'];
            $category_id = $rows['category_id'];
            $subcategory_id = $rows['subcategory_id'];
            $sql2 = "SELECT * FROM categories WHERE cat_id = '$category_id'";
            if($result2 = $link ->query($sql2))
            {
                while($rows2 = $result2->fetch_array(MYSQLI_ASSOC))
                {
                    $category = $rows2['category_title'];
                }
            }
            $sql2 = "SELECT * FROM subcategories WHERE subcat_id = '$subcategory_id'";
            if($result2 = $link ->query($sql2))
            {
                while($rows2 = $result2->fetch_array(MYSQLI_ASSOC))
                {
                    $subcategory = $rows2['subcategory_title'];
                }
            }
        echo "<tr>
        <td>".$name."</td>
        <td>".$email."</td>
        <td>".$contact."</td>
        <td>".$category."</td>
        <td>".$subcategory."</td> 
        </tr>";
        }
    }
    else
    {
        echo "Unable to run query";
    }
}

function display_users()
{
    include ('../connection.php');
     $sql = "SELECT * FROM users";
    if($result = $link ->query($sql))
    {
        while($rows = $result->fetch_array(MYSQLI_ASSOC))
        {
            $username = $rows['username'];
            $password = $rows['password'];
        echo "<tr>
        <td>".$username."</td>
        <td>".$username."</td>
        <td>".$username."</td>
        <td>".$password."</td>
        <td>".$password."</td> 
        </tr>";
        }
    }
    else
    {
        echo "Unable to run query";
    }
}


function displaycategoriesnum()
{
    include ('../connection.php');
     $sql = "SELECT * FROM categories";
    $count = 0;
    if($result = $link ->query($sql))
    {
        while($rows = $result->fetch_array(MYSQLI_ASSOC))
        {
            $count++;
        }
        echo $count;
    }
}

function displaysubcategoriesnum()
{
    include ('../connection.php');
     $sql = "SELECT * FROM subcategories";
    $count = 0;
    if($result = $link ->query($sql))
    {
        while($rows = $result->fetch_array(MYSQLI_ASSOC))
        {
            $count++;
        }
        echo $count;
    }
}

function displaytopicsnum()
{
    include ('../connection.php');
     $sql = "SELECT * FROM topics";
    $count = 0;
    if($result = $link ->query($sql))
    {
        while($rows = $result->fetch_array(MYSQLI_ASSOC))
        {
            $count++;
        }
        echo $count;
    }
}

function displayaccordion()
{
    include ('../connection.php');
    $cat_acc = "";
    $sql = "SELECT * FROM categories";
    if($result = $link ->query($sql))
    {
        while($rows = $result->fetch_array(MYSQLI_ASSOC))
        {
            $category = $rows['category_title'];
            $cat_id = $rows['cat_id'];
            $catid = str_replace(' ', '_', $category);
            $sql2 = "SELECT * FROM subcategories WHERE parent_id = '$cat_id'";
                if($result2 = $link ->query($sql2))
                {
                    $subcat_acc = "";
                    while($rows2 = $result2->fetch_array(MYSQLI_ASSOC))
                    {
                        $subcategory = $rows2['subcategory_title'];
                        $subcat_id = $rows2['subcat_id'];
                        $subcatid = str_replace(' ', '_', $subcategory);
                        $sql3 = "SELECT * FROM topics WHERE category_id = '$cat_id' AND subcategory_id = '$subcat_id'";
                        if($result3 = $link ->query($sql3))
                        {
                            $topic_acc = "";
                            while($rows3 = $result3->fetch_array(MYSQLI_ASSOC))
                            {
                                $topic = $rows3['title'];
                                $topicid = str_replace(' ', '_', $topic);
                                $topic_acc .= "$topic
                            <button style ='float:right;'>Delete Topic</button>
                            <br><br>";
                            }
                        }
                        if($topic_acc == "")
                        {
                            $topic_acc .= "No topic in this subcategory yet";
                        }
                        $subcat_acc .= " <div class='card'>
                        <div class='card-header'>
                            <a href='#' data-toggle='collapse' data-target='#collapse_".$subcatid."'>$subcategory</a>
                            <button style ='float:right;'>Delete Sub-Category</button>
                        </div>
                        <div class='card-body collapse' data-parent='#child".$catid."' id='collapse_".$subcatid."'>
                            $topic_acc
                        </div>
                    </div>";
                    }
                }
            $cat_acc .= "<div class='card-header' id='headingOne'><h5 class='mb-0 d-inline'>
            <button class='btn btn-link' data-toggle='collapse' data-target='#collapse_".$catid."' aria-expanded='true' aria-controls='collapse_".$catid."'>
                        $category
                    </button>
                    <button style ='float:right;'>Delete Category</button></h5></div>
                           <div id='collapse_".$catid."' class='collapse' aria-labelledby='heading_".$catid."' data-parent='#accordion'>
                <div class='card-body' id='child".$catid."'>
                        $subcat_acc
                </div>
            </div>";
        }
    }
    echo "$cat_acc";
}
?>