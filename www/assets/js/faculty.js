let faculty = {

    getCapstone: function(username) {
        $.ajax({
            url: "/api/getCapstoneByUsername/" + username,
            method: "get",
            dataType: "json"
        }).done(function (json) {
            console.log(json);
            let projectDetails = document.getElementsByClassName("project-details-wrapper")[0];
            $("#project-title-header").html(json.title);

            $("#cap-status-grade").html(json.grade);

            $.ajax({
                url: "/api/getCapstoneStatus/" + username,
                method: "get",
                dataType: "json"
            }).done(function (json2) {
                console.log(json2);
                $("#cap-status").html(json2.status_desc);
            });

        });
    }
};

$(document).ready(function(){

    if(invitationData.length == 0){
        $(".invitations-body").html("");
        $(".invitations-body").html("<div class='col-sm-12'><h3>No invitations at this time</h3></div>");
    }
    else{
        $(".invitations-body").html("");
        $.each(invitationData, function(i, ele){
            console.log(ele);
            let field = "";
            field += "<div class='col-sm-12'><div class='faculty-committee-list clearfix'>";
            field += "<div class='faculty-committee-field clearfix'>";
            field += "<div class='col-sm-4 no-padding'><div class='faculty-committee-list-name'>";
            field += "<h4>" + ele.first_name + " " + ele.last_name + "</h4>";
            field += "</div></div>";
            field += "<div class='col-sm-4 no-padding'><div class='faculty-committee-list-cap-title'><p>" + ele.title + "</p></div></div>"
            field += "<div class='col-sm-4 no-padding'><div class='invitation-choice-wrapper clearfix'><div class='accepted-invite-btn-div'><button type='button' fac-id = " + ele.fac_id + " cap-id='" + ele.cap_id + "' name='accept-invite-btn'>&#10004;</button></div>"
            field += "<div class='declined-invite-btn-div'><button type='button' fac-id = " + ele.fac_id + " cap-id='" + ele.cap_id + "' name='reject-invite-btn'>X</button></div></div></div>";
            field += "</div></div>";
            $(".invitations-body").append(field);
        });
    }



    if(trackedInfo.length == 0){
        $(".tracking-list-body").html("");
        $(".tracking-list-body").html("<div class='col-sm-12'><h3>Nothing Being Tracked</h3></div>");
    }
    else{
        $(".tracking-list-body").html("");
        $.each(trackedInfo, function(i, ele){
            console.log(ele);
            let field = "";
            field += "<div class='col-sm-12'><div class='faculty-tracking-list clearfix'>";
            field += "<div class='faculty-tracking-field clearfix'>";
            field += "<div class='col-sm-4 no-padding'><div class='faculty-tracking-list-name'>";
            field += "<h4>" + ele.first_name + " " + ele.last_name + "</h4>";
            field += "</div></div>";
            field += "<div class='col-sm-4 no-padding'><div class='faculty-tracking-list-cap-title'><p>" + ele.title + "</p></div></div>"
            field += "<div class='col-sm-4 no-padding'><div class='invitation-choice-wrapper clearfix'><div class='accepted-invite-btn-div'><button type='button' fac-id = " + ele.fac_id + " cap-id='" + ele.cap_id + "' name='accept-invite-btn'>Stop Tracking</button></div>"
            field += "</div></div>";
            field += "</div></div></div>";
            $(".tracking-list-body").append(field);
        });
    }



    $.each(committeeData, function(i, ele){

        let field = "";
        field += "<div class='col-sm-12'><div class='faculty-committee-list clearfix'>";
        field += "<div class='faculty-committee-field clearfix'>";
        field += "<div class='col-sm-4'><div class='faculty-committee-list-name'>";
        field += "<h4>" + ele.first_name + " " + ele.last_name + "</h4>";
        field += "</div></div>";
        field += "<div class='col-sm-4'><div class='faculty-committee-list-cap-title'><h4>" + ele.title + "</h4></div></div>"
        field += "<div class='col-sm-4'><div class='faculty-committee-list-remove-btn'><button fac-id = " + ele.fac_id + " cap-id='" + ele.cap_id + "' name='fac-committee-remove-btn'>Leave Committee</button></div></div>";
        field += "</div></div></div>";
        $(".committee-list-field").append(field);
    });


    $.each(committeeData, function(i, ele){

        let field = "";
        field += "<div class='col-sm-12'><div class='faculty-committee-list clearfix'>";
        field += "<div class='faculty-committee-field clearfix'>";
        field += "<div class='col-sm-4'><div class='faculty-committee-list-name'>";
        field += "<h4>" + ele.first_name + " " + ele.last_name + "</h4>";
        field += "</div></div>";
        field += "<div class='col-sm-4'><div class='faculty-committee-list-cap-title'><h4>" + ele.title + "</h4></div></div>"
        field += "<div class='col-sm-4'><div class='faculty-committee-list-remove-btn'><button fac-id = " + ele.fac_id + " cap-id='" + ele.cap_id + "' name='fac-committee-remove-btn'>Leave Committee</button></div></div>";
        field += "</div></div></div>";
        $(".committee-list-field").append(field);
    });

    $(".accepted-invite-btn-div button").attr('name', 'accept-invite-btn').on('click', function(){
        var capID = $(this).attr("cap-id");
        var facID = $(this).attr("fac-id");

        $.ajax({
            url: ajaxURLStart + "app/updateAccepted/" + facID + "/" + capID,
            success:function(result){
                 $(".faculty-accept-invite-toast").fadeIn();
                 setTimeout(function(){
                     $(".faculty-accept-invite-toast").fadeOut();
                 }, 3000);
            },
            error: function(){
                console.log("There was an error in the ajax call to accept the invitation to a committee");
            }
        }).done(function(){
            setTimeout(function(){
                location.reload();
            }, 3000);
        });
    });


    $(".declined-invite-btn-div button").attr('name', 'reject-invite-btn').on('click', function(){
        var capID = $(this).attr("cap-id");
        var facID = $(this).attr("fac-id");
        $.ajax({
            url: ajaxURLStart + "app/removeFromCommittee/" + facID + "/" + capID,
            success:function(result){
                 $(".faculty-decline-invite-toast").fadeIn();
                 setTimeout(function(){
                     $(".faculty-decline-invite-toast").fadeOut();
                 }, 3000);
            },
            error: function(){
                console.log("There was an error in the ajax call to decline the invitation to the committee");
            }
        }).done(function(){
            setTimeout(function(){
                location.reload();
            }, 3000);
        });
    });



    $(".faculty-committee-list-remove-btn button").attr('name', 'fac-committee-remove-btn').on('click', function(){
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
            setTimeout(function(){
                location.reload();
            }, 3000);
        });
    });
});
