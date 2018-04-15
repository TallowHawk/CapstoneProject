<?php
?>

<main id="createAccount">
    <form>
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" id="firstName">
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" id="lastName">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password">
        </div>
        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="text" class="form-control" id="phone">
        </div>

        <div class="radio">
            <label>
                <input type="radio" name="userType" id="student">
                Student
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="userType" id="faculty">
                Faculty
            </label>
        </div>
        <div class="radio disabled">
            <label>
                <input type="radio" name="userType" id="staff">
                Staff
            </label>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</main>