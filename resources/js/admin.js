/*SIDEBAR DROPDOWN SUBMENU SWITCHER*/
$(document).ready(function(){
    $('ul.sidebar-menu').find('li.dropdown>a').click(function(){
        $(this).closest('.dropdown').find('a>i.fa-angle-right').toggleClass('down');
        $(this).siblings('ul.sidebar_submenu').slideToggle(200);
    });
});


/* HIDE / SHOW SIDEBAR */
$(document).ready(function(){
    $('#hamburger_menu').click(function(){
        if ($(window).width() > 815 ) {
            $('#sidebar-nav').toggleClass('sidebar-hide');
            $('#main-content').find('div.content').toggleClass('content_full_width');
        } else {
            $('.sidebar-menu').slideToggle();
        }
    });
});


/* SHOW/HIDE ADMIN PROFILE LINKS */
$(document).ready(function(){
    $('.admin-profile').on('click', function(){
        var dropDown = $(this).closest('.dropdown').find('.dropdown-menu');
        var parentLi  = $(this).closest('li');
        var caret = $(this).find('.fa-caret-down');

        $(dropDown).toggleClass('show');
        $(parentLi).toggleClass('show');
        $(caret).toggleClass('caret-up');

        $(this).attr('aria-expanded') == 'true' ? $(this).attr('aria-expanded', 'false') : $(this).attr('aria-expanded', 'true');
    });
});
