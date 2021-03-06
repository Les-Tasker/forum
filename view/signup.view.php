<main>
    <div class="wrapper-main">
        <section class="section-default">
            <div class="outline">
                <h1>Signup</h1>
                <form class="signup" action="signup.php" method="post">
                    <input type="text" name="uid" placeholder="Username">

                    <input type="text" name="fname" placeholder="First Name">

                    <input type="text" name="lname" placeholder="Last Name">

                    <select name="campus" id="signup-campus">
                        <option value="">Please select a campus</option>
                        <option value="Liverpool">Liverpool</option>
                        <option value="London">London</option>
                        <option value="Glasgow">Glasgow</option>
                        <option value="Oxford">Oxford</option>
                    </select>

                    <select name="course" id="signup-course">
                        <option value="">Please select a course</option>
                        <option value="Animation">Animation</option>
                        <option value="Audio">Audio</option>
                        <option value="Film">Film</option>
                        <option value="Game">Game</option>
                        <option value="Web">Web</option>
                        <option value="Music Business">Music Business</option>
                    </select>

                    <input type="email" name="mail" placeholder="SAE Student Email">

                    <input type="password" name="pwd" placeholder="Password">

                    <input type="password" name="pwd-repeat" placeholder="Repeat Password">
                    <button type="submit" name="signup-submit">Signup</button>
                </form>
                <?php include_once "controller/notify.cont.php";
                notify() ?>
            </div>
        </section>
    </div>
</main>