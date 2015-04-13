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
        <p>" + book.title + " (" + book.internalID + ")\n\
    </div></div>\n\
    <div class='ym-g50 ym-gr'><div class='ym-gbox'>\n\
        <p>" + book.author + "\n\
    </div></div></div>";

    return markup;
}

function formatBookSelection (book) {
    return book.title + " (" + book.internalID+ ")";
}

var germanLanguage = {
    errorTitle : 'Übertragung fehlgeschlagen!',
    requiredFields : 'Sie haben nicht alle benötigten Felder ausgefüllt.',
    badTime : 'Sie haben keine korrekte Zeit eingetragen.',
    badEmail : 'Sie haben keine korrekte E-Mail Adresse angegeben.',
    badTelephone : 'Sie haben keine korrekte Telefonnummer angegeben!',
    badSecurityAnswer : 'Sie haben eine falsche Antwort auf die Sicherheitsfrage gegeben.',
    badDate : 'Sie haben kein korrektes Datum angegeben.',
    lengthBadStart : 'Sie müssen eine Antwort mit einer Länge zwischen ',
    lengthBadEnd : ' Buchstaben gegeben.',
    lengthTooLongStart : 'Sie haben eine längere Antwort als ',
    lengthTooShortStart : 'Sie haben eine kürzere Antwort als ',
    notConfirmed : 'Die Werte konnten nicht bestätigt werden!',
    badDomain : 'Falsche Domain!',
    badUrl : 'Ihre Antwort ist keine korrekte URL.',
    badCustomVal : 'Sie haben eine falsche Antwort gegeben.',
    badInt : 'Ihre Eingabe war keine korrekte Nummer.',
    badSecurityNumber : 'Die Sozialversicherungsnummer war nicht korrekt.',
    badUKVatAnswer : 'Falsche UK VAT Nummer.',
    badStrength : 'Das Passwort ist nicht stark genug.',
    badNumberOfSelectedOptionsStart : 'Sie müssen mindestens ',
    badNumberOfSelectedOptionsEnd : ' Antworten geben.',
    badAlphaNumeric : 'Ihre Eingabe darf nur alphanumerische Zeichen (Buchstaben & Zahlen) beinhalten.',
    badAlphaNumericExtra: ' und ',
    wrongFileSize : 'Die hochgeladene Datei war zu groß.',
    wrongFileType : 'Die hochgeladene Datei ist von einem falschen Dateityp.',
    groupCheckedRangeStart : 'Bitte wählen sie zwischen ',
    groupCheckedTooFewStart : 'Bitte wählen sie mindestens ',
    groupCheckedTooManyStart : 'Bitte wählen sie höchstens ',
    groupCheckedEnd : ' Werte'
};

$(function() {
    $.validate({
        language : germanLanguage
    });
});

function updateFields() {
    if(IDs.length > 0) {
        $.getJSON("book.php?id=" + IDs[0], function(data) {
            $("#editTitle").val(data.title);
            $("#editAuthor").val(data.author);
            $("#editCondition").val(data.condition);
            $("#editFeatures").val(data.features);
            $("#editPublisher").val(data.publisher);
            $("#editYear").val(data.year);
            $("#editInternalID").val(data.internalID);
            $("#editPlace").val(data.place);
            $("#editLang").val(data.lang);
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