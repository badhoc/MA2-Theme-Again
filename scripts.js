/* $(document).ready(function(){
    $('#searchform').submit(function(e) { // run the submit function, pin an event to it
        var s = $( this ).find("#s").val($.trim($( this ).find("#s").val())); // find the #s, which is the search input id and trim any spaces from the start and end
        if (!s.val()) { // if s has no value, proceed
            e.preventDefault(); // prevent the default submission
            alert("Your search is empty!"); // alert that the search is empty
            $('#s').focus(); // focus on the search input
        }
    });
}); */

function toggleMenu() {
var burger = document.querySelector('.burger-container');
var menu = document.querySelector('.nav2');
burger.classList.toggle('bar-change');
menu.classList.toggle('hide-it');
}
