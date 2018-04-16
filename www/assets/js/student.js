

$(document).ready(function(){

    $.each(json, function(i, ele){
        let field = "";
        field += "<div class='col-sm-12'><div class='committee-list-member clearfix'>";
        field += "<div class='col-sm-10'><div class='committee-list-name'>";
        field += "<h3>" + ele.first_name + " " + ele.last_name + "</h3>";
        field += "</div></div>";
        field += "<div class='col-sm-2'><div class='committee-list-delete-btn'>";
        field += "<button type='button' name='committee-delete-btn'>DELETE</button>";
        field += "</div></div></div></div>";
        $(".committee-list-member-wrapper").append(field);
    });
});
