let staff = {

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
        });
    }
};