var IDs = new Array();

$(".bookselector").select2({
    ajax: {
        url: "books.php",
        dataType: 'json',
        data: function (params) {
            return {
                q: params.term, // search term
                page: params.page
            };
    },
    processResults: function (data, page) {
        // parse the results into the format expected by Select2.
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data
        return {
                results: data.items
            };
        },
        cache: true
    },
    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatBook,
    templateSelection: formatBookSelection,
    language: "de"
});

function formatBook (book) {
if (book.loading) return book.title;

    var markup = "<div class='ym-grid'>\n\
    <div class='ym-g50 ym-gl'><div class='ym-gbox'>\n\
        <p>" + book.title + " (" + book.id + ")\n\
    </div></div>\n\
    <div class='ym-g50 ym-gr'><div class='ym-gbox'>\n\
        <p>" + book.author + "\n\
    </div></div></div>";

    return markup;
}

function formatBookSelection (book) {
    return book.title + " (" + book.id + ")";
}

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