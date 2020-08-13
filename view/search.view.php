<?php

$dbConn = new DBConnHandler;
$conn = $dbConn->connectionHandler();
$search = mysqli_real_escape_string($conn, $_POST['search-string']);
$newSearch = new TopicHandler;
$searchResult = $newSearch->searchResultHandler($search);
echo '<div class="outline">';
if (!empty($searchResult)) {
    $getReplies = new CommentHandler;
    foreach ($searchResult as $row) { ?>

<div class="forum-category">
    <img class="topic-logo" src="uploads/<?php echo $row['authorimg'] ?>">
    <div class="topic-title-desc">
        <a class="topic-title border-left"
            href="topic.php?campus=<?php echo  $row['campus'] ?>&course=<?php echo $row['course'] ?>&category=<?php echo $row['category'] ?>&id=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a>


    </div>
    <div class="topic-post-count">
        <h6>Replies: <?php $getReplies->getTopicRepliesHandler($row['id']) ?></h6>
        <h6> Most Recent<br>
            <?php
                    if (!empty($row['recent'])) {
                        echo $row['recent'];
                    } else {
                        echo '-';
                    } ?>
        </h6>
    </div>

</div>

<?php
    } ?>
</div><?php
        } else { ?>
<h1>Nobody here but us chickens!</h1>
</div>
<?php }