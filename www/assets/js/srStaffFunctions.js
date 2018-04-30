Staff.prototype.srStaffEdit = function () {
    if (capstoneUsername !== ""){
        let modalBody = "";
        let statuses = [
            "Completed",
            "Approved",
            "Rejected",
            "Pending"
        ];
        $('#myModal').modal('show');

        modalBody += "<div class='col-sm-12'><div class='modal-cap-edit-status'>";
        modalBody += "<div class='col-sm-8'><div class='modal-cap-select-status'>";
        modalBody += "<select id='modal-cap-statuses-input'><option value='"+ statuses[0] +"'>" + statuses[0] + "</option>" +
            "<option value='" + statuses[1] + "'>" + statuses[1] + "</option>" +
            "<option value='" + statuses[2] + "'>" + statuses[2] + "</option></select>";
        modalBody += "</div></div>";
        modalBody += "<div class='col-sm-4'><div class='modal-cap-update-status'>";
        modalBody += "<button id='modal-cap-update-status-button'>UPDATE</button>";
        modalBody += "</div></div></div></div>";

        $(".modal-body").html(modalBody);

        $("#modal-cap-update-status-button").on('click',function () {
            let username = document.getElementById("staff-proj-det-username").innerText;
            let statusUpdate = document.getElementById("modal-cap-statuses-input").value;
            $.ajax({
                url: ajaxURLStart + "api/getCapstoneByUsername/" + username,
                method: "get",
                dataType: "json"
            }).done(function (json) {
                $.ajax({
                    url: ajaxURLStart + "app/updateStatus/" + statusUpdate + "/" + json.id,
                    method: "get"
                }).done(function() {
                    Staff.getCapstone(username);
                    $('#myModal').modal('hide');
                });
            })
        });
    }
};

$(document).ready(function () {
    $(".project-status-edit-btn button").on('click', function () {
        Staff.prototype.srStaffEdit();
    });
});