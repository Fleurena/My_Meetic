$(document).ready(function(){
    "use strict";
        $(".menu li").hover(function(){
            $("ul:first",this).css({visibility:"visible"});
        }, function(){
            $("ul:first",this).css({visibility:"hidden"});
        });
});