<div class="login">
    <div class="col-sm-12">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 loginError" id="errorDiv"></div>
        <div class="col-sm-4"></div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
                <div class="form-group">
                    <label for="amount-accounts">Amount of Accounts</label>
                    <input type="number" id="amount-accounts" name="amount">
                </div>
            <button class="submitButton" id="makeAccounts">MakeAccounts</button>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>
<script>
    $("#makeAccounts").on('click',function () {
        let num = $("#amount-accounts").val();
        console.log("test");
        document.getElementById("errorDiv").innerText = "Working";
        console.log("<?php echo base_url(); ?>admin/createMassAccounts/" + num);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/createMassAccounts/" + num,
            method: "get"
        }).done(function (response) {
            document.getElementById("errorDiv").innerText = response;
        }).fail(function (error) {
            console.error(error);
            document.getElementById("errorDiv").innerText = "error";
        });
    });
</script>
