let faculty = {
    checkInDatabase: function(username){
        inDatabase(username, function(inDatabase){
            if(inDatabase){
                $("#search-btn-error-msg").css("display", "none");
                faculty.getCapstone(username);
            }
            else{
                $("#search-btn-error-msg").css("display", "block");
            }
        });
    },

    getCapstone: function(username) {

        $.ajax({
            url: "/api/getCapstoneByUsername/" + username,
            method: "get",
            dataType: "json"
        }).done(function (json) {
            let projectDetails = document.getElementsByClassName("project-details-wrapper")[0];
            $(".cap-status-history-btn").css("display", "block");
            $(".cap-status-history-btn").on("click", function(){
                $.ajax({
                    url: "/api/getCapstoneHistory/" + json.id,
                    method: "get",
                    dataType: "json"
                }).done(function (jsonele) {
                    let field = "<div class='col-sm-12'><div class='col-sm-4'><h4>Defense Date</h4></div><div class='col-sm-4'><h4>Capstone Status</h4></div><div class='col-sm-4'><h4>Status Change Date</h4></div></div>";
                    $(".history-modal-body").html(field);
                    $.each(jsonele, function(i, ele){
                        let field = "";
                        field += "<div class='col-sm-12'><div class='faculty-capstone-history clearfix'>";
                        field += "<div class='faculty-capstone-history-field clearfix'>";
                        field += "<div class='col-sm-4'><div class='faculty-capstone-history-name'>";
                        field += "<h4>" + json.defense_date + "</h4>";
                        field += "</div></div>";
                        field += "<div class='col-sm-4'><div class='faculty-capstone-history-status'><p>" + ele.status_desc + "</p></div></div>"
                        field += "<div class='col-sm-4'><div class='faculty-capstone-history-date'><p>" + ele.date + "</p></div>"
                        field += "</div></div>";
                        field += "</div></div>";
                        $(".history-modal-body").append(field);
                    });
                    $("#history-modal").modal('show');
                });
            });


            $("#project-title-header").html(json.title);


            $.ajax({
                url: "/api/getCapstoneStatus/" + username,
                method: "get",
                dataType: "json"
            }).done(function (json2) {
                console.log(committeeData);
                console.log(json);
                $("#cap-status").html(json2.status_desc);
                let capstoneStatus = json2.status_desc;
                let approvedStatus = "approved";
                if(json.grade == null && capstoneStatus.toLowerCase() === approvedStatus.toLowerCase() && inCommittee(json)){
                    $(".cap-status-grade-btn").css("display", "block");
                    $(".cap-status-grade-btn").on("click", function(){
                        $("#grade-modal").modal('show');
                        $(".grade-modal-submit-button").on("click", function(){
                            let grade = $("#grade-input-selection").val();
                            if(grade != ""){
                                $.ajax({
                                    url: "/app/updateCapstoneGrade/" + grade + "/" + json.id,
                                    method: "get",
                                    dataType: "json"
                                }).done(function () {
                                    $.ajax({
                                        url: "/app/updateCapstoneStatus/Complete/" + json.id,
                                        method: "get",
                                        dataType: "json"
                                    }).done(function () {
                                        $.ajax({
                                            url: "/api/getCapstoneStatus/" + username,
                                            method: "get",
                                            dataType: "json"
                                        }).done(function (newStatus) {
                                            $("#cap-status").html(newStatus.status_desc);
                                            $.ajax({
                                                url: "/api/getCapstoneByUsername/" + username,
                                                method: "get",
                                                dataType: "json"
                                            }).done(function (newGrade) {
                                                $("#cap-status-grade").html(newGrade.grade);
                                            });
                                        });
                                        $("#grade-modal").modal('hide');
                                    });
                                });
                            }
                            else{
                                $(".grade-modal-error-div").html("<p style='color:red;'>Please enter a letter grade</p>");
                            }
                        })
                    });
                }
                else{
                    $(".cap-status-grade-btn").css("display", "none");
                    if(json.grade != null){
                        $("#cap-status-grade").html(json.grade);
                    }
                    else{
                        $("#cap-status-grade").html("N/A");
                    }
                }
            });
        });
    }
};


