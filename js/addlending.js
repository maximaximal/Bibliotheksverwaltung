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

var IDs = new Array();

function updateFields_lending() {
    if(IDs.length > 0) {
        $("#IDsToChange").val(JSON.stringify(IDs));
    }
}

$(".bookselector_lending").on("select2:select", function (e) {
    IDs.push(e.params.data.id);

    updateFields_lending();
});
$(".bookselector_lending").on("select2:unselect", function (e) {
    IDs = $.grep(IDs, function(value) {
        return value != e.params.data.id;
    });

    updateFields_lending();
});