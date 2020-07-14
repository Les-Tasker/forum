<?php

require './model/dbh.inc.php';
$search = mysqli_real_escape_string($conn, $_POST['search-string']);
$searchResult = searchResult($search);
if (!empty($searchResult)) {
    foreach ($searchResult as $row) { ?>
        <div class="forum-category">
            <img class="topic-logo" src="uploads/<?php echo $row['authorimg'] ?>">
            <div class="topic-title-desc">
                <a class="topic-title" href="topic.php?campus=<?php echo  $row['campus'] ?>&course=<?php echo $row['course'] ?>&category=<?php echo $row['category'] ?>&id=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a>
                <hr>
                <p>
                    <?php echo ucwords($row['campus']);
                    echo ucwords($row['course']);
                    echo ucwords($row['category']);
                    ?>
                </p>
            </div>
            <div class="topic-post-count">Replies:<?php topicReplyCount($row['id']) ?></div>
            <h6> Most Recent<br> <?php echo $row['recent'] ?></h6>
        </div>
    <?php
    }
} else { ?>
    <h1>Nobody here but us chickens!</h1>
<?php }