// ============================================================================================================================== BEGINS DOCUMENT READY
$(document).ready(function(){
    // fills in all of the invitation data if any
    if(invitationData.length == 0){
        $(".invitations-body").html("");
        $(".invitations-body").html("<div class='col-sm-12'><h3>No invitations at this time</h3></div>");
    }
    else{
        $(".invitations-body").html("");
        $.each(invitationData, function(i, ele){
            let field = "";
            field += "<div class='col-sm-12'><div class='faculty-committee-list clearfix'>";
            field += "<div class='faculty-committee-field clearfix'>";
            field += "<div class='col-sm-4 no-padding'><div class='faculty-committee-list-name'>";
            field += "<h4>" + ele.first_name + " " + ele.last_name + "</h4>";
            field += "</div></div>";
            field += "<div class='col-sm-4 no-padding'><div class='faculty-committee-list-cap-title'><p>" + ele.title + "</p></div></div>"
            field += "<div class='col-sm-4 no-padding'><div class='invitation-choice-wrapper clearfix'><div class='accepted-invite-btn-div'><button class='accepted-invite-btn' type='button' fac-id = " + facultyID + " cap-id='" + ele.cap_id + "' name='accept-invite-btn'>&#10004;</button></div>"
            field += "<div class='declined-invite-btn-div'><button class='declined-invite-btn' type='button' fac-id = " + facultyID + " cap-id='" + ele.cap_id + "' name='reject-invite-btn'>X</button></div></div></div>";
            field += "</div></div>";
            $(".invitations-body").append(field);
        });
    }


    // fills in all of the tracking data if any
    if(trackedInfo.length == 0){
        $(".tracking-list-body").html("");
        $(".tracking-list-body").html("<div class='col-sm-12'><h3>Nothing Being Tracked</h3></div>");
    }
    else{
        $(".tracking-list-body").html("");
        $.each(trackedInfo, function(i, ele){
            let field = "";
            field += "<div class='col-sm-12'><div class='faculty-tracking-list clearfix'>";
            field += "<div class='faculty-tracking-field clearfix'>";
            field += "<div class='col-sm-4 no-padding'><div class='faculty-tracking-list-name'>";
            field += "<h4>" + ele.first_name + " " + ele.last_name + "</h4>";
            field += "</div></div>";
            field += "<div class='col-sm-4 no-padding'><div class='faculty-tracking-list-cap-title'><p>" + ele.title + "</p></div></div>"
            field += "<div class='col-sm-4 no-padding'><div class='faculty-tracking-btn-wrapper clearfix'><div class='faculty-tracking-btn-div'><button class='faculty-tracking-btn' type='button' fac-id = " + facultyID + " cap-id='" + ele.cap_id + "' name='remove-tracking-btn'>Stop Tracking</button></div>"
            field += "</div></div>";
            field += "</div></div></div>";
            $(".tracking-list-body").append(field);
        });
    }


    // fills in the committee list data if any
    if(committeeData.length == 0){
        $(".committee-list-field").html("<div class='col-sm-12'><div class='no-committee-groups-msg'><h3>Not a part of any committees at this time</h3></div></div>");
    }
    else{
        let field = "";
        $.each(committeeData, function(i, ele){
            field += "<div class='col-sm-12'><div class='faculty-committee-list clearfix'>";
            field += "<div class='faculty-committee-field clearfix'>";
            field += "<div class='col-sm-4'><div class='faculty-committee-list-name'>";
            field += "<h4>" + ele.first_name + " " + ele.last_name + "</h4>";
            field += "</div></div>";
            field += "<div class='col-sm-4'><div class='faculty-committee-list-cap-title'><h4>" + ele.title + "</h4></div></div>"
            field += "<div class='col-sm-4'><div class='faculty-committee-list-remove-btn'><button class='fac-committee-remove-btn' fac-id = " + facultyID + " cap-id='" + ele.cap_id + "' name='fac-committee-remove-btn'>Leave Committee</button></div></div>";
            field += "</div></div></div>";
        });
        $(".committee-list-field").html(field);
    }


    $(".accepted-invite-btn").on('click', function(){
        console.log("Accepted invite first go round");
        var capID = $(this).attr("cap-id");
        var facID = $(this).attr("fac-id");

        $.ajax({
            url: ajaxURLStart + "app/updateAccepted/" + facID + "/" + capID,
            success:function(){
                updateInvitations(facID);
            },
            error: function(){
                console.log("There was an error in the ajax call to accept the invitation to a committee");
            }
        }).done(function(){
            $(".faculty-accept-invite-toast").fadeIn();
            setTimeout(function(){
                $(".faculty-accept-invite-toast").fadeOut();
            }, 3000);
            updateCommitteeList(facID);
        });
    });


    $(".declined-invite-btn").on('click', function(){
        var capID = $(this).attr("cap-id");
        var facID = $(this).attr("fac-id");
        $.ajax({
            url: ajaxURLStart + "app/removeFromCommittee/" + facID + "/" + capID,
            success:function(result){
                updateInvitations(facID);
            },
            error: function(){
                console.log("There was an error in the ajax call to decline the invitation to the committee");
            }
        }).done(function(){
            $(".faculty-decline-invite-toast").fadeIn();
            setTimeout(function(){
                $(".faculty-decline-invite-toast").fadeOut();
            }, 3000);
            updateCommitteeList(facID);
        });
    });



    $(".fac-committee-remove-btn").on('click', function(){
        var capID = $(this).attr("cap-id");
        var facID = $(this).attr("fac-id");
        $.ajax({
            url: ajaxURLStart + "app/removeFromCommittee/" + facID + "/" + capID,
            success:function(result){
                 $(".faculty-remove-from-committee-toast").fadeIn();
                 setTimeout(function(){
                     $(".faculty-remove-from-committee-toast").fadeOut();
                 }, 3000);
            },
            error: function(){
                console.log("There was an error in the ajax call to leave the committee as faculty");
            }
        }).done(function(){
            updateCommitteeList(facID);
        });
    });


    $(".faculty-tracking-btn").on('click', function(){
        var capID = $(this).attr("cap-id");
        var facID = $(this).attr("fac-id");
        $.ajax({
            url: ajaxURLStart + "app/removeFromTracker/" + facID + "/" + capID,
            success:function(result){
                $(".faculty-remove-from-tracker-toast").fadeIn();
                setTimeout(function(){
                    $(".faculty-remove-from-tracker-toast").fadeOut();
                }, 3000);
            },
            error: function(){
                console.log("There was an error in the ajax call to stop tracking a capstone");
            }
        }).done(function(){
            updateTrackingList(facID);
        });
    });



    $(".tracking-add-btn").on('click', function(){
        populateUntrackedCapstones();
        $('#myModal').modal('show');
    });
});




