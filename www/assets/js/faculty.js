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

            // $("").innerText = json.description;
            // $("").innerText = json.defense_date;

            $.ajax({
                url: "/api/getCapstoneStatus/" + username,
                method: "get",
                dataType: "json"
            }).done(function (json2) {
                $("#cap-status").html(json.status_desc);
            });

        });
    }
};
