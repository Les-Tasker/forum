<?php


if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    if ($_GET['category'] && $_GET['campus'] && $_GET['course']) { ?>



        <div class="main-content">
            <div class="search-container">
                <form class="form-inline" action="search.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search-string" placeholder="Search Topics" />
                        <div class="input-group-append">
                            <button name="search-submit" type="submit" class="btn btn-secondary"><img src="./img/search.png"></button>
                        </div>
                    </div>
                </form>
            </div>
            <?php echo '<div class="breadcrumbs">
                <a href="index.php">FRONT PAGE</a>' . " > " . '
                <a href="course.php?campus=' . strtoupper($_GET['campus']) . '">' . strtoupper($_GET['campus']) . '</a>' . " > " . '
                <a href="category.php?campus=' . strtoupper($_GET['campus']) . " &course=" . strtoupper($_GET['course']) . '">' . strtoupper($_GET['course']) . '</a>' . " > " . strtoupper($_GET['category']) . '</div>
            <div class="postnewtopic" onclick="topicnew()">
                <p>New Topic</p><img id="plus-icon-topic" src="img/plus.png" />
            </div>'; ?>
            <?php
            if (empty($topic)) {
            } else {
                foreach ($topic as $row) {
                    $campus = $_GET['campus'];
                    $course = $_GET['course'];
                    $category = $_GET['category'];
                    $title = substr($row['title'], 0, 50); ?>
                    <div class="forum-category">
                        <img class="topic-logo" src="uploads/<?php echo $row['authorimg'] ?>">
                        <div class="topic-title-desc">
                            <a class="topic-title" href="topic.php?campus=<?php echo $_GET['campus'] ?>&course=<?php echo $_GET['course'] ?>&category=<?php echo $_GET['category'] ?>&id=<?php echo $row['id'] ?>"><?php echo $title ?></a>
                            <hr>
                            <p></p>
                        </div>
                        <div class="topic-post-count">Replies:<?php topicReplyCount($row['id']) ?></div>
                        <h6 class="topic-post-recent"> Most Recent<br>
                            <?php if (!empty($row['recent'])) {
                                echo $row['recent'];
                            } else {
                                echo '-';
                            } ?></h6>
                    </div>
        <?php }
            }
        }
        ?><div id="postnewtopic" class="topic-container">
            <div class="closenewtopic" onclick="topicnew2()">
                <p>Close<img id="plus-icon-topic-close" src="img/plus.png" /></p>
            </div>
            <form action="./model/forum.model.php" id="topic-form" method="post">
                <input type="hidden" name="campus" value="<?php echo $_GET['campus'] ?>">
                <input type="hidden" name="course" value="<?php echo $_GET['course']  ?>">
                <input type="hidden" name="category" value="<?php echo $_GET['category']  ?>">
                <h1>Topic Title</h1><input type="text" name="topic-title" id="topictitle">
                <h1>Topic Content</h1>
                <textarea name="topic-body" id="topicbody" cols="30" rows="10"></textarea>
                <button type="submit" name="topic-submit">Post</button>
            </form>
        </div>
    <?php
} else { ?>
        <div class="main-content-logout">
            <h1>You need to be logged in to view the forum</h1><br>
            <h1>If you have registered, please check your email to verify your account</h1><br><a href="signup.php">Click here to register</a>
        </div>

        </div><?php
                signup();
            }
