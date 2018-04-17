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

    $.each(invitationData, function(i, ele){
        console.log(ele);
        let field = "";
        field += "<div class='col-sm-12'><div class='faculty-committee-list clearfix'>";
        field += "<div class='faculty-committee-field clearfix'>";
        field += "<div class='col-sm-4 no-padding'><div class='faculty-committee-list-name'>";
        field += "<h4>" + ele.first_name + " " + ele.last_name + "</h4>";
        field += "</div></div>";
        field += "<div class='col-sm-4 no-padding'><div class='faculty-committee-list-cap-title'><h4>" + ele.title + "</h4></div></div>"
        field += "<div class='col-sm-4 no-padding'><div class='invitation-choice-wrapper clearfix'><button type='button' name='accept-invite-btn'>&#10004;</button>"
        field += "<button type='button' name='reject-invite-btn'>X</button></div></div>";
        field += "</div></div>";
        $(".invitations-body").append(field);
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

    $(".faculty-committee-list-remove-btn button").attr('name', 'fac-committee-remove-btn').on('click', function(){
        var capID = $(this).attr("cap-id");
        var facID = $(this).attr("fac-id");
        $.ajax({
            url: ajaxURLStart + "app/removeFromCommittee/" + facID + "/" + capID,
            success:function(result){
                 $(".delete-success-toast").fadeIn();
                 setTimeout(function(){
                     $(".delete-success-toast").fadeOut();
                 }, 3000);
            },
            error: function(){
                console.log("There was an error in the ajax call to delete the faculty member from the committee");
            }
        }).done(function(){
            setTimeout(function(){
                location.reload();
            }, 3000);
        });
    });
});
