$(document).ready(function() {
	var url = window.location.pathname;
	var filename = url.substring(url.lastIndexOf('/')+1);
	if(filename=="dashboard"){
        $("#nav-dashboard").addClass("active");
	}
    else if(filename=="item"){
        $("#nav-item").addClass("active");
    }
    else if(filename=="report"){
        $("#nav-report").addClass("active");
    }

    //add filename to window title
    //var title = document.title;
    //capitalize filename
    //filename = filename.charAt(0).toUpperCase() + filename.slice(1);


    //title = filename + " | " + title;
    //$("title").text(title);
});

$('#business-selector').click(function () {
    $.ajax({
        url: "/api/business/my",
        type: "GET",
        dataType: "json",
        success: function (data) {
            data = data.data;
            $('#list-business').empty();
            for (let i = 0; i < data.length; i++) {
                $('#list-business').append(
                    '<button class="list-group-item list-group-item-action">' +
                    '<span class="d-block fw-bold fs-4">' +
                    data[i].name +
                    '</span>' +
                    '<span class="d-block text-secondary fs-6">' +
                    data[i]._id +
                    '</span>' +
                    '</button>'
                );
            }
        }
    });
});