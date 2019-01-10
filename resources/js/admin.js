var $ = require('jquery');

$(".sidebar-toggler").click(function (e) { 
    e.preventDefault();
    $("#sidebar").toggleClass("active");
});
