<div class="login">
    <div class="col-sm-12">
        <div class="col-sm-4"></div>
        <div class="col-sm-4" id="errorDiv"></div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <form method="POST"
                  onsubmit="return true"
                  action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" required>
                </div>
                <input class="submitButton" type="submit">
            </form>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>
<script>
    if (<?php echo $errorBool ?>){
        $("#errorDiv").append(
            "<h3 class='loginError'>Error: Incorrect Username or Password</h3>"
        );
    }
</script>