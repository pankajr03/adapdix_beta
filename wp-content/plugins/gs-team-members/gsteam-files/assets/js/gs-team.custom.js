jQuery.noConflict();


(function($){

	$(".flip-vertical").flip({
  			trigger: 'hover'
		});

	// On scroll effect
	var gstm_cbpcaro = document.getElementById( 'cbp-so-scroller' );
	if(gstm_cbpcaro != null ) {
		new cbpScroller( gstm_cbpcaro );
	}

 	// Call Gridder
    $('.gridder').gridderExpander({
        // scroll: true,
        scrollOffset: 30,
        scrollTo: "listitem",                  // panel or listitem
        animationSpeed: 400,
        animationEasing: "easeInOutExpo",
        showNav: true,                      // Show Navigation
        nextText: "<i class='fa fa-chevron-right'></i>",	// Next button text
        prevText: "<i class='fa fa-chevron-left'></i>",     // Previous button text
        closeText: "<i class='fa fa-times'></i>",           // Close button text
        onStart: function(){
            //Gridder Inititialized
        },
        onContent: function(){
            //Gridder Content Loaded
        },
        onClosed: function(){
            //Gridder Closed
        }
    });

    // Auto Height Fixing
	function fixButtonHeights() {
		var heights = new Array();
        
		// Loop to get all element heights
		$('.gs_tm_theme1 .single-member, .gs_tm_theme2 .single-member, .gs_tm_theme4 .single-member, .gs_tm_theme5 .single-member, .gs_tm_theme6 .single-member, .gs_tm_theme7 .single-member, .gs_tm_theme8 .single-member, .gs_tm_theme9 .single-member, .gs_tm_theme10 .single-member').each(function() {	
			// Need to let sizes be whatever they want so no overflow on resize
			$(this).css('min-height', '0');
			$(this).css('max-height', 'none');
			$(this).css('height', 'auto');

			// Then add size (no units) to array
	 		heights.push($(this).height());
		});

		// Find max height of all elements
		var max = Math.max.apply( Math, heights );

		// Set all heights to max height
		$('.gs_tm_theme1 .single-member, .gs_tm_theme2 .single-member, .gs_tm_theme4 .single-member, .gs_tm_theme5 .single-member, .gs_tm_theme6 .single-member, .gs_tm_theme7 .single-member, .gs_tm_theme8 .single-member, .gs_tm_theme9 .single-member, .gs_tm_theme10 .single-member').each(function() {
			$(this).css('height', max + 'px');
            // Note: IF box-sizing is border-box, would need to manually add border and padding to height (or tallest element will overflow by amount of vertical border + vertical padding)
		});	
	}

	// Team Isotop
	function filter_isotop(){

		// quick search regex
		var qsRegex;
		var buttonFilter;
		var filterValue;
		var filterlocation;
		var filterlanguage;
		var filtergender;
		var filterspeciality;

		// init Isotope
		var $grid = $('.gs-all-items-filter-wrapper').isotope({
		  itemSelector: '.gs-filter-single-item',
		  layoutMode: 'fitRows',
		  filter: function() {

		    var $this = $(this);
		    var searchResult = qsRegex ? $this.find('.gs-member-name').text().match( qsRegex ) : true;
		    var buttonResult = buttonFilter ? $this.is( buttonFilter ) : true;
		    var selectResult = filterValue ? $this.is( filterValue ) : true;
		    var filter_location = filterlocation ? $this.is( filterlocation ) : true;
		    var filter_language = filterlanguage ? $this.is( filterlanguage ) : true;
		    var filter_gender = filtergender ? $this.is( filtergender ) : true;
		    var filter_speciality = filterspeciality ? $this.is( filterspeciality ) : true;
		    
		    return searchResult && buttonResult && selectResult && filter_location && filter_language && filter_gender && filter_speciality;
		  }
		});

		$('.gs-team-filter-cats').on( 'click', 'li', function() {
		  buttonFilter = $( this ).attr('data-filter');
		  if ( buttonFilter == 'all' ) {
				buttonFilter = '*';
			}
		  $grid.isotope();
		});

		$('.filters-select').on( 'change', function() {
			filterValue = this.value;
		  $grid.isotope();
		});

		$('.filters-select-location').on( 'change', function() {
			filterlocation = this.value;
		  $grid.isotope();
		});

		$('.filters-select-language').on( 'change', function() {
			filterlanguage = this.value;
		  $grid.isotope();
		});

		$('.filters-select-gender').on( 'change', function() {
			filtergender = this.value;
		  $grid.isotope();
		});

		$('.filters-select-speciality').on( 'change', function() {
			filterspeciality = this.value;
		  $grid.isotope();
		});

		// use value of search field to filter
		var $quicksearch = $('#quicksearch').keyup( debounce( function() {
		  qsRegex = new RegExp( $quicksearch.val(), 'gi' );
		  $grid.isotope();
		}) );


		  // change is-checked class on buttons
		$('.gs-team-filter-cats').each( function( i, buttonGroup ) {
		  var $buttonGroup = $( buttonGroup );
		  $buttonGroup.on( 'click', 'li', function() {
		    $buttonGroup.find('.active').removeClass('active');
		    $( this ).addClass('active');
		  });
		});
		  
		// debounce so filtering doesn't happen every millisecond
		function debounce( fn, threshold ) {
		  var timeout;
		  return function debounced() {
		    if ( timeout ) {
		      clearTimeout( timeout );
		    }
		    function delayed() {
		      fn();
		      timeout = null;
		    }
		    setTimeout( delayed, threshold || 100 );
		  };
		}

	}

	$(window).load(function() {
		// Fix heights on page load
		fixButtonHeights();
		filter_isotop();
	});

	$(window).resize(function() {
		// Needs to be a timeout function so it doesn't fire every ms of resize
		var handler = setTimeout(function() {
			// Celar the timeout function
      		clearTimeout(handler);
			
			// Fix heights on window resize
      		fixButtonHeights();
		}, 120);
	});


	//staff details for Theme 22 : Grid 2 – Hover
	$('.staff-member').hover(function(){
		
		var $staffmeta = $(this).children('.staff-meta');
		var $topvalue = ($staffmeta).outerHeight() + 10;
		
		$($staffmeta).stop(true, true).show()
			.animate({
				top: -$topvalue
			}, 400);
		
		}, function(){
			$(this).children('.staff-meta').stop(true, true).hide().css({
				top: -20
			}, 1000);
	});
	
	//staff opacity animation
	$("#staff-wrap").delegate(".staff-member", "mouseover mouseout", function(e) {
		if (e.type == 'mouseover') {
			$(".staff-member").not(this).dequeue().animate({opacity: "0.4"}, 600);
		} else {
			$(".staff-member").not(this).dequeue().animate({opacity: "1"}, 600);}
	});
	
	//staff opacity animation - categories
	$(".staff-category").delegate(".staff-member", "mouseover mouseout", function(e) {
		if (e.type == 'mouseover') {
			$(".staff-member").not(this).dequeue().animate({opacity: "0.4"}, 600);
		} else {
			$(".staff-member").not(this).dequeue().animate({opacity: "1"}, 600);}
	});


	//exporte les données sélectionnées
// var $table = $('#table');
//     $(function () {
//         $('#toolbar').find('select').change(function () {
//             $table.bootstrapTable('refreshOptions', {
//                 exportDataType: $(this).val()
//             });
//         });
//     })

// 		var trBoldBlue = $("table");

// 	$(trBoldBlue).on("click", "tr", function (){
// 			$(this).toggleClass("bold-blue");
// 	});

$('#tm_theme21').bootstrapTable();
	// var $search = $('.fixed-table-toolbar .search-input');
	// 	$search.attr('placeholder', 'Search the Directory');


  //   $('#tm_theme21').DataTable({
  //   	"info":     false,
  //   	"paging":   true,
  //   	 "responsive": true,
  //   	language: {

  //       search: "_INPUT_",
  //       searchPlaceholder: "Search the Directory"
  //   },
  //   "columnDefs": [
  //   { className: "Department", "targets": [ 1 ] },
  //   { className: "name", "targets": [ 0 ] }
  // ]
  //   });


})(jQuery);