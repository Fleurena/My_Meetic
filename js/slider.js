$(document).ready(function(){
    "use strict";
    var $carrousel = $(".pretendants"),
    index = $carrousel.length - 1,
    i = 0,
    $current = $carrousel.eq(i);

    $carrousel.css("display", "none");
    $current.css("display", "block");

    $("#right-arrow").click(function(){
        i++;

        if(i <= index){
            $carrousel.css("display", "none");
            $current = $carrousel.eq(i);
            $current.css("display", "block");
        }
        else{
            i = index;
        }
    });

    $("#left-arrow").click(function(){
        i--;

        if(i >= 0){
            $carrousel.css("display", "none");
            $current = $carrousel.eq(i);
            $current.css("display", "block");
        }
        else{
            i = 0;
        }
    });

    function slide(){

        setTimeout(function(){

        if(i < index){
            i++;
        }
        else{
            i = 0;
        }

        $carrousel.css("display", "none");

        $current = $carrousel.eq(i);
        $current.css("display", "block");

        slide();
        }, 5000);
    }
    slide();
});
