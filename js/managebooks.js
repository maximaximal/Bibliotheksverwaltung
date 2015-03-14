var IDs = new Array();

function updateFields() {
    if(IDs.length > 0) {
        $.getJSON("book.php?id=" + IDs[0], function(data) {
            $("#editTitle").val(data.title);
            $("#editAuthor").val(data.author);
            $("#editCondition").val(data.condition);
            $("#editFeatures").val(data.features);
            $("#editPublisher").val(data.publisher);
            $("#editYear").val(data.year);
        });

        $("#IDsToChange").val(JSON.stringify(IDs));
    }
}

$(".bookselector").on("select2:select", function (e) {
    IDs.push(e.params.data.id);

    updateFields();
});
$(".bookselector").on("select2:unselect", function (e) {
    IDs = $.grep(IDs, function(value) {
        return value != e.params.data.id;
    });

    updateFields();
});