/*$(document).ready(function(){
	//Check that there is text in the search box
    $('#searchform').submit(function(e) {
        var s = $( this ).find("#s");
        if (!s.val()) { e.preventDefault(); alert("Please enter a search term"); $('#s').focus(); }
    });

    $('.burger').click( function(){
      $('.bar').toggleClass('bar-change');
    });
}); */

document.addEventListener("DOMContentLoaded", function(event){
var burger = document.querySelector('.burger-container');
var menu = document.querySelector('.nav2');
var menuLabel = document.querySelector('.menuLabel');

burger.onclick = function(){
  burger.classList.toggle('bar-change');
  menu.classList.toggle('hide-it');
  menuLabel.classList.toggle('hide-it');

};
});
