function Staff() {

    /**
     * This function gets a capstone based off of a username and then loads it into the view
     * @param username - the username of the persons capstone
     */
    this.getCapstone = function(username) {
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
            document.getElementById("staff-proj-det-username").innerText = json.username;
            capstoneUsername = json.username;
        });

        $.ajax({
            url: "/api/getCapstoneStatus/" + username,
            method: "get",
            dataType: "json"
        }).done(function (json) {
            document.getElementById("staff-cap-status").innerText = json.status_desc;
        });
    };

    /**
     * This function handles the generic modal for displaying the pending, rejected, and accepted proposals
     * @param ajaxUrlEndpoint - either approved, pending, or rejected depending on what button is selected
     */
    this.handleModal = function (ajaxUrlEndpoint) {
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
    };

    /**
     * The defense date modal has similar code the to handleModal function but the data is different so some variables
     * are changed to reflect that
     */
    this.defenseDateModal = function () {
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
            let ajaxAddition = $("<div>").tabulator({
                height: 500,
                layout: "fitColumns",
                columns: [
                    {title:"Username",field:"username"},
                    {title:"First Name",field:"first_name"},
                    {title:"Last Name",field:"last_name"},
                    {title:"Title",field:"title"},
                    {title:"Plagiarism Score",field:"plagerism_score"},
                    {title:"Type",field:"type"},
                    {title:"Defense Date",field:"defense_date"},
                    {title:"Status",field:"status"}
                ],
                rowClick: function (e, row) {
                    staff.getCapstone(row.getData().username);
                    $('#myModal').modal('hide');
                }
            });


            for (let i=0, len=json.length; i<len; i++) {
                $.ajax({
                    url: ajaxURLStart + "/api/getCapstoneStatus/" + json[i].username,
                    method: "get",
                    dataType: "json"
                }).done(function (status) {
                    json[i].status = status.status_desc;

                });

            }

            ajaxAddition.tabulator("setData", json);

            $(".modal-body").append(ajaxAddition);


        });
    };

    this.editStatusModal = function () {
        let status = document.getElementById("staff-cap-status").innerText;
        if (capstoneUsername !== "" && status === "Approved"){
            let modalBody = "";
            let statuses = [
                "Complete"
            ];
            $('#myModal').modal('show');

            modalBody += "<div class='col-sm-12'><div class='modal-cap-edit-status'>";
            modalBody += "<div class='col-sm-8'><div class='modal-cap-select-status'>";
            modalBody += "<select id='modal-cap-statuses-input'><option value='"+ statuses[0] +"'>" + statuses[0] + "</option>" +
                "</select>";
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
                        staff.getCapstone(username);
                        $('#myModal').modal('hide');
                    });
                })
            });
        }

    };
    this.viewStatusHistory = function () {
        let username = document.getElementById("staff-proj-det-username").textContent;

        if (username !== ""){
            $('#myModal').modal('show');


            $.ajax({
                url: ajaxURLStart + "api/getCapstoneId/" + username,
                method: "get",
                dataType: "json"
            }).done(function (cap_id) {
                $.ajax({
                    url: ajaxURLStart + "api/getCapstoneHistory/" + cap_id,
                    method: "get",
                    dataType: "json"
                }).done(function (json) {
                    let ajaxAdditon = $("<div>").tabulator({
                        height: 500,
                        layout: "fitColumns",
                        columns: [
                            {title:"Date",field:"date"},
                            {title:"Status",field:"status_desc"}
                        ]
                    });

                    ajaxAdditon.tabulator('setData',json);
                    $('.modal-body').html(ajaxAdditon);
                });


            });

        }
    };

    this.enterPlagScore = function () {
        if (capstoneUsername !== ""){
            let modalBody = "";
            $('#myModal').modal('show');

            modalBody += "<div class='col-sm-12'><div class='modal-cap-edit-plag-score'>";
            modalBody += "<div class='col-sm-8'><div class='modal-cap-enter-plag-score'>";
            modalBody += "<label>Enter Plag Score:</label>";
            modalBody += "<input type='text' id='modal-plag-score-input'>";
            modalBody += "</div></div>";
            modalBody += "<div class='col-sm-4'><div class='modal-cap-submit-plag-score'>";
            modalBody += "<button id='modal-cap-submit-plag-score-button'>Enter</button>";
            modalBody += "</div></div></div></div>";

            $(".modal-body").html(modalBody);

            $("#modal-cap-submit-plag-score-button").on('click',function () {
                let username = document.getElementById("staff-proj-det-username").innerText;
                let plagScore = document.getElementById("modal-plag-score-input").value;
                $.ajax({
                    url: ajaxURLStart + "api/getCapstoneByUsername/" + username,
                    method: "get",
                    dataType: "json"
                }).done(function (json) {
                    $.ajax({
                        url: ajaxURLStart + "app/setPlagScore/" + plagScore + "/" + json.id,
                        method: "get",
                        error: function () {
                            console.error("Error: Todd sucks at life");
                        }
                    }).done(function() {
                        staff.getCapstone(username);
                        $('#myModal').modal('hide');
                    });
                })
            });
        }
    };

    this.viewCompletedProjects = function () {
        $('#myModal').modal('show');

        $.ajax({
            url: ajaxURLStart + "api/getCapstonesByStatus/" + "Complete",
            method: "get",
            dataType: "json"
        }).done(function (json) {
            let ajaxAddition = $("<div>").tabulator({
                height: 500,
                layout: "fitColumns",
                columns: [
                    {title:"Username",field:"username"},
                    {title:"First Name",field:"first_name"},
                    {title:"Last Name",field:"last_name"},
                    {title:"Title",field:"title"},
                    {title:"Plagiarism Score",field:"plagerism_score"},
                    {title:"Type",field:"type"},
                    {title:"Defense Date",field:"defense_date"},
                    {title:"Status",field:"status"}
                ],
                rowClick: function (e, row) {

                    staff.getCapstone(row.getData().username);
                    $('#myModal').modal('hide');
                }
            });


            for (let i=0, len=json.length; i<len; i++) {
                $.ajax({
                    url: ajaxURLStart + "/api/getCapstoneStatus/" + json[i].username,
                    method: "get",
                    dataType: "json"
                }).done(function (status) {
                    json[i].status = status.status_desc;

                });

            }

            ajaxAddition.tabulator("setData", json);

            $(".modal-body").html(ajaxAddition);


        });
    }
}
let staff = new Staff();
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
    });

    $("#staff-complete-proj").on('click', function () {
        staff.viewCompletedProjects();
    });

    $(".project-status-edit-btn button").on('click', function () {
        staff.editStatusModal();
    });

    $(".project-status-history-btn button").on('click', function () {
        staff.viewStatusHistory();
    });

    $(".project-status-plag-btn button").on('click', function () {
       staff.enterPlagScore();
    })

});