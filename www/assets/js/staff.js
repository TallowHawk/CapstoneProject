let staff = {

    /**
     * This function gets a capstone based off of a username and then loads it into the view
     * @param username - the username of the persons capstone
     */
    getCapstone: function(username) {
        $.ajax({
            url: "/api/getCapstoneByUsername/" + username,
            method: "get",
            dataType: "json"
        }).done(function (json) {
            console.log(json);
            let projectDetails = document.getElementsByClassName("project-details-wrapper")[0];
            document.getElementById("staff-proj-det-name").innerText = json.first_name + " " + json.last_name;
            document.getElementById("staff-proj-det-title").innerText = json.title;
            document.getElementById("staff-proj-det-description").innerText = json.description;
            document.getElementById("staff-proj-det-defense").innerText = json.defense_date;
            document.getElementById("staff-cap-status-plag-score").innerText = json.plagerism_score;
            document.getElementById("staff-cap-status-grade").innerText = json.grade;
            capstoneUsername = json.username;
        });

        $.ajax({
            url: "/api/getCapstoneStatus/" + username,
            method: "get",
            dataType: "json"
        }).done(function (json) {
            document.getElementById("staff-cap-status").innerText = json.status_desc;
        });
    },

    /**
     * This function handles the generic modal for displaying the pending, rejected, and accepted proposals
     * @param ajaxUrlEndpoint - either approved, pending, or rejected depending on what button is selected
     */
    handleModal: function (ajaxUrlEndpoint) {
        let modalBody = "";
        modalBody += "<div class='col-sm-12 modal-labels'><div class='col-sm-4'><h3>Name</h3></div>";
        modalBody += "<div class='col-sm-4'><h3>Username</h3></div></div>";

        $(".modal-body").html(modalBody);
        $('#myModal').modal('show');

        $.ajax({
            url: ajaxURLStart + "api/getCapstonesByStatus/" + ajaxUrlEndpoint,
            method: "get",
            dataType: "json"
        }).done(function (json) {
            let ajaxAddition = "";
            console.log(json);

            $.each(json, function (i, ele) {
                ajaxAddition += "<div class='col-sm-12'><div class='modal-cap-project clearfix'>";
                ajaxAddition += "<div class='col-sm-4'><div class='modal-cap-title'>";
                ajaxAddition += "<h4>" + ele.title + "</h4></div></div>";
                ajaxAddition += "<div class='col-sm-4'><div class='modal-cap-username'>";
                ajaxAddition += "<h4>" + ele.username + "</h4></div></div>";
                ajaxAddition += "<div class='col-sm-4'><div class='modal-cap-view-div'>";
                ajaxAddition += "<button type='button' data-user='" + ele.username + "' name='modal-cap-view-btn'>VIEW</button>";
                ajaxAddition += "</div></div></div></div>";
            });
            $(".modal-body").append(ajaxAddition);

            $(".modal-cap-view-div button").attr('name', 'modal-cap-view-btn').on('click', function () {
                let username = $(this).attr("data-user");
                staff.getCapstone(username);
                $('#myModal').modal('hide');
            });
        });
    },

    /**
     * The defense date modal has similar code the to handleModal function but the data is different so some variables
     * are changed to reflect that
     */
    defenseDateModal: function () {
        let modalBody = "";
        modalBody += "<div class='col-sm-12 modal-labels'><div class='col-sm-4'><h3>Defense Date</h3></div>";
        modalBody += "<div class='col-sm-4'><h3>Title</h3></div></div>";

        $(".modal-body").html(modalBody);
        $('#myModal').modal('show');

        $.ajax({
            url: ajaxURLStart + "api/getCapstoneDefenseDates/",
            method: "get",
            dataType: "json"
        }).done(function (json) {
            let ajaxAddition = "";
            console.log(json);

            $.each(json, function (i, ele) {
                ajaxAddition += "<div class='col-sm-12'><div class='modal-cap-project clearfix'>";
                ajaxAddition += "<div class='col-sm-4'><div class='modal-cap-title'>";
                ajaxAddition += "<h4>" + ele.defense_date + "</h4></div></div>";
                ajaxAddition += "<div class='col-sm-4'><div class='modal-cap-username'>";
                ajaxAddition += "<h4>" + ele.title + "</h4></div></div>";
                ajaxAddition += "<div class='col-sm-4'><div class='modal-cap-view-div'>";
                ajaxAddition += "<button type='button' data-user='" + ele.username + "' name='modal-cap-view-btn'>VIEW</button>";
                ajaxAddition += "</div></div></div></div>";
            });
            $(".modal-body").append(ajaxAddition);

            $(".modal-cap-view-div button").attr('name', 'modal-cap-view-btn').on('click', function () {
                let username = $(this).attr("data-user");
                staff.getCapstone(username);
                $('#myModal').modal('hide');
            });
        });
    },

    editStatusModal: function () {
        let modalBody = "";


    }
};

let capstoneUsername = "";

$(document).ready(function() {
    $("#staff-pending-prop").on('click', function () {
        staff.handleModal("pending");
    });
    $("#staff-rej-prop").on('click', function () {
        staff.handleModal("rejected");
    });
    $("#staff-acc-prop").on('click', function () {
        staff.handleModal("approved");
    });

    $("#staff-defense-prop").on('click', function () {
        staff.defenseDateModal();
    })

});