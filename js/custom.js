$(document).ready(function(){
    $(window).scroll(function(){
        if($(window).scrollTop() >= 100){
            $(".header").addClass('header-fixed');
        }else{
            $(".header").removeClass('header-fixed');
        }
        return false;
    });
    $("#to-header").on('click', function(event) {
        if (event.isTrigger == undefined) {
            $('html, body').animate({
                scrollTop: $("#wrapper").offset().top - 1500
            }, 1000);
        }
    });
    $(".se-pre-con").fadeOut("slow");

    $(document).on("scroll", onscroll);
    $('#to-about').on('click', function(evt){
        evt.preventDefault();
        var target = $(this).attr('href');
        $('html, body')
            .stop()
            .animate({scrollTop: $(target).offset().top-130}, 1000 );
    });

    var sections = $('section')
        , nav = $('.navbar-menu')
        , nav_height = 130;

    $(window).on('scroll', function () {
        var cur_pos = $(this).scrollTop();

        sections.each(function() {
            var top = $(this).offset().top - nav_height,
                bottom = top + $(this).outerHeight();

            if (cur_pos >= top && cur_pos <= bottom) {
                nav.find('a').removeClass('active');
                sections.removeClass('active');

                $(this).addClass('active');
                nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
            }
        });
    });

    nav.find('a').on('click', function () {
        var $el = $(this)
            , id = $el.attr('href');

        $('html, body').animate({
            scrollTop: $(id).offset().top - nav_height
        }, 1000);

        return false;
    });
    setTimeout(function(){

        $('.progress-bar-competence').each(function() {
            var me = $(this);
            var perc = me.attr("data-percentage");

            var current_perc = 0;

            var progress = setInterval(function() {
                if (current_perc>=perc) {
                    clearInterval(progress);
                } else {
                    current_perc +=1;
                    me.css('width', (current_perc)+'%');
                }

                me.text((current_perc)+'%');

            }, 50);

        });

    },300)

    $("#association").click(function(){
        $("#association-show").show();
    });
    $("#particulier").click(function(){
        $("#association-show").hide();
    });
    $("#societe").click(function(){
        $("#association-show").hide();
    });
    $("#societe").click(function(){
        $("#societe-show").show();
    })
    $("#particulier").click(function(){
        $("#societe-show").hide();
    });


});
