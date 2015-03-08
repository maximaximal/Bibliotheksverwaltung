$(".bookselector").on("select2:select", function (e) {
    console.log(e.params.data.id);
});