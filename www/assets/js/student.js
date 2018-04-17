

$(document).ready(function(){

    $.each(committeeData, function(i, ele){
        let field = "";
        field += "<div class='col-sm-12'><div class='committee-list-member clearfix'>";
        field += "<div class='col-sm-10'><div class='committee-list-name'>";
        field += "<h3>" + ele.first_name + " " + ele.last_name + "</h3>";
        field += "</div></div>";
        field += "<div class='col-sm-2'><div class='committee-list-delete-btn'>";
        field += "<button type='button' data-fac='" + ele.fac_id + "' name='committee-delete-btn'>DELETE</button>";
        field += "</div></div></div></div>";
        $(".committee-list-member-wrapper").append(field);
    });


    $(".committee-header-btn button").attr('name', 'committee-add-btn').on('click', function(){
        let modalBody = "";
        modalBody += "<div class='col-sm-12 modal-labels'><div class='col-sm-4'><h3>Name</h3></div>";
        modalBody += "<div class='col-sm-4'><h3>Username</h3></div></div>";

        // checks if faculty members are already invited to the committee
        // and only shows the faculty members who are not a part of the
        // committee
        let facultyList = [];
        $.each(facultyMembers, function(i, ele){
            if(!committeeData.some(item => item.username == ele.username)){
                facultyList.push(ele);
            }
        });

        $.each(facultyList, function(i, ele){
            modalBody += "<div class='col-sm-12'><div class='modal-fac-member clearfix'>";
            modalBody += "<div class='col-sm-4'><div class='modal-fac-name'>";
            modalBody += "<h4>" + ele.first_name + " " + ele.last_name + "</h4></div></div>";
            modalBody += "<div class='col-sm-4'><div class='modal-fac-username'>"
            modalBody += "<h4>" + ele.username + "</h4></div></div>";
            modalBody += "<div class='col-sm-4'><div class='modal-fac-invite-div'>";
            modalBody += "<button type='button' data-fac='" + ele.uid + "' name='modal-fac-invite-btn'>INVITE</button>";
            modalBody += "</div></div></div></div>";
        });

        $(".modal-body").html(modalBody);
        $('#myModal').modal('show');

        $(".modal-fac-invite-div button").attr('name', 'modal-fac-invite-btn').on('click', function(){
            var capID = capstoneInfo[0].id;
            var uid = $(this).attr("data-fac");

            $.ajax({
                url: "/capstoneproject/www/index.php/app/addToCommittee/" + uid + "/" + capID,
                success:function(result){
                     console.log(result);
                     $(".invite-success-toast").fadeIn();
                     $('#myModal').modal('hide');
                     setTimeout(function(){
                         $(".invite-success-toast").fadeOut();
                     }, 3000);
                },
                error: function(){
                    console.log("There was an error in the ajax call to invite the faculty member to the committee");
                }
            });
        });
    });

    $(".committee-list-delete-btn button").attr('name', 'committee-delete-btn').on('click', function(){
        var capID = capstoneInfo[0].id;
        var facID = $(this).attr("data-fac");

        $.ajax({
            url: "/capstoneproject/www/index.php/app/removeFromCommittee/" + facID + "/" + capID,
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
            location.reload();
        });
    });
});