function updateInvitations(facID){
    $.ajax({
        url: ajaxURLStart + "api/getInvitations/" + facID,
        success:function(result){
            result = JSON.parse(result);
            console.log(result);
            if(result.length < 1){
                $(".invitations-body").html("");
                $(".invitations-body").html("<div class='col-sm-12'><h3>No invitations at this time</h3></div>");
            }
            else{
                $(".invitations-body").html("");
                $.each(result, function(i, ele){
                    let field = "";
                    field += "<div class='col-sm-12'><div class='faculty-committee-list clearfix'>";
                    field += "<div class='faculty-committee-field clearfix'>";
                    field += "<div class='col-sm-4 no-padding'><div class='faculty-committee-list-name'>";
                    field += "<h4>" + ele.first_name + " " + ele.last_name + "</h4>";
                    field += "</div></div>";
                    field += "<div class='col-sm-4 no-padding'><div class='faculty-committee-list-cap-title'><p>" + ele.title + "</p></div></div>"
                    field += "<div class='col-sm-4 no-padding'><div class='invitation-choice-wrapper clearfix'><div class='accepted-invite-btn-div'><button class='accepted-invite-btn' type='button' fac-id = " + facultyID + " cap-id='" + ele.cap_id + "' name='accept-invite-btn'>&#10004;</button></div>"
                    field += "<div class='declined-invite-btn-div'><button class='declined-invite-btn' type='button' fac-id = " + facultyID + " cap-id='" + ele.cap_id + "' name='reject-invite-btn'>X</button></div></div></div>";
                    field += "</div></div>";
                    $(".invitations-body").append(field);
                });
            }
        },
        error: function(){
            console.log("There was an error in the ajax call to update the faculty's committee list");
            console.log("Check the updateInvitations function");
        }
    }).done(function(){
        $(".accepted-invite-btn").on('click', function(){
            var capID = $(this).attr("cap-id");
            $.ajax({
                url: ajaxURLStart + "app/updateAccepted/" + facID + "/" + capID,
                success:function(){
                    console.log("FacID:" + facID + " CapID:" + capID);
                    updateInvitations(facID);
                },
                error: function(){
                    console.log("There was an error in the ajax call to accept the invitation to a committee");
                }
            }).done(function(){
                $(".faculty-accept-invite-toast").fadeIn();
                setTimeout(function(){
                    $(".faculty-accept-invite-toast").fadeOut();
                }, 3000);
                updateCommitteeList(facID);
            });
        });
    });
}




