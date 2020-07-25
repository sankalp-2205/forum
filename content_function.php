<?php
	function dispcategories() {
		include ('dbconn.php');
		
		$select = mysqli_query($con, "SELECT * FROM categories");
		
		while ($row = mysqli_fetch_assoc($select)) {
			echo "<div class='forum-title'>
			<h3>".$row['category_title']."</h3>
			</div>";
			dispsubcategories($row['cat_id']);
		}
	}
	
	function dispsubcategories($parent_id) {
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT cat_id, subcat_id, subcategory_title, subcategory_desc FROM categories, subcategories 
									  WHERE ($parent_id = categories.cat_id) AND ($parent_id = subcategories.parent_id)");
        $add_topic_button = "";
		while ($row = mysqli_fetch_assoc($select)) {
                    if(array_key_exists("username",$_SESSION))
        {
            $add_topic_button = "<a href = '/forum-tutorial/newtopic/".$row['cat_id']."/".$row['subcat_id']."'>Add New Topic</a>";
        }
            else
            {
                $add_topic_button = "<a href = '/forum-tutorial/newtopic/".$row['cat_id']."/".$row['subcat_id']."'>Add New Topic</a>";
                
            }
			echo "
		<div class='forum-item active'>
			<div class='row'>
				<div class='col-xs-8'>
					<div class='forum-icon'>
						<i class='fa fa-star'></i>
					</div>
					<a href='/forum-tutorial/topics/".$row['cat_id']."/".$row['subcat_id']."' class='forum-item-title'>".$row['subcategory_title']."<br /></a>
					<div class='forum-sub-title'>".$row['subcategory_desc']."</div>
				</div>
				<div class='col-xs-1 forum-info'>
				<span class='views-number'>"
				.getnumtopics($parent_id, $row['subcat_id'])."
				</span>
				<div>
					<small>Topics</small>
				</div>
			</div>				<div class='col-xs-1 forum-info'>
			<span class='views-number'>"
			.getnumviews($parent_id, $row['subcat_id'])."
			</span>
			<div>
				<small>Views</small>
			</div>
		</div>
        <div class='col-xs-2 forum-info'>".$add_topic_button."
                
		</div>
			</div>
		</div>";
		}
	}
	
	function getnumtopics($cat_id, $subcat_id) {
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT category_id, subcategory_id FROM topics WHERE ".$cat_id." = category_id 
									  AND ".$subcat_id." = subcategory_id");
		return mysqli_num_rows($select);
	}

	function getnumviews($cat_id, $subcat_id) {
		include ('connection.php');
		$total_views = 0;
		$sql = "SELECT * FROM topics WHERE category_id = '$cat_id' AND subcategory_id = '$subcat_id'";
        if($result = $link ->query($sql))
        {
				while($rows = $result -> fetch_array(MYSQLI_ASSOC))
				{
					$total_views += $rows['views'];
				}
				return $total_views;			
		}
         else{
				return ("<div class='alert alert-danger'>Unable to return views</div>");
            }
		}
		
	function disptopics($cid, $scid) {
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT topic_id, author, title, date_posted, views FROM categories, subcategories, topics 
									  WHERE ($cid = topics.category_id) AND ($scid = topics.subcategory_id) AND ($cid = categories.cat_id)
									  AND ($scid = subcategories.subcat_id) ORDER BY topic_id DESC");
		if (mysqli_num_rows($select) != 0) {
echo "<div class='container mt-5'>
    <table class='table table-borderless table-responsive card-1 p-4'>
        <thead>
            <tr class='border-bottom'>
                <th> <span class='ml-2'>Title</span> </th>
                <th> <span class='ml-2'>Posted By</span> </th>
                <th> <span class='ml-2'>Date Posted</span> </th>
                <th> <span class='ml-2'>Views</span> </th>
                <th> <span class='ml-4'>City</span> </th>
            </tr>
        </thead>
        <tbody>";
			while ($row = mysqli_fetch_assoc($select)) {
				echo "<tr class='border-bottom'>
				<td>
				<div class='p-2'> <span class='d-block font-weight-bold'><a href='/forum-tutorial/readtopic/".$cid."/".$scid."/".$row['topic_id']."'>
				".$row['title']."</a> </div>
			</td>
			<td>
				<div class='p-2 d-flex flex-row align-items-center mb-2'>
					<div class='d-flex flex-column ml-2'> <span class='d-block font-weight-bold'>".$row['author']."</span></div>
				</div>
			</td>
			<td>
				<div class='p-2'> <span class='font-weight-bold'>".$row['date_posted']."</span> </div>
			</td>
			<td>
				<div class='p-2 d-flex flex-column'> <span>".$row['views']."</span></div>
			</td>
			<td>
				<div class='p-2 icons'>Pune</div>
			</td></tr>";
			}
			echo "</tbody></table></div>";
		} else {
			echo "<p>this category has no topics yet!  <a href='/forum-tutorial/newtopic/".$cid."/".$scid."'>
				 add the very first topic like a boss!</a></p>";
		}
	}
	
	function disptopic($cid, $scid, $tid) {
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT cat_id, subcat_id, topic_id, author, title, content, date_posted FROM 
									  categories, subcategories, topics WHERE ($cid = categories.cat_id) AND
									  ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id)");
		$row = mysqli_fetch_assoc($select);
		echo "<div class='comment-container row' style = 'margin-left: 15%; margin-right: 15%;'>
		<div class='col-sm-12'>
			<div class='panel panel-default'>
				<div class='panel-body'>
				   <section class='post-heading'>
						<div class='row'>
							<div class='col-md-11'>
								<div class='media'>
								  <div class='media-left'>
									<a href='#'>
									  <img class='media-object photo-profile' src='http://0.gravatar.com/avatar/38d618563e55e6082adf4c8f8c13f3e4?s=40&d=mm&r=g' width='40' height='40' alt='...'>
									</a>
								  </div>
								  <div class='media-body'>
									<a href='#' class='anchor-username'><h4 class='media-heading'>".$row['author']."</h4></a> 
									<span href='#' class='anchor-time'>".$row['date_posted']."</span>
								  </div>
								</div>
							</div>
						</div>             
				   </section>
				   <section class='post-body'>
					   <p>".$row['content']."</p>
				   </section>
				</div>
			</div>   
		</div>
	</div>";
	}
	
	function addview($cid, $scid, $tid) {
		include ('dbconn.php');
		$update = mysqli_query($con, "UPDATE topics SET views = views + 1 WHERE category_id = ".$cid." AND
									  subcategory_id = ".$scid." AND topic_id = ".$tid."");
	}
	
	function replylink($cid, $scid, $tid) {
		echo "<p><a href='/forum-tutorial/replyto/".$cid."/".$scid."/".$tid."'>Reply to this post</a></p>";
	}
	
	function replytopost($cid, $scid, $tid) {
		echo "<div class='containers px-10 py-10 mx-auto' style = 'margin-left: 20%; margin-right: 20%;'>
		<div class='row d-flex justify-content-center'>
			<div class='card-2 col-sm-12'>
				<div class='row px-3'> <img class='profile-pic mr-3' src='https://i.imgur.com/6tPhTUn.jpg'>
					<div class='flex-column'>
						<h3 class='mb-0 font-weight-normal'>".$_SESSION['username']."</h3> 
					</div>
				</div>
				<form action='/forum-tutorial/addreply.php' method='POST'>
				<input type = 'hidden' id='cid' name='cid' value='$cid' />
				<input type = 'hidden' id='scid' name='scid' value='$scid' />
				<input type = 'hidden' id='tid' name='tid' value='$tid' />
				<div class='row px-3 form-group'> <textarea name = 'comment' class='text-muted bg-light mt-4 mb-3' placeholder='Hi ".$_SESSION['username'].",what's on your mind today?'></textarea> </div>
				<div class='col-sm-12 px-3'>
					<div><input type = 'submit' class='btn btn-success ml-auto' value='Add Comment' /></div>
				</div>
				</form>
			</div>
		</div>
	</div>";
	}
	
	function dispreplies($cid, $scid, $tid) {
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT replies.author, comment, replies.date_posted FROM categories, subcategories, 
									  topics, replies WHERE ($cid = replies.category_id) AND ($scid = replies.subcategory_id)
									  AND ($tid = replies.topic_id) AND ($cid = categories.cat_id) AND 
									  ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id) ORDER BY reply_id DESC");
		if (mysqli_num_rows($select) != 0) {
			while ($row = mysqli_fetch_assoc($select)) {
			echo "
					<div class='comment-widgets' style = 'background-color: rgba(0, 0, 0, 0.05)'>
						<div class='d-flex flex-row comment-row'>
							<div class='p-2'><img src='https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583246/AAA/2.jpg' alt='user' width='50' class='rounded-circle'></div>
							<div class='comment-text w-100'>
								<h6 class='font-medium'>".$row['author']."</h6> <span class='m-b-15 d-block'>".$row['comment']."</span>
								<div class='comment-footer'> <span class='text-muted float-right'>".$row['date_posted']."</span> </div>
							</div>
						</div>
					</div>";
			}
			echo "</div>
			</div>
		</div>";
		}
	}
	
	function countReplies($cid, $scid, $tid) {
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT category_id, subcategory_id, topic_id FROM replies WHERE ".$cid." = category_id AND 
									  ".$scid." = subcategory_id AND ".$tid." = topic_id");
		return mysqli_num_rows($select);
	}

    function display_recent_topics()
    {
        include ('connection.php');
        $count = 0;
        $sql = "SELECT * FROM topics ORDER BY date_posted DESC";
        if($result = $link ->query($sql))
        {
            while($rows = $result->fetch_array(MYSQLI_ASSOC))
            {
                $subcat_id = $rows['category_id'];
                $cat_id =   $rows['subcategory_id'];
                $topic_id = $rows['topic_id'];
                $topic = $rows['title'];
                $content = $rows['content'];
                $count++;
                if($count < 4)
                {
                echo "
                <div class='forum-icon'>
						<i class='fa fa-star'></i>
					</div>
					<a href='/forum-tutorial/readtopic/".$cat_id."/".$subcat_id."/".$topic_id."' class='forum-item-title'>".$topic."<br /></a>
					<div class='forum-sub-title'>".$content."</div>
                    <hr>";
                
            }
        }         
    }
    }

        function display_recent_comments()
    {
        include ('connection.php');
        $count = 0;
        $sql = "SELECT * FROM replies ORDER BY date_posted DESC";
        if($result = $link ->query($sql))
        {
            while($rows = $result->fetch_array(MYSQLI_ASSOC))
            {
                $subcat_id = $rows['category_id'];
                $cat_id =   $rows['subcategory_id'];
                $topic_id = $rows['topic_id'];
                $reply_id = $rows['reply_id'];
                $author = $rows['author'];
                $comment = $rows['comment'];
                $count++;
                if($count < 4)
                {
                echo "
				   <div class='forum-icon'>
						  <i class='fa fa-star'></i>
					   </div>
					<a href='/forum-tutorial/readtopic/".$cat_id."/".$subcat_id."/".$topic_id."' class='forum-item-title'>".$comment."<br /></a>
					<div class='forum-sub-title'>".$author." - Pune</div>
                        <hr>";
                
            }
        }         
    }
	}
	
	function displayallcategories()
{
    include ('connection.php');
	 $sql = "SELECT * FROM categories";
	 $categories = "";
    if($result = $link ->query($sql))
    {
        while($rows = $result->fetch_array(MYSQLI_ASSOC))
        {
			$category = $rows['category_title'];
			$categories .= "<option>$category</option>";
		}
		echo $categories;
    }
    else
    {
        echo "Unable to run query";
    }
}


?>





















