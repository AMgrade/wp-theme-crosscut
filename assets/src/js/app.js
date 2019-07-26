(function($){
    var initialContainer = $('.columns'),
        columnItems = $('.columns li'),
        columns = null,
        column = 1; // account for initial column
    function updateColumns(){
        column = 0;
        columnItems.each(function(idx, el){
            if (idx !== 0 && idx > (columnItems.length / columns.length) + (column * idx)){
                column += 1;
            }
            $(columns.get(column)).append(el);
        });
    }
    function setupColumns(){
        columnItems.detach();
        while (column++ < initialContainer.data('columns')){
            initialContainer.clone().insertBefore(initialContainer);
            column++;
        }
        columns = $('.columns');
    }

    $(function(){
        setupColumns();
        updateColumns();
    });
})(jQuery);

jQuery(document).ready(function ($) {

    //Lazy load
    $('.lazy').Lazy({
        scrollDirection: 'vertical',
        effect: 'fadeIn',
        visibleOnly: true,
        effectTime: 300
    });

    //Hamburger
    $('#menuSpan').click(function(){
        $(this).toggleClass('open');
    });

    //SVG corner with logo
    $('.headline__logo-corner img').each(function() {

        var $img = $(this),
            imgURL = $img.attr('src'),
            imgID = $img.attr('id');

        $.get(imgURL, function(data) {

            var $svg = $(data).find('svg');

            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }

            $svg = $svg.removeAttr('xmlns:a');
            $img.replaceWith($svg);
        }, 'xml');
    });

    //Team Accordion
    function bwColor (item, hide) {
        if (hide) {
            item.parents('.card-header.team__card_header').find('.bw').hide();
            item.parents('.card-header.team__card_header').find('.color').fadeIn();
        } else {
            item.parents('.card-header.team__card_header').find('.color').hide();
            item.parents('.card-header.team__card_header').find('.bw').fadeIn();
        }
    }

    $('.info__btn, .team__card .image, .name-toggle').click(function () {
        var myEm = $(this).data('target');
        var btnEl = $("#accordionTeam").find(`.info__btn[data-target='${myEm}']`);
        if ( btnEl.hasClass('rotate')) {
            btnEl.removeClass('rotate');
            bwColor($(this), false);
        } else {
            btnEl.addClass('rotate');
            bwColor($(this), true);
        }
    });

    //About Accordion
    function resizeLine(item) {
        $(item).each(function () {
            var elWidth = $(this).find('.info__btn').width() + 60;
            var lineWidth = $(this).find('.line').css('width', '100%').css('width', '-='+elWidth+'px');
            console.log(lineWidth);
        });
    }
    resizeLine('.about__card_subheader');

    $(window).on('resize', function(){
        resizeLine('.about__card_subheader');
    });

    $('.item').each(function () {
        $(this).mouseenter(function () {
            $(this).find(".item__overlay").fadeIn();
        })
            .mouseleave(function () {
                $(this).find(".item__overlay").fadeOut();
            });
    });

    $(".section__portfolio .dropdown__sort .dropdown-menu > div").click(function() {

        $("#dropdownMenuButton").html($(this).text());
        $('#sortOrder').val($(this).data('value'));

    });

    $('#filterBtn').click(function () {
        $('#filterForm').fadeIn();
    });

    $('#closeForm').click(function () {
        $('#filterForm').fadeOut();
    });

    $('#clearBtn').click(function () {
        $('#filterForm .filter-col__checkbox').prop('checked', false);
    });

    $('#searchBtn').click(function () {
        $('#searchForm').fadeIn();
        $('#searchForm input').focus();
    });

    $('#closeSearchBtn').click(function () {
        $('#searchForm').fadeOut();
    });

    // news hero slider
    $('.news-slick').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2,
        prevArrow: '<button type="button" class="slick-prev"></button>',
        nextArrow: '<button type="button" class="slick-next"></button>',
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                adaptiveHeight: true
            }
        }]
    });

    // ---------share buttons---------
    // facebook
    $('.share_fb').click(function(e) {
        e.preventDefault();
        window.open('https://www.facebook.com/sharer/sharer.php?u=' + document.location.href,
            "mywindow", ",resizable=1,width=500,height=250");
    });

    // twitter
    $('.share_tw').click(function(e) {
        e.preventDefault();
        window.open('https://twitter.com/intent/tweet?text=' + document.title + ' ' + document.location.href,
            "mywindow", ",resizable=1,width=500,height=250");
    });

    // linkedin
    $('.share_in').click(function(e) {
        e.preventDefault();
        window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + document.location.href +
            '&title=' + document.title,
            "mywindow", ",resizable=1,width=500,height=250");
    });

});