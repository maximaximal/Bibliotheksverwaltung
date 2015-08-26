$(".lendingselector").select2({
    ajax: {
        url: "lendings.php",
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
    templateResult: formatLending,
    templateSelection: formatLendingSelection,
    language: "de"
});

function formatLending (lending) {
if (lending.loading) return lending.id;

    var markup = "<div class='ym-grid'>\n\
    <div class='ym-g50 ym-gl'><div class='ym-gbox'>\n\
        <p>Klasse: " + lending.class + " (ID: " + lending.id + ")\n\
    </div></div>\n\
    <div class='ym-g50 ym-gr'><div class='ym-gbox'>\n\
        <p>Ausgeborgt von: " + lending.lender + ", am " + lending.created + "\n\
    </div></div></div>";

    return markup;
}

function formatLendingSelection(lending) {
    return lending.lender + " (ID: " + lending.id + ") - ausgeborgt am " + lending.created + " für die Klasse " + lending.class + ".";
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

var lendingID = -1;

function addBookToAcc(book) {
    var s = "";
    
    s += '<h3>' + book.title + ' (' + book.internalID + ')</h3>' + "\n";
    s += '<div>';
    s += '<p>';
    s += '    Zustand des Buches: <input type="text" id="' + book.id'">' + book.condition;
    s += '</p>';
    s += "</div>\n";
    
    $("#accordion").append(s);
}

function loadLending() {
    $("#bookCheck").hide();
    if(("#accordion").destroy) {
        $("#accordion").destroy();
    }
    $("#accordion").html("");
    
    $.getJSON("lending.php?id=" + lendingID, function(data) {
        $.each(data.books, function(i, book) {
            addBookToAcc(book)
        });
        
        $("#bookCheck").show();
        $("#accordion").accordion({
            heightstyle: "content"
        });
    });
}

$(".lendingselector").on("select2:select", function (e) {
    lendingID = e.params.data.id;
    
    loadLending();
});
