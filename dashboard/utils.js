$(document).ready(function () {

    $("#btnColapSideBar").click(function() {
        // Code to be executed when the object with id btnColapSideBar is clicked
        if ($("#menuContratos").is(":hidden")) {
            $("#menuContratos").show();
        } else {
            $("#menuContratos").hide();
        }

    });


}); //fin Documento