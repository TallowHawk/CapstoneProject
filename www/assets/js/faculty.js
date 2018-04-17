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
});
