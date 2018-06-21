$(document).ready(function(){     
	//Check that there is text in the search box   
    $('#searchform').submit(function(e) { 
        var s = $( this ).find("#s"); 
        if (!s.val()) { e.preventDefault(); alert("Please enter a search term"); $('#s').focus(); }
    });
});