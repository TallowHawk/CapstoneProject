<?php
?>

<main id="createAccount">
    <form method="POST"
          onsubmit="return true"
          action="">
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" id="firstName" name="fname" required>
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lname" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>

        <div class="radio">
            <label>
                <input type="radio" name="userType" id="student" value="student" checked>
                Student
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="userType" id="faculty" value="faculty">
                Faculty
            </label>
        </div>
        <div class="radio disabled">
            <label>
                <input type="radio" name="userType" id="staff" value="staff">
                Staff
            </label>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</main>