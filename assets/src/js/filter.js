jQuery(function($){

    function itemOverlay() {
        $('.item').each(function () {
            $(this).mouseenter(function () {
                $(this).find(".item__overlay").fadeIn();
            })
                .mouseleave(function () {
                    $(this).find(".item__overlay").fadeOut();
                });
        });
    }

    /* Load More */
    /*$('#loadMore').click(function(){

        $.ajax({
            url : loadmore_params.ajaxurl,
            data : {
                'action': 'loadmorebutton',
                'query': loadmore_params.posts,
                'page' : loadmore_params.current_page
            },
            type : 'POST',
            beforeSend : function ( xhr ) {
                $('#loadMore').text('Loading...'); // some type of preloader
            },
            success : function( posts ){
                if( posts ) {
                    $('#loadMore').text( 'Load More' );
                    $('#response').append( posts );
                    loadmore_params.current_page++;
                    itemOverlay();

                    if ( loadmore_params.current_page == loadmore_params.max_page )
                        $('#loadMore').hide();

                } else {
                    $('#loadMore').hide();
                }
            }
        });
        return false;
    });*/

    /* Infinity scroll */
    $('#response').after('<div id="load-more"></div>');
    var button = $('#load-more');
    //var link = $('#response');
    //var topEl = link.offset().top;
    //var heightEl = link.height();
    var loading = false;
    var isNoMore = false;
    var scrollHandling = {
        allow: true,
        reallow: function () {
            scrollHandling.allow = true;
        },
        delay: 400
    };

    checkIsNeedNewLoads();

    $(window).scroll(function () {
        if (isScrolledBottom() && !loading && scrollHandling.allow && !isNoMore) {
            addNewItems();
        }
    });

    function isScrolledBottom() {
        return ( $(window).scrollTop() + $(window).height()) > ($(document).height() - 300 );
    }

    function addNewItems(successCB) {
        //console.log('add new ' + Math.random());
        var scrollInfo = $('<div class="scroll-info"></div>');
        $('#response').append( scrollInfo );
        scrollHandling.allow = false;
        setTimeout(scrollHandling.reallow, scrollHandling.delay);
        var offset = $(button).offset().top - $(window).scrollTop();
        //console.log(offset);
        if (2000 > offset) {
            loading = true;
            scrollInfo.append('<img src="/wp-content/themes/crosscut/assets/img/icons/Spinner-1s-200px.svg" alt="">');
            $.ajax({
                url : loadmore_params.ajaxurl,
                data : {
                    'action': 'loadmorebutton',
                    'query': loadmore_params.posts,
                    'page' : loadmore_params.current_page
                },
                type : 'POST',
                success : function( posts ){
                    if( posts ) {
                        setTimeout(function () {
                            $('#response').append( posts );
                            loadmore_params.current_page++;
                            itemOverlay();
                            scrollInfo.remove();
                            loading = false;
                            if (successCB != undefined) {
                                successCB();
                            }

                        },1000);
                    } else {
                        scrollInfo.remove();
                        isNoMore = true;
                        //console.log('No more post!');
                    }
                }
            });
        }
    }

    function checkIsNeedNewLoads() {
        var offset = $('#response').offset().top + $('#response').outerHeight(true);
        var windowsHeight = $(window).height();
        if (windowsHeight > offset) {
            addNewItems(function () {
                checkIsNeedNewLoads();
            });
        }
    }

    function filter(target, event) {
        $(target).on(event,function() {
            var filter = $('#filter');
            $.ajax({
                url : loadmore_params.ajaxurl,
                data : filter.serialize(),
                dataType : 'json',
                type : 'POST',
                beforeSend:function(xhr){
                    $('#response .item .item__logo').html('<img class="load-spinner" src="/wp-content/themes/crosscut/assets/img/icons/Spinner-1s-200px.svg" alt="">');
                },
                success:function(data) {
                    loadmore_params.current_page = 1;
                    loadmore_params.posts = data.posts;
                    console.log(data.posts);

                    loadmore_params.max_page = data.max_page;
                    $('#response').html(data.content);
                    $('#filterForm').fadeOut();
                    itemOverlay();

                    if ( data.max_page < 2 ) {
                        $('#loadMore').hide();
                    } else {
                        $('#loadMore').show();
                    }
                }
            });
            return false;
        });
    }

    //Orderby by ASC or DESC
    //filter('.portfolio__filter_sort .dropdown-item', 'click');

    //Filter by terms
    filter('#filterBtnApply', 'click');

    //Search input
    filter('#portfolioTitle', 'keyup');

});