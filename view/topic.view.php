<?php
if ($_GET['category'] && $_GET['campus'] && $_GET['course'] && $_GET['id']) {

    if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) { ?>

        <div class="main-content">
            <div class="search-container">
                <form class="form-inline" action="search.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search-string" placeholder="Search Topics" />
                        <div class="input-group-append">
                            <button name="search-submit" type="submit" class="btn btn-secondary">
                                <img src="./img/search.png">
                            </button>
                        </div>
                    </div>
                </form>
            </div><?php
                    echo '<div class="breadcrumbs">
              <a href="index.php">FRONT PAGE</a>' . " > " . '
              <a href="course.php?campus=' . strtoupper($_GET['campus']) . '">' . strtoupper($_GET['campus']) . '</a>' . " > " . '
              <a href="category.php?campus=' . strtoupper($_GET['campus']) . "&course=" . strtoupper($_GET['course']) . '">' . strtoupper($_GET['course']) . '</a>' . " > " . '
              <a href="topiclist.php?campus=' . strtoupper($_GET['campus']) . "&course=" . strtoupper($_GET['course']) . "&category=" . strtoupper($_GET['category']) . '">' . strtoupper($_GET['category']) . '</a>' . " > ";


                    if (empty($topic)) {
                    } else {
                        foreach ($topic as $row) {
                            $userid = $_SESSION['userId'];
                            $useruid = $_SESSION['userUid'];
                            $id = $_GET['id'];
                            $topicBody = nl2br($row['body']);
                            echo strtoupper($row['title']) ?>

        </div>
        <div class="forum-topic-post" id="<?php echo 'topic-' . $_GET['id'] ?>">
            <div class="forum-topic-post-poster">
                <img class="comment-img" src="uploads/<?php echo $row['authorimg'] ?>">
                <a class="forum-topic-post-poster-author" href="./viewprofile.php?author=<?php echo $row['author'] ?>"><?php echo $row['author'] ?>
                </a>
            </div>
            <div class="forum-topic-post-content">
                <h1><?php echo $row['title'] ?>
                    <hr>
                </h1>
                <p><?php echo $topicBody ?>
                </p>
                <h6>
                    <hr>Posted on: <?php echo $row['dateposted'] ?>
                    <br>Topic #<?php echo $_GET['id'] ?>
                </h6>
                <form class="edit-controls-form" action="model/editcomment.inc.php" method="POST">
                    <div class="edit-controls">
                        <input type="hidden" name="author" value="<?php echo $useruid ?>">
                        <input type="hidden" name="commentid" value="<?php echo $_GET['id'] ?>">
                        <input type="hidden" name="commentcontent" value="<?php echo $topicBody ?>">
                        <button id="test-btn" name="topic-quote-submit">Reply <img src="img/post-quote.png" alt=""> </button>
                        <?php
                            if ($useruid == $row['author']) { ?>
                            <button id="test-btn" name="topic-edit-submit">Edit <img src="img/post-edit.png" alt=""></button>
                            <button id="test-btn" name="topic-delete-submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete <img src="img/post-delete.png" alt=""></button>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
        <br><?php
                        }
                    }
                    if (empty($comment)) {
                    } else {
                        foreach ($comment as $row) {
                            $commentbody = $row['body'];
                            $commentid = $row['id'];
                            $poster = $row['author'];
                            $posterComment = nl2br($row['body']);
                            $posterDate = $row['posted'];
            ?>
        <div class="forum-topic-post" id="<?php echo 'post-' . $commentid ?>">
            <div class="forum-topic-post-poster">
                <img class="comment-img" src="uploads/<?php showUser($poster) ?>" />
                <a class="forum-topic-post-poster-author" href="./viewprofile.php?author=<?php echo $poster ?>"> <?php echo $poster ?> </a>
            </div>
            <div class="forum-topic-post-content">
                <p>
                    <?php echo $posterComment ?>
                </p>
                <h6>Posted on: <?php echo $posterDate ?><br>Post #<?php echo $commentid ?></h6>
                <form class="edit-controls-form" action="model/editcomment.inc.php" method="POST">
                    <div class="edit-controls">
                        <input type="hidden" name="author" value="<?php echo $poster ?>">
                        <input type="hidden" name="commentid" value="<?php echo $commentid ?>">
                        <input type="hidden" name="commentcontent" value='<?php echo $commentbody ?>'>

                        <button id="test-btn" name="comment-quote-submit">Reply <img src="img/post-quote.png" alt=""> </button>
                        <?php
                            if ($useruid == $row['author']) { ?>
                            <button id="test-btn" name="comment-edit-submit">Edit <img src="img/post-edit.png" alt=""></button>
                            <button id="test-btn" name="comment-delete-submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete <img src="img/post-delete.png" alt=""></button>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div><br><br>
<?php


                        }
                    } ?>

<form id="comment-form" action="model/comment.inc.php" method="POST">
    <h5>Reply</h5>
    <input type="hidden" name="author" value="<?php $userid ?>">
    <input type="hidden" name="topicid" value="<?php echo $id ?>">
    <textarea name="comment-body" id="comment-body" rows="3">
  <?php
        if (isset($_GET['quotecomment'])) {
            quote($_GET['quotecomment']);
        } elseif (isset($_GET['quotetopic'])) {
            Opquote($_GET['quotetopic']);
        } ?> </textarea>
    <button id="comment-body-submit" type="submit" name="comment-submit">Post</button>
</form>
<?php
    } else { ?>
    <div class="main-content-logout">
        <h1>You need to be logged in to view the forum</h1><br>
        <h1>If you have registered, please check your email to verify your account</h1><br><a href="signup.php">Click here to register</a>
    </div>

    </div><?php
            signup();
        }
    }
