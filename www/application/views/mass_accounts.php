<div class="login">
    <div class="col-sm-12">
        <div class="col-sm-4"></div>
        <div class="col-sm-4" id="errorDiv"></div>
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
        let num = $("amount-accounts").val();
        $.ajax({
            url: "<?php echo base_url(); ?>admin/createMassAccounts/" + num,
            method: "post"
        });
    });
</script>
