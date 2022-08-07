<div id="inputTable">
    <form id="inputForm" action="" method="post">

        <h1>PLANT LIBRARY</h1>

        <div class="form-group col-md-4">
            <label class="textInput" for="name" style="margin-top: 10px">
                <h2>Name in LTU</h2>
                <input id="name" placeholder=" " class="form-control saveSubmit" pattern="[A-Za-zĄ ą Č č Ę ę Ė ė Į į Š š Ų ų Ū ū Ž ž]{3,15}" type="text"  name="name" <?= isset($_POST['edit']) ? 'value="' . $user->name . '"' : "" ?>">
                <ul class="input-requirements">
                    <li>At least 3 characters</li>
                    <li>No more than 15 characters</li>
                    <li>Only letters can be typed</li>
                </ul>
            </label>
        </div>
        <div class="errMessage">
            <?php
            session_start();
            if (isset($_SESSION['errName'])) {
                echo "<div class='alert alert-danger' style='text-align: center' role='alert'>" . (implode($_SESSION['errName']) . "</div>");
            }
            ?>
        </div>

        <div class="form-group col-md-4">
            <label class="textInput" for="surname" style="margin-top: 10px">
                <h2>Name in LOT</h2>
                <input id="surname" type="text" placeholder=" " class="form-control saveSubmit" pattern="[A-Za-z]{3,15}" name="surname" <?= isset($_POST['edit']) ? 'value="' . $user->surname . '"' : "" ?>>
                <ul class="input-requirements">
                    <li>At least 3 characters</li>
                    <li>Only letters can be typed</li>
                </ul>
            </label>
        </div>
        <div class="errMessage">
            <?php
            if (isset($_SESSION['errSurname'])) {
                echo "<div class='alert alert-danger' style='text-align: center' role='alert'>" . (implode($_SESSION['errSurname']) . "</div>");
            } ?></div>

            <fieldset >
            <h2>Class</h2>
            <label class="radioLabel "><input class="saveSubmit" id="tree" type="radio" name="bool" value="1"> Tree
            <label class="radioLabel "><input class="saveSubmit" id="nottree" type="radio" name="bool" value="0"> Not Tree</label>
            </fieldset>
        <div class="errMessage">
            <?php
            if (isset($_SESSION['errButton'])) {
                echo "<div class='alert alert-danger' style='text-align: center' role='alert'>" . (implode($_SESSION['errButton']) . "</div>");
            } ?></div>

        <div class="form-group col-md-4">
            <label class="textInput" for="age" style="margin-top: 10px">
                <h2>Age</h2>
                <input id="age" type="text" placeholder=" " class="form-control saveSubmit" pattern="[0-9 . ,]{1-5}" class="form-control" name="age" <?= isset($_POST['edit']) ? 'value="' . $user->age . '"' : "" ?>>
                <ul class="input-requirements">
                    <li>At least 1 character</li>
                    <li>No more than 5 characters</li>
                    <li>Only numbers can be typed</li>
                </ul>
            </label>
        </div>
        <div class="errMessage">
            <?php
            if (isset($_SESSION['errAge'])) {
                echo "<div class='alert alert-danger' style='text-align: center' role='alert'>" . (implode($_SESSION['errAge']) . "</div>");
            } ?>
        </div>

        <div class="form-group col-md-4">
            <label class="textInput" for="height" style="margin-top: 10px">
                <h2>Height</h2>
                <input id="height" type="text" placeholder=" " class="form-control saveSubmit" pattern="[0-9 . ,]{1-5}" class="form-control" name="height" <?= isset($_POST['edit']) ? 'value="' . $user->height . '"' : "" ?>>
                <ul class="input-requirements">
                    <li>At least 1 character</li>
                    <li>No more than 5 characters</li>
                    <li>Only numbers can be typed</li>
                </ul>
            </label>
        </div>
        <div class="errMessage">
            <?php
            if (isset($_SESSION['errHeight'])) {
                echo "<div class='alert alert-danger' style='text-align: center; ' role='alert'>" . (implode($_SESSION['errHeight']) . "</div>");
            }
            session_unset();
            ?>
        </div>

        <?= isset($_POST['edit']) ? '<input type="hidden" name="id" value="' . $user->id . '">' : "" ?>
        <button id="save" style="margin-top: 10px <?php if(isset($_POST['fromPerson']))?>" type="submit" class="save btn btn-primary " name=<?= isset($_POST['edit']) ? 
            '"update" >Update' : '"save" >Save' ?>
        </button>
        <button style="margin-bottom: 10px" type="button" class="list btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            See all list
        </button>
        <div id="formBottom"></div>
    </form>

</div>