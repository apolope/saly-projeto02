$(document).ready(function() {
    $("#addPop").click(function() {
        console.log("foi");
        if ($("#bookList option:selected").val() != null) {
            $("#bookList option:selected")
                .remove()
                .appendTo("#selectBooksList");
            $("#bookList")
                .attr("selectedIndex", "-1")
                .find("option:selected")
                .removeAttr("selected");
            $("#selectBooksList")
                .attr("selectedIndex", "-1")
                .find("option:selected")
                .removeAttr("selected");
        } else {
            alert("Selecione um ou mais antes de adicionar.");
        }
    });

    $("#removePop").click(function() {
        if ($("#selectBooksList option:selected").val() != null) {
            $("#selectBooksList option:selected")
                .remove()
                .appendTo("#bookList");
            $("#selectBooksList")
                .attr("selectedIndex", "-1")
                .find("option:selected")
                .removeAttr("selected");
            $("#bookList")
                .attr("selectedIndex", "-1")
                .find("option:selected")
                .removeAttr("selected");
            $("#bookList")
                .attr("selectedIndex", "-1")
                .addAttr("selected");
        } else {
            alert("Selecione um ou mais antes de remover.");
        }
    });
});