function updateCommitteeList(facID){
    $.ajax({
        url: ajaxURLStart + "api/getCommitteeList/" + facID,
        success:function(result){
            result = JSON.parse(result);
            if(result.length < 1){
                $(".committee-list-field").html("<div class='col-sm-12'><div class='no-committee-groups-msg'><h3>Not a part of any committees at this time</h3></div></div>");
            }
            else{
                let field = "";
                $.each(result, function(i, ele){
                    field += "<div class='col-sm-12'><div class='faculty-committee-list clearfix'>";
                    field += "<div class='faculty-committee-field clearfix'>";
                    field += "<div class='col-sm-4'><div class='faculty-committee-list-name'>";
                    field += "<h4>" + ele.first_name + " " + ele.last_name + "</h4>";
                    field += "</div></div>";
                    field += "<div class='col-sm-4'><div class='faculty-committee-list-cap-title'><h4>" + ele.title + "</h4></div></div>"
                    field += "<div class='col-sm-4'><div class='faculty-committee-list-remove-btn'><button class='fac-committee-remove-btn' fac-id = " + facultyID + " cap-id='" + ele.cap_id + "' name='fac-committee-remove-btn'>Leave Committee</button></div></div>";
                    field += "</div></div></div>";
                });
                $(".committee-list-field").html(field);
            }
        },
        error: function(){
            console.log("There was an error in the ajax call to update the faculty's committee list");
            console.log("Check the updateCommitteeList function");
        }
    }).done(function(){
        $(".declined-invite-btn").on('click', function(){
            var capID = $(this).attr("cap-id");
            $.ajax({
                url: ajaxURLStart + "app/removeFromCommittee/" + facID + "/" + capID,
                success:function(result){
                    updateInvitations(facID);
                },
                error: function(){
                    console.log("There was an error in the ajax call to decline the invitation to the committee");
                }
            }).done(function(){
                $(".faculty-decline-invite-toast").fadeIn();
                setTimeout(function(){
                    $(".faculty-decline-invite-toast").fadeOut();
                }, 3000);
                updateCommitteeList(facID);
            });
        });

        $(".fac-committee-remove-btn").on('click', function(){
            var capID = $(this).attr("cap-id");
            var facID = $(this).attr("fac-id");
            $.ajax({
                url: ajaxURLStart + "app/removeFromCommittee/" + facID + "/" + capID,
                success:function(result){
                     $(".faculty-remove-from-committee-toast").fadeIn();
                     setTimeout(function(){
                         $(".faculty-remove-from-committee-toast").fadeOut();
                     }, 3000);
                },
                error: function(){
                    console.log("There was an error in the ajax call to leave the committee as faculty");
                }
            }).done(function(){
                updateCommitteeList(facID);
            });
        });
    });
}


