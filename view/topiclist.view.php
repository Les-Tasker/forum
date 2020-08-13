<?php

function displayTopicList($topic)
{ ?>



<div class="main-content">
    <div class="search-container">
        <form class="form-inline" action="search.php" method="POST">
            <div class="input-group">
                <input type="text" class="form-control" name="search-string" placeholder="Search Topics" />
                <div class="input-group-append">
                    <button name="search-submit" type="submit" class="btn btn-secondary"><img src="./img/search.png"
                            alt="Search Icon"></button>
                </div>
            </div>
        </form>
    </div>

    <div class="outline">
        <div class="testpnt">
            <a href="course.php?campus=<?php echo $_GET['campus'] ?>">
                <h2><?php echo ucfirst($_GET['campus']) ?> - </h2>
            </a>
            <a href="category.php?campus=<?php echo $_GET['campus'] ?>&course=<?php echo $_GET['course'] ?>">
                <h2><?php echo ucfirst($_GET['course']) ?> - </h2>
            </a>
            <h2> <?php echo ucfirst($_GET['category']) ?></h2>





        </div>
        <div class="postnewtopic" onclick="topicNew()">
            <p>New Topic</p><img id="plus-icon-topic" src="img/plus.png" alt="Post Topic Icon" />
        </div>
        <div id="postnewtopic" class="topic-container hidden">

            <form action="topiclist.php" id="topic-form" method="post">
                <input type="hidden" name="campus" value="<?php echo $_GET['campus'] ?>">
                <input type="hidden" name="course" value="<?php echo $_GET['course'] ?>">
                <input type="hidden" name="category" value="<?php echo $_GET['category'] ?>">
                <h1>Topic Title</h1><input type="text" name="topic-title" id="topictitle" placeholder="Some text">
                <h1>Topic Content</h1>
                <textarea name="topic-body" id="topicbody" cols="30" rows="10" placeholder="Some text"></textarea>
                <div class="topic-form-buttons">
                    <button class="topic-form-cancel" type="button" onclick="topicNew2()">Cancel</button>
                    <button class="topic-form-submit" type="submit" name="topic-submit">Post</button>
                </div>
            </form>
        </div>
        <?php
            if (empty($topic)) {
            } else {
                foreach ($topic as $row) {
                    require_once "model/CommentHandler.class.php";
                    $title = substr($row['title'], 0, 50);
                    $getReplies = new CommentHandler;
            ?>
        <div class="forum-category">
            <img class="topic-logo" src="uploads/<?php echo $row['authorimg'] ?>" alt="Topic Logo">
            <div class="topic-title-desc">
                <a class="topic-title border-left"
                    href="topic.php?campus=<?php echo $_GET['campus'] ?>&course=<?php echo $_GET['course'] ?>&category=<?php echo $_GET['category'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($title, 0, 34) ?>...</a>

            </div>
            <div class="topic-post-count">
                <h6>Replies: <?php $getReplies->GetTopicRepliesHandler($row['id']) ?></h6>
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

        <?php }
            }
            ?>
    </div>
    <?php
}