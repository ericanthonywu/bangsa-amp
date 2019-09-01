jQuery(document).ready(function($) {

	var theInt = null;
	var $crosslink, $navthumb;
	var curclicked = 0;
	
	theInterval = function(cur){
		clearInterval(theInt);
		
		if( typeof cur != 'undefined' )
			curclicked = cur;
		
		$crosslink.removeClass("active-thumb");
		$navthumb.eq(curclicked).parent().addClass("active-thumb");
			$(".stripNav ul li a").eq(curclicked).trigger('click');
		
		theInt = setInterval(function(){
			$crosslink.removeClass("active-thumb");
			$navthumb.eq(curclicked).parent().addClass("active-thumb");
			$(".stripNav ul li a").eq(curclicked).trigger('click');
			curclicked++;
			if( 5 == curclicked )
				curclicked = 0;
			
		}, 5000);
	};
	
	$(function(){
		
		$("#main-photo-slider").codaSlider();
		
		$navthumb = $(".nav-thumb");
		$crosslink = $(".cross-link");
		
		$navthumb
		.click(function() {
			var $this = $(this);
			theInterval($this.parent().attr('href').slice(1) - 1);
			return false;
		});
		
		theInterval();
	});

	
	$("#featured").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 3000, true);
	
	
	$('#list-breaking-news').ticker({
		titleText: ''
	});
	
	/* TAB HOME */	
	$('ul.tabhome').each(function(){
		var $active, $content, $links = $(this).find('a');
		$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
		$active.addClass('active');
		$content = $($active.attr('href'));

		$links.not($active).each(function () {
			$($(this).attr('href')).hide();
		});
		
		$(this).on('click', 'a', function(e){
			// Make the old tab inactive.
			$active.removeClass('active');
			$content.hide();

			// Update the variables with the new link and content
			$active = $(this);
			$content = $($(this).attr('href'));

			// Make the tab active.
			$active.addClass('active');
			$content.show();

			// Prevent the anchor's default click action
			e.preventDefault();
		});
	});
	
	/* MENU */
	$('ul#menu-top').superfish({
		pathClass:	'current'
	});
	
    $('ul#menu-top a.object-active').each(function() {
        if( this.href == window.location ) {
            $(this).parent().addClass('active');
        }
    });
	
	$('div.pagination li.page').each(function(){
        if( this.href == window.location ) {
            $(this).parent().addClass('active');
        }
	});
	
	jQuerybaseUrl = window.location.protocol + "//" + window.location.host + "/azzamcms/";
	$('.loadmorecomment').click(function(){
		if($(this).hasClass('okloadmore')){}
		else{
		$(this).addClass('okloadmore');
		var	ids = $(this).attr('data-id');
			$.ajax({
				type: 'POST',
				url: jQuerybaseUrl+'komentar/LoadMoreComment',
				dataType: 'json',
				data: {loadmore: ids},
				success: function(data){
					for(iz=0;iz < data.a.length;iz++){
						$('<li><div class="photo-user"><img src="" /></div><div class="right-comment-user"><div class="name-comment-user">'+data.a[iz]['fname']+" "+data.a[iz]['lname']+'</div><div class="date-comment-user">Jumat, 25 Januari 2014  |  20.00 WIB</div><div class="content-comment-user">'+data.a[iz]['comment']+'</div></div></li>').appendTo('.comment-ok-loaded');
					}
				}
			});
		}
	});
	
	$(".rslides").responsiveSlides({
		  auto: true,             // Boolean: Animate automatically, true or false
		  speed: 700,            // Integer: Speed of the transition, in milliseconds
		  timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
		  pager: false,           // Boolean: Show pager, true or false
		  nav: false,             // Boolean: Show navigation, true or false
		  random: false,          // Boolean: Randomize the order of the slides, true or false
		  pause: false,           // Boolean: Pause on hover, true or false
		  pauseControls: true,    // Boolean: Pause when hovering controls, true or false
		  prevText: "Previous",   // String: Text for the "previous" button
		  nextText: "Next",       // String: Text for the "next" button
		  maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
		  navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
		  manualControls: "",     // Selector: Declare custom pager navigation
		  namespace: "rslides",   // String: Change the default namespace used
		  before: function(){},   // Function: Before callback
		  after: function(){}     // Function: After callback
	});
	
	var firstNewsMaxHeight = 0;
	$('.block-berita-2 .first-news-block').each(function(){
		if($(this).height() > firstNewsMaxHeight)
			firstNewsMaxHeight = $(this).height();
	});
	$('.block-berita-2 .first-news-block').height(firstNewsMaxHeight);
	
	var menulistheight = 0;
	$('.menulist-bottom li').each(function(){
		if($(this).height() > menulistheight)
			menulistheight = $(this).height();
	});
	$('.menulist-bottom li').height(menulistheight);
	
});

jQuery(window).load(function(){
	var zxzcc = 0;
	$(".foto-berita-lain li").each(function(){
		if($(this).height() > zxzcc){
			zxzcc = $(this).height()
		}
	});
	$(".foto-berita-lain li").css({
		"height":zxzcc
	});	
});