function updateTrackingList(facID){
    $.ajax({
        url: ajaxURLStart + "api/getTrackingList/" + facID,
        success:function(result){
            result = JSON.parse(result);
            if(result.length == 0){
                $(".tracking-list-body").html("");
                $(".tracking-list-body").html("<div class='col-sm-12'><h3>Nothing Being Tracked</h3></div>");
            }
            else{
                $(".tracking-list-body").html("");
                $.each(result, function(i, ele){
                    let field = "";
                    field += "<div class='col-sm-12'><div class='faculty-tracking-list clearfix'>";
                    field += "<div class='faculty-tracking-field clearfix'>";
                    field += "<div class='col-sm-4 no-padding'><div class='faculty-tracking-list-name'>";
                    field += "<h4>" + ele.first_name + " " + ele.last_name + "</h4>";
                    field += "</div></div>";
                    field += "<div class='col-sm-4 no-padding'><div class='faculty-tracking-list-cap-title'><p>" + ele.title + "</p></div></div>"
                    field += "<div class='col-sm-4 no-padding'><div class='faculty-tracking-btn-wrapper clearfix'><div class='faculty-tracking-btn-div'><button class='faculty-tracking-btn' type='button' fac-id = " + facultyID + " cap-id='" + ele.cap_id + "' name='remove-tracking-btn'>Stop Tracking</button></div>"
                    field += "</div></div>";
                    field += "</div></div></div>";
                    $(".tracking-list-body").append(field);
                });
            }
             $(".faculty-remove-from-committee-toast").fadeIn();
             setTimeout(function(){
                 $(".faculty-remove-from-committee-toast").fadeOut();
             }, 3000);
             populateUntrackedCapstones();
        },
        error: function(){
            console.log("There was an error in the ajax call to leave the committee as faculty");
        }
    }).done(function(){
        $(".faculty-tracking-btn").on('click', function(){
            var capID = $(this).attr("cap-id");
            $.ajax({
                url: ajaxURLStart + "app/removeFromTracker/" + facID + "/" + capID,
                success:function(result){
                    updateTrackingList(facID);
                },
                error: function(){
                    console.log("There was an error in the ajax call to stop tracking a capstone");
                }
            }).done(function(){
                $(".faculty-remove-from-tracker-toast").fadeIn();
                setTimeout(function(){
                    $(".faculty-remove-from-tracker-toast").fadeOut();
                }, 3000);
                populateUntrackedCapstones();
            });
        });
    });
}



function populateUntrackedCapstones(){
    let modalBody = "";
    modalBody += "<div class='col-sm-12 modal-labels'><div class='col-sm-4'><h3>Name</h3></div>";
    modalBody += "<div class='col-sm-4'><h3>Capstone</h3></div></div>";

    $.ajax({
        url: ajaxURLStart + "api/getTrackingList/" + facultyID,
        success:function(result){
            result = JSON.parse(result);
            // // checks if the faculty member is already tracking a specific capstone
            // // and only shows the capstones that the faculty isnt tracking
            let untrackedList = [];
            $.each(allCapstones, function(i, ele){
                if(!result.some(item => item.id == ele.id)){
                    untrackedList.push(ele);
                }
            });

            if(untrackedList.length == 0 ){
                modalBody += "<div class='col-sm-12'><h3>Already Tracking All Capstones</h3></div>";
            }

            $.each(untrackedList, function(i, ele){
                modalBody += "<div class='col-sm-12'><div class='modal-track-member clearfix'>";
                modalBody += "<div class='col-sm-4'><div class='modal-track-name'>";
                modalBody += "<h4>" + ele.first_name + " " + ele.last_name + "</h4></div></div>";
                modalBody += "<div class='col-sm-4'><div class='modal-track-username'>"
                modalBody += "<h4>" + ele.title + "</h4></div></div>";
                modalBody += "<div class='col-sm-4'><div class='modal-track-add-div'>";
                modalBody += "<button class='modal-track-add-btn' type='button' fac-id='" + facultyID + "' cap-id='" + ele.id + "' name='modal-track-add-btn'>ADD</button>";
                modalBody += "</div></div></div></div>";
            });

            $(".modal-body").html(modalBody);

            $(".modal-track-add-btn").on('click', function(){
                var capID = $(this).attr("cap-id");
                var facID = $(this).attr("fac-id");
                $.ajax({
                    url: ajaxURLStart + "app/addToTracker/" + facID + "/" + capID,
                    success:function(result){
                        updateTrackingList(facultyID);
                    },
                    error: function(){
                        console.log("There was an error in the ajax call to start tracking a capstone");
                    }
                }).done(function(){
                    $(".faculty-add-to-tracker-toast").fadeIn();
                    $('#myModal').modal('hide');
                    setTimeout(function(){
                        $(".faculty-add-to-tracker-toast").fadeOut();
                    }, 3000);
                });
            });
        },
        error: function(){
            console.log("There was an error in the ajax call in populateUntrackedCapstones");
        }
    });
}


function inCommittee(json){
    return committeeData.some(item => item.cap_id == json.id);
}



function inDatabase(username, callback){
    $.ajax({
        url: ajaxURLStart + "api/inDatabase/" + username,
        success:function(ele){
            let result = JSON.parse(ele);
            if(result.length <= 0){
                callback(false);
            }
            else{
                callback(true);
            }
        },
        error:function(){
            console.log("Something happened when checking for username in database in the inDatabase function");
        }
    });
}
