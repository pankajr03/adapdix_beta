jQuery(document).ready(function($) {
var WPTeamModel = (function() {

    var $teamList = $(".sptp-popup-grid, .swiper-wrapper, .filtr-item, .sptp-grid, .sptp-inline, .sptp-mosaic, .sptp-table-layout td, .sptp-list, .sptp-mosaic, .sptp-table"),
        $teamItems = $(".sptp-popup-items"),
        $teamItem = $(".sptp-popup-item"),
        $modal=$('.sptp-modal'),
        init = function() {
            bindUIActions();
        },

        bindUIActions = function() {
            $teamItems.on("click", ".sptp-popup-close", Modalclose);
            $teamList.on("click", ".sptp-popup-trigger", Modalopen);

            $teamList.on("click", ".sptp-popup-trigger", function() {});

            $teamItems.on("click", ".sptp-nav-item", WPTeamSlider);
            $(document).on("click", ".sptp-popup-items", bgclick);
            $(document).keyup(keyBinding);
        },
        bgclick = function(e) {
            if (e.target != this) return;
            Modalclose(e);
        }

        Modalopen = function(e) {
            e.preventDefault();
            
            $(".sptp-popup-content").css('padding', 0);
            $(".sptp-popup-content").css('padding', 40);
            $modal = $(this).parents(".sptp-modal");
            var popItem = $(this).attr('href');
            var sptpSectionId = $(this).closest('.sptp-section').attr('id')
            $(popItem).parents('#' + sptpSectionId +' .sptp-popup-items').addClass('sptp-popup-on');
            $(popItem).addClass('sptp-popup-open');
            $('html').addClass('sptp-popup-on');
        },
        Modalclose = function(e) {
            e.preventDefault();
            $teamItems.removeClass('sptp-popup-on');
            $teamItem.removeClass('sptp-popup-open');
            $('html').removeClass('sptp-popup-on');
            $('.sptp-popup-item').removeClass('sptp-popup-open');
        },
        WPTeamSlider = function(e) {
            e.preventDefault();
            var direction = 'forward';
            if ($(this).hasClass('sptp-nav-left')) {
                direction = 'rewind';
            }
            Modalplay(direction);
        },
        keyBinding = function(e) {
            switch (e.keyCode) {
                case 27:
                    Modalclose(e);
                    break;
                case 39:
                    Modalplay('forward');
                    break;
                case 37:
                    Modalplay('rewind');
                    break;
            }
        },
        Modalplay = function(direction) {
            var $curentOpen=$modal.find('.sptp-popup-open'),
                $curenItem =$modal.find('.sptp-popup-item'),
                $slideritem = $curentOpen.prev('.sptp-popup-item'),
                $circleslide = $curenItem.last('.sptp-popup-item');
            if (direction == 'forward') {
                $slideritem =$curentOpen.next('.sptp-popup-item');
                $circleslide = $curenItem.first('.sptp-popup-item');
            }
            if ($slideritem.length == 0) {
                $curentOpen.removeClass('sptp-popup-open');
                $circleslide.addClass('sptp-popup-open');
            } else {
                $curentOpen.removeClass('sptp-popup-open');
                $slideritem.addClass('sptp-popup-open');
            } 
        };
    return {
        init: init
    }

})();
WPTeamModel.init();
});