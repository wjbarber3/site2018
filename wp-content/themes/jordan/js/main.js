(function($){

    /*
    |--------------------------------------------------------------------------
    | Header Functionality
    |--------------------------------------------------------------------------
    | This object houses any functionality associated with the header
    |
    */
    Header = {
        navLink : 'nav li a',
        header: 'header',
        init: function() {
            $(window).scroll(this.animateHeader.bind(this));
        },
        animateHeader: function() {
            var scrollTop = $(window).scrollTop();
            if ( scrollTop > 0 && !$(this.header).hasClass("scrolled") ) {
                $(this.header).addClass("scrolled");
            } else if ( scrollTop == 0 && $(this.header).hasClass("scrolled") ) {
                $(this.header).removeClass("scrolled");
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Scrolling Animations
    |--------------------------------------------------------------------------
    | Right now this only works for the featured section of homepage
    |
    */
    ScrollEvents = {
        featured: '#featured',
        featuredDesc: '#featured .description',
        featuredImg: '#featured img',
        about: '#about',
        aboutBox: '#about .box',
        init: function() {
            $(window).scroll(this.fireEvents.bind(this));
        },
        fireEvents: function() {
            var scrollBottom = $(window).scrollTop() + $(window).height(),
                featuredTop = $(this.featured).offset().top + 300,
                aboutTop = $(this.about).offset().top + 300;
            if ( $(window).width() > 767 ) {
                if ( scrollBottom > featuredTop ) {
                    setTimeout(function() {
                        $("#featured .description").addClass("active");
                    }, 300);
                    $(this.featuredImg).addClass("slid");
                }
                if ( scrollBottom > aboutTop ) {
                    $(this.aboutBox).css({
                        "top": "50%",
                        "opacity" : "1"
                    });
                }
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Quotes Section
    |--------------------------------------------------------------------------
    | Object houses functionality for quotes section
    |
    */
    Quotes = {
        quote: '.quote',
        leftButton: '.control-left',
        rightButton: '.control-right',
        nameControl: '.name-controls li',
        init: function() {
            $(this.leftButton).click(this.moveLeft.bind(this));
            $(this.rightButton).click(this.moveRight.bind(this));
            $(this.nameControl).click(this.showQuote.bind(this));
        },
        moveRight: function(e) {
            e.preventDefault();
            var activeQuote = $('.quote.active'),
                nextUp = activeQuote.next(),
                activeName = $('.name-controls li.active'),
                nextName = activeName.next(),
                lastQuote = $(this.quote).last();
            activeQuote.removeClass("active");
            nextUp.addClass("active");
            activeName.removeClass("active");
            nextName.addClass("active");
            $(this.leftButton).removeClass("disabled");
            if ( lastQuote.hasClass("active") ) {
                $(this.rightButton).addClass("disabled");
            }
        },
        moveLeft: function(e) {
            e.preventDefault();
            var activeQuote = $('.quote.active'),
                nextUp = activeQuote.prev(),
                activeName = $('.name-controls li.active'),
                nextName = activeName.prev(),
                firstQuote = $(this.quote).first();
            activeQuote.removeClass("active");
            nextUp.addClass("active");
            activeName.removeClass("active");
            nextName.addClass("active");
            $(this.rightButton).removeClass("disabled");
            if ( firstQuote.hasClass("active") ) {
                $(this.leftButton).addClass("disabled");
            }
        },
        showQuote: function(e) {
            e.preventDefault();
            var target = $(e.target),
                targetIndex = target.index(this.nameControl),
                activeQuote = $('.quote.active'),
                firstQuote = $(this.quote).first(),
                lastQuote = $(this.quote).last();
            $(this.nameControl).removeClass("active");
            target.addClass("active");
            activeQuote.removeClass("active");
            $(this.quote).eq(targetIndex).addClass("active");
            $(this.leftButton).removeClass("disabled");
            $(this.rightButton).removeClass("disabled");
            if ( firstQuote.hasClass("active") ) {
                $(this.leftButton).addClass("disabled");
            } else if ( lastQuote.hasClass("active") ) {
                $(this.rightButton).addClass("disabled");
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Case Studies
    |--------------------------------------------------------------------------
    | This object houses functionality for showing the list of case studies
    | from the link in the header, pulls in custom post type via Ajax
    */
    CaseStudyOverlay = {
        overlay: '#full-overlay',
        container: '#case-study-container',
        trigger: '.work-trigger',
        close: '.close-work',
        loader: '#work-loader',
        init: function() {
            $(this.trigger).click(this.showGrid.bind(this));
            $.ajaxSetup({cache:false});
            $(this.close).click(this.killGrid.bind(this));
        },
        showGrid: function(e) {
            e.preventDefault();
            // $(this.container).append(this.loader);
            $(this.loader).show();
            $(this.container).load("/case-study/");
            $(this.overlay).fadeIn();
            $('body, html').css("overflowY", "hidden");
        },
        killGrid: function() {
            $(this.container).empty();
            $(this.overlay).fadeOut();
            $('body, html').css("overflowY", "scroll");
        }
    }

    BackgroundAnimation = {
        backgroundLogo: '.big-logo-container',
        headline: '.opening .headline',
        companies: '.opening .companies',
        init: function() {
            if ( $(window).width() > 767 ) {
                $(window).scroll(this.animateLogo.bind(this));  
            }
        },
        animateLogo: function() {
            var scrollTop = $(window).scrollTop();
                var opacity = Math.max(0, 1 - (scrollTop / 400)),
                    scale = Math.max(0, 1 - (scrollTop / 1000)),
                    companyOpacity = Math.max(0, 1 - (scrollTop / 700));
            $(this.backgroundLogo).css("transform", "scale("+scale+")");
            $(this.backgroundLogo).css("opacity", opacity);
            $(this.headline).css("opacity", opacity);
            $(this.companies).css("opacity", companyOpacity);

        }
    }

    $(document).ready(function() {
        Header.init();
        Quotes.init();
        BackgroundAnimation.init();
        CaseStudyOverlay.init();
        if ( $('body.home').is('*') ) {
            ScrollEvents.init();
        }
        $("#contact input, #contact select, #contact textarea").on("focus", function(){
            $(this).parent('.ginput_container').siblings('.gfield_label').css("color", "#ff1940");
            $(this).css("border-color", "#ff1940")
        })
        $("#contact input, #contact select, #contact textarea").on("focusout", function(){
            $(this).parent('.ginput_container').siblings('.gfield_label').css("color", "#93a185");
            $(this).css("border-color", "#93a185")
        })
        AOS.init();
    })

})(jQuery);

function customScroll(e, element, offset) {
    e.preventDefault();
    jQuery('html, body').animate({
        scrollTop: jQuery(element).offset().top - offset
    }, 1000);
}

