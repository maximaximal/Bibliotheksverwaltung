function addBookToList(book) {
    var c = "";

    c += "<tr>\n";
    c += "    <td>" + book["id"] + "</td>\n";
    c += "    <td>" + book["internalID"] + "</td>\n";
    c += "    <td>" + book["title"] + "</td>\n";
    c += "    <td>" + book["author"] + "</td>\n";
    c += "    <td>" + book["year"] + "</td>\n";
    c += "    <td>" + book["publisher"] + "</td>\n";
    c += "    <td>" + book["place"] + "</td>\n";
    c += "    <td>" + book["lang"] + "</td>\n";
    c += "    <td>" + book["condition"] + "</td>\n";
    c += "</tr>\n";
    return c;
}

function listBooks(lendingID) {
    $.get("lending.php?id=" + lendingID, function(data) {
        var lending = JSON.parse(data);
        var i = 0;
        var c = "";

        c += "<table>\n";
        c += "<thead>\n";
        c += "<tr>\n";
        c += "    <th>Id</th>\n";
        c += "    <th>Interne ID</th>\n";
        c += "    <th>Titel</th>\n";
        c += "    <th>Autor</th>\n";
        c += "    <th>Jahr</th>\n";
        c += "    <th>Verlag</th>\n";
        c += "    <th>Ort</th>\n";
        c += "    <th>Sprache</th>\n";
        c += "    <th>Zustand</th>\n";
        c += "</tr>\n";
        c += "</thead>\n";
        c += "<tbody>\n";

        for(i = 0; i < lending["books"].length; ++i) {
            c += addBookToList(lending["books"][i]);
        }

        c += "</tbody>\n";
        c += "</table>\n";
        document.getElementById("books").innerHTML = c;
        document.getElementById("booksDiv").style.display = "block";
    });
}

function listLending(lending) {
    var now = new Date(Date.now());
    var bringback = new Date(lending["bringback"]);

    var c = "";

    //If the bringback date is bigger than the current date, the entry should turn red!
    if(now > bringback) {
        c += "<tr style='color: red;'>\n";
    } else {
        c += "<tr>\n";
    }

    c += "    <td>" + lending["id"] + "</td>\n";
    c += "    <td>" + lending["lender"] + "</td>\n";
    c += "    <td>" + lending["class"] + "</td>\n";
    c += "    <td>" + lending["created"] + "</td>\n";
    c += "    <td>" + lending["bringback"] + "</td>\n";
    c += "    <td><button onclick='listBooks(" + lending["id"] + ")' class='ym-button ym-small'>Bücherliste laden</button></td>\n";
    c += "</tr>\n";
    return c;
}

$(function() {
    //Get the newest lending data. 
    $.get("lendings.php?active&q=", function(data) {
        var lendings = JSON.parse(data)["items"];

        var c = "";

        c += "<table>\n";
        c += "<thead>\n";
        c += "<tr>\n";
        c += "    <th>Id</th>\n";
        c += "    <th>Ausleiher</th>\n";
        c += "    <th>Klasse</th>\n";
        c += "    <th>Ausleihedatum</th>\n";
        c += "    <th>Rückgabedatum</th>\n";
        c += "    <th>Bücherliste laden</th>\n";
        c += "</tr>\n";
        c += "</thead>\n";
        c += "<tbody>\n";

        var index = 0;
        for(index = 0; index < lendings.length; ++index) {
            c += listLending(lendings[index]);
        }

        c += "</tbody>\n";
        c += "</table>\n";

        document.getElementById("existingLendings").innerHTML = c;
    });
});
