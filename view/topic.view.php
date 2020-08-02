<?php
//Display manually added Forum Topics with the DB identifier of Aux
function displayAux($aux)
{
    if (empty($aux)) {
    } else {
        foreach ($aux as $row) {
            $topicBody = nl2br($row['body']); ?>
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
    </div>
    </form>
    <div class="outline">
        <div class="testpnt">
        </div>
        <div class="forum-topic-post">
            <div class="forum-topic-post-poster">
                <img class="comment-img" src="uploads/<?php echo $row['authorimg'] ?>">
                <a class="forum-topic-post-poster-author border-left"
                    href="./viewprofile.php?author=<?php echo $row['author'] ?>"><?php echo $row['author'] ?>
                </a>
            </div>
            <div class="forum-topic-post-content ">
                <h1><?php echo $row['title'] ?>
                </h1>
                <p><?php echo $topicBody ?>
                </p>

                <h6>
                    <hr>Posted on: <?php echo $row['dateposted'] ?>
                </h6>
            </div>
        </div>



        <?php }
        }
    }
    //Adds text input for Aux Topics, Currently not in use
    function displayReplyBox($comment)
    {
        if (empty($comment)) {
        } else {
            foreach ($comment as $row) {
                $useruid = $_SESSION['userUid'];
                $commentbody = $row['body'];
                $commentid = $row['id'];
                $poster = $row['author'];
                $posterComment = nl2br($row['body']);
                $posterDate = $row['posted'];
                $User = new UserHandler;
                $User->Get_user_info_by_username_Handler($poster); ?>
        <div class="forum-topic-post" id="<?php echo 'post-' . $commentid ?>">
            <div class="forum-topic-post-poster">
                <img class="comment-img" src="uploads/<?php echo $User->Userimage ?>" />
                <a class="forum-topic-post-poster-author border-left"
                    href="./viewprofile.php?author=<?php echo $poster ?>"> <?php echo $poster ?> </a>
            </div>
            <div class="forum-topic-post-content">
                <p>
                    <?php echo $posterComment ?>
                </p>

                <h6>Posted on: <?php echo $posterDate ?><br>Post #<?php echo $commentid ?></h6>
                <form class="edit-controls-form" action="topic.php" method="POST">
                    <div class="edit-controls">
                        <input type="hidden" name="author" value="<?php echo $poster ?>">
                        <input type="hidden" name="commentid" value="<?php echo $commentid ?>">
                        <input type="hidden" name="commentcontent" value='<?php echo $commentbody ?>'>
                        <button id="test-btn" name="comment-quote-submit">Reply
                            <img src="img/post-quote.png" alt="">
                        </button>
                        <?php
                                    if ($useruid == $row['author']) { ?>
                        <button id="test-btn" name="comment-edit-submit">Edit <img src="img/post-edit.png"
                                alt=""></button>
                        <button id="test-btn" name="comment-delete-submit"
                            onclick="return confirm('Are you sure you want to delete this post?')">Delete <img
                                src="img/post-delete.png" alt=""></button>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
        <?php }
        } ?>
        <form id="comment-form" action="model/comment.inc.php" method="POST">
            <h5>Reply</h5>
            <input type="hidden" name="author" value="<?php echo $_SESSION['userId'] ?>">
            <input type="hidden" name="topicid" value="<?php echo $_GET['id'] ?>">
            <textarea name="comment-body" id="comment-body" rows="3"
                placeholder="Post something..."><?php if (isset($_GET['quotecomment'])) {
                                                                                                                $NewCommentQuote = new CommentHandler;
                                                                                                                $NewCommentQuote->Comment_quote_process_Handler($_GET['quotecomment']);
                                                                                                            } elseif (isset($_GET['quotetopic'])) {
                                                                                                                $NewTopicQuote = new TopicHandler;
                                                                                                                $NewTopicQuote->Topic_quote_process_Handler($_GET['quotetopic']);
                                                                                                            } ?></textarea>

            <button id="comment-body-submit" type="submit" name="comment-submit">Post</button>
        </form>
    </div>
    <?php }

        //Function for displaying topics created by users
        function displayTopic($topic, $comment)
        { ?>
    <!-- General markup for displaying original topic post  -->
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
        </div>
        <div class="outline">
            <div class="testpnt">
            </div>
            <?php
                        //Loop for displaying all topics added by users
                        if (empty($topic)) {
                        } else {
                            foreach ($topic as $row) {
                                $userid = $_SESSION['userId'];
                                $useruid = $_SESSION['userUid'];
                                $id = $_GET['id'];
                                $topicBody = nl2br($row['body']);
                        ?>
            <div class="forum-topic-post" id="<?php echo 'topic-' . $_GET['id'] ?>">
                <div class="forum-topic-post-poster">
                    <img class="comment-img" src="uploads/<?php echo $row['authorimg'] ?>">
                    <a class="forum-topic-post-poster-author border-left"
                        href="./viewprofile.php?author=<?php echo $row['author'] ?>"><?php echo $row['author'] ?>
                    </a>
                </div>
                <div class="forum-topic-post-content ">
                    <h1><?php echo $row['title'] ?>
                        <hr>
                    </h1>
                    <!-- Class added to main content for Javascript function -->
                    <p id="<?php echo 'originaltopic-' . $id ?>"><?php echo $topicBody ?>
                    </p>
                    <!-- edit topic -->
                    <!-- Hidden form enabled by Javascript for editing topics -->
                    <form class="edit-comment-form hidden" id="<?php echo 'edittopic-' . $id ?>" action="topic.php"
                        method="POST">
                        <div class="edit-comment">
                            <input type="hidden" name="author" value="<?php echo $useruid ?>">
                            <input type="hidden" name="topic-id" value="<?php echo $id ?>">
                            <textarea name="topic-edit" id="edit-textarea" rows="10"><?php echo $topicBody ?></textarea>
                            <div class="buttons">
                                <button class="comment-edit-cancel" type="button"
                                    onclick="editTopicCancel(<?php echo $id ?>)">Cancel</button>
                                <button class="comment-edit-submit" type="submit" name="topic-edit-submit">Save</button>
                            </div>

                        </div>
                    </form>
                    <!-- edit topic -->
                    <h6>
                        <hr>Posted on: <?php echo $row['dateposted'] ?>
                        <br>Topic #<?php echo $_GET['id'] ?>
                    </h6>
                    <!-- Topic controls for interacting with posts -->
                    <form class="edit-controls-form" action="topic.php" method="POST">
                        <div class="edit-controls">
                            <input type="hidden" name="author" value="<?php echo $useruid ?>">
                            <input type="hidden" name="commentid" value="<?php echo $_GET['id'] ?>">
                            <input type="hidden" name="commentcontent" value="<?php $topicBody ?>">
                            <button id="test-btn" name="topic-quote-submit">Reply <img src="img/post-quote.png" alt="">
                            </button>
                            <?php
                                                // If logged in user is post author, enable additional controls for editing and deleting Posts/Topics
                                                if ($useruid == $row['author']) { ?>
                            <button onclick='editTopic(<?php echo $id ?>)' type="button" id="test-btn"
                                name="comment-edit-submit">Edit
                                <img src="img/post-edit.png" alt=""></button>
                            <button id="test-btn" name="topic-delete-submit"
                                onclick="return confirm('Are you sure you want to delete this post?')">Delete <img
                                    src="img/post-delete.png" alt=""></button>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
            <?php }
                        }
                        // If Topic has replies, loop through and display
                        if (empty($comment)) {
                        } else {

                            foreach ($comment as $row) {
                                $commentbody = $row['body'];
                                $commentid = $row['id'];
                                $poster = $row['author'];
                                $posterComment = nl2br($row['body']);
                                $posterDate = $row['posted'];
                                $User = new UserHandler;
                                $User->Get_user_info_by_username_Handler($poster); ?>
            <div class="forum-topic-post" id="<?php echo 'post-' . $commentid ?>">
                <div class="forum-topic-post-poster">
                    <img class="comment-img" src="uploads/<?php echo $User->Userimage ?>" />
                    <a class="forum-topic-post-poster-author border-left"
                        href="./viewprofile.php?author=<?php echo $poster ?>"> <?php echo $poster ?> </a>
                </div>
                <div class="forum-topic-post-content">
                    <!-- Id for Javascript funciton -->
                    <p id="<?php echo 'originalpost-' . $commentid ?>">
                        <?php echo $posterComment ?>
                    </p>
                    <!-- edit comment -->
                    <!-- Hideen for for Javascript function for ediditng posts -->
                    <form class="edit-comment-form hidden" id="<?php echo 'editcomment-' . $commentid ?>"
                        action="topic.php" method="POST">
                        <div class="edit-comment">
                            <input type="hidden" name="author" value="<?php echo $useruid ?>">
                            <input type="hidden" name="comment-id" value="<?php echo $commentid ?>">
                            <textarea name="comment-edit" id="edit-textarea"
                                rows="10"><?php echo $commentbody ?></textarea>
                            <div class="buttons">
                                <button class="comment-edit-cancel" type="button"
                                    onclick="editCommentCancel(<?php echo $commentid ?>)">Cancel</button>
                                <button class="comment-edit-submit" type="submit"
                                    name="comment-edit-submit">Save</button>
                            </div>
                        </div>
                    </form>
                    <!-- edit comment -->
                    <h6>Posted on: <?php echo $posterDate ?><br>Post #<?php echo $commentid ?></h6>
                    <!-- Controls for interacting with posts -->
                    <form class="edit-controls-form" action="topic.php" method="POST">
                        <div class="edit-controls">
                            <input type="hidden" name="author" value="<?php echo $poster ?>">
                            <input type="hidden" name="commentid" value="<?php echo $commentid ?>">
                            <input type="hidden" name="commentcontent" value='<?php $commentbody ?>'>
                            <button id="test-btn" name="comment-quote-submit">Reply <img src="img/post-quote.png"
                                    alt=""> </button>
                            <?php
                                                // If logged in user is post author, enable extra controls for editing and deleting
                                                if ($useruid == $row['author']) { ?>
                            <button onclick='editComment(<?php echo $commentid ?>)' type="button" id="test-btn"
                                name="comment-edit-submit">Edit
                                <img src="img/post-edit.png" alt=""></button>
                            <button id="test-btn" name="comment-delete-submit"
                                onclick="return confirm('Are you sure you want to delete this post?')">Delete <img
                                    src="img/post-delete.png" alt=""></button>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
            <?php }
                        } ?>
            <!-- Reply area for submitting posts to topic -->
            <form id="comment-form" action="topic.php" method="POST">
                <h5>Reply</h5>
                <input type="hidden" name="author" value="<?php $userid ?>">
                <input type="hidden" name="topicid" value="<?php echo $id ?>">
                <textarea name="comment-body" id="comment-body" rows="3"
                    placeholder="Post something..."><?php if (isset($_GET['quotecomment'])) {
                                                                                                                            $NewCommentQuote = new CommentHandler;
                                                                                                                            $NewCommentQuote->Comment_quote_process_Handler($_GET['quotecomment']);
                                                                                                                        } else if (isset($_GET['quotetopic'])) {
                                                                                                                            $NewTopicQuote = new TopicHandler;
                                                                                                                            $NewTopicQuote->Topic_quote_process_Handler($_GET['quotetopic']);
                                                                                                                        } ?></textarea>
                <button id="comment-body-submit" type="submit" name="comment-submit">Post</button>
            </form>
        </div>
        <?php
            }
// Global function for allowing unregistered users to signup