$(".header-search, .header-search-icon").click(function() {

    if ( $(".search").hasClass("search-open") ) {
        closeSearch();
    } else {
        showSearch();
    }

});

$(".search__close").click(function () {
    closeSearch();
});


function showSearch() {
    $(".search").fadeIn();
    $(".search__input").focus();
}

function closeSearch() {
    $(".search").fadeOut();
}
