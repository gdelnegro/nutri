
/* =========================================================
Dropdown menu
============================================================ */
jQuery(document).ready(function(){
	
	jQuery("#main-menu li").hover(function() {
		jQuery(this).find("ul").first().slideDown(100);
			}, function() {
		jQuery(this).find("ul").first().slideUp(100);
	});
	
	jQuery("#main-menu li").each(function() {
		if(jQuery(this).has("ul").length > 0) {
			jQuery(this).addClass("menu-arrow")
		}
	});

})

/* =========================================================
Create mobile menu
============================================================ */
function createMobileMenu(menu_id, mobile_menu_id){
    // Create the dropdown base
    jQuery("<select />").appendTo(menu_id);
    jQuery(menu_id).find('select').first().attr("id",mobile_menu_id);
    
    // Populate dropdown with menu items
    jQuery(menu_id).find('a').each(function() {        
        var el = jQuery(this);       
        
        var selected = '';
        if (el.parent().hasClass('current-menu-item') == true){
            selected = "selected='selected'";
        }        
        
        var depth = el.parents("ul").size();
        var space = '';
        if(depth > 1){
            for(i=1; i<depth; i++){
                space += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }
        }        
        
        jQuery("<option "+selected+" value='"+el.attr("href")+"'>"+space+el.text()+"</option>").appendTo(jQuery(menu_id).find('select').first());
    });
    jQuery(menu_id).find('select').first().change(function() {
        window.location = jQuery(this).find("option:selected").val();
    });    
}

jQuery(document).ready(function(){
    if(jQuery('#main-nav').length > 0){
        createMobileMenu('#main-nav','responsive-menu');	
    }
});

/* =========================================================
Top widget slider
============================================================ */
jQuery(window).load(function() {
	
	jQuery('.recent-works').carouFredSel({
		responsive: true,
		prev: '#prev-1',
		next: '#next-1',
		width: '100%',
		scroll: 1,
		auto: false,
		items: {
			width: 205,
			height: 'auto',
			visible: {				
				min: 1,
				max: 4
			}
		}
	});	
});
/* =========================================================
Image hover effect
============================================================ */
jQuery(document).ready(function(){
	  //video thumbnails hover
	 jQuery(".black-overlay").mouseenter(function(){
        jQuery(this).fadeTo(300, 0);
    }).mouseleave(function(){
        jQuery(this).fadeTo(300, 0.3);
    });
	
	 jQuery(".hover-effect").mouseenter(function(){
        jQuery(this).find('img').fadeTo(500, 0.5);
    }).mouseleave(function(){
         jQuery(this).find('img').fadeTo(300, 1);
    });
});

/* =========================================================
CMS icons hover
============================================================ */
jQuery(document).ready(function(){
    var kopa_cms = jQuery(".feature-service");
    
    if(kopa_cms.length > 0){
        kopa_cms.mouseenter(function(){
            jQuery(this).find('.hover-icon').first().fadeTo(300, 0);
			jQuery(this).find('.cms-icon').first().fadeTo(300, 1);
        }).mouseleave(function(){
            jQuery(this).find('.hover-icon').first().fadeTo(300, 1);
			jQuery(this).find('.cms-icon').first().fadeTo(300, 0);
        });	
    }
});

/* =========================================================
Testimonials
============================================================ */		
jQuery(function() {
    jQuery('.flexslider').flexslider({
        animation: "slide",
        slideshow: true, 
        controlsContainer: ".flexslider-container"
    });
});

/* =========================================================
Twitter
============================================================ */
jQuery(document).ready(function() {
    var twitter_update_list = jQuery('.twitter_outer');
    if(twitter_update_list.length > 0){
        jQuery.each(twitter_update_list, function(){            
            jQuery(this).find('.twitter_inner').first().tweet({
                join_text: "auto",
                username: jQuery(this).find('.tweet_id').first().val(),
                avatar_size: 22,
                count: jQuery(this).find('.tweet_count').first().val(),
                auto_join_text_default: "",
                auto_join_text_ed: "",
                auto_join_text_ing: "",
                auto_join_text_reply: "",
                auto_join_text_url: "",
                loading_text: "<center>loading tweets...</center><br/>",
                template: "{avatar}{join} {text}"
            });            
        });
    }
});
  
/* =========================================================
Flickr Feed
============================================================ */
jQuery(document).ready(function(){ 
	jQuery('#flickr-feed-1').jflickrfeed({
		limit: 8,
		qstrings: {
			id: '78715597@N07'
		},
		itemTemplate:
			'<li class="flickr-badge-image">' +
			'<a rel="prettyPhoto[kopa-flickr]" href="{{image}}" title="{{title}}">' +
			'<img src="{{image_s}}" alt="{{title}}" width="85px" heigth="85px" />' +
			'</a>' +
			'</li>'
	}, function(data) {
			jQuery("a[rel^='prettyPhoto']").prettyPhoto({
			show_title: false,
			deeplinking:false
		}).mouseenter(function(){
			//jQuery(this).find('img').fadeTo(500, 0.6);
		}).mouseleave(function(){
			//jQuery(this).find('img').fadeTo(400, 1);
		});
	});
});

/* =========================================================
Fix css
============================================================ */
jQuery(document).ready(function(){
	jQuery("#main-menu > li:last-child").css("margin-right",0);
	jQuery(".featured-widget .older-posts li:last-child").css("border-bottom","none");
	jQuery(".featured-widget .older-posts li:last-child").css("margin-bottom",0);
	jQuery(".featured-widget .older-posts li:last-child").css("padding-bottom",0);
	jQuery(".tweet_list li:last-child").css("border-bottom","none");
	jQuery(".tweet_list li:last-child").css("padding-bottom",0);
	jQuery(".social-links li:first-child").css("margin-left",0);
	
 });
 
/* =========================================================
Social icons hover
============================================================ */
jQuery(document).ready(function(){
   
    jQuery(".social-links a").mouseenter(function(){
        jQuery(this).find('img').fadeTo(300, 0);
    }).mouseleave(function(){
        jQuery(this).find('img').fadeTo(300, 1);
    });
	
	jQuery(".entry-social-links a").mouseenter(function(){
        jQuery(this).find('img').fadeTo(300, 0);
    }).mouseleave(function(){
        jQuery(this).find('img').fadeTo(300, 1);
    });	
});
/* =========================================================
Auto margin-left for #pf-container
============================================================ */
jQuery(document).ready(function(){
	var view_port_w = jQuery(window).width();
	var wrapper_w=jQuery(".wrapper").width();
	var auto_margin_left = (view_port_w - wrapper_w) / 2
	
	jQuery("#pf-container").css("margin-left",auto_margin_left);
	jQuery("#pf-container").css("margin-right",auto_margin_left);
	jQuery("#blog-container").css("margin-left",auto_margin_left);
	jQuery("#blog-container").css("margin-right",auto_margin_left);
});
/* =========================================================
Masonry
============================================================ */
jQuery(window).load(function() {
	
	var $container = jQuery('#pf-container');
	$container.imagesLoaded(function(){
	  $container.masonry({
		itemSelector : '.box',
		isAnimated: true
	  });
	});
	
	$('#blog-container').masonry({
	  itemSelector: '.item',
	  columnWidth: function( containerWidth ) {
		return containerWidth / 3;
	  },
	  isAnimated: true
	});
});

/* =========================================================
Newsletter Form
============================================================ */
jQuery(document).ready(function(){
    if(jQuery(".newsletter-form").length > 0){
	// Validate the contact form
	  jQuery('.newsletter-form').validate({
	
		// Add requirements to each of the fields
		rules: {			
			name: {
				required: false
			},
			email: {
				required: true,
				email: true
			},
			message: {
				required: false
			}
		},
		
		// Specify what error messages to display
		// when the user does something horrid
		messages: {
			email: {
				required: "Please enter your email.",
				email: "Please enter a valid email."
			}
		},
		
		// Use Ajax to send everything to processNewsletterForm.php
		submitHandler: function(form) {
			var defaultvalue = jQuery(".submit").attr("value");
			jQuery(".submit").attr("value", "Sending...");
			jQuery.ajax({
					type:'POST',
					url: jQuery('.newsletter-form').attr('action'),
					dataType:'html',
					async:true,
					data: {
						email : jQuery('.newsletter-form').find("[name=email]").first().val()                          
					},
					
					success : function(data){                                 
						jQuery("#newsletter-response").html(data).hide().slideDown("fast");
						jQuery(".submit").attr("value", defaultvalue);                            
					},
					error : function(XMLHttpRequest, textStatus, errorThrown) {}
				});  
				return false;
		}
	  });
	}
});
/* =========================================================
Comment Form
============================================================ */
jQuery(document).ready(function(){
    if(jQuery("#comments-form").length > 0){
	// Validate the contact form
	  jQuery('#comments-form').validate({
	
		// Add requirements to each of the fields
		rules: {
			name: {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			},
			message: {
				required: true,
				minlength: 10
			}
		},
		
		// Specify what error messages to display
		// when the user does something horrid
		messages: {
			name: {
				required: "Please enter your name.",
				minlength: jQuery.format("At least {0} characters required.")
			},
			email: {
				required: "Please enter your email.",
				email: "Please enter a valid email."
			},
			message: {
				required: "Please enter a message.",
				minlength: jQuery.format("At least {0} characters required.")
			}
		},
		
		// Use Ajax to send everything to processForm.php
		submitHandler: function(form) {
			jQuery("#submit-comment").attr("value", "Sending...");
			jQuery(form).ajaxSubmit({
				success: function(responseText, statusText, xhr, $form) {
					jQuery("#response").html(responseText).hide().slideDown("fast");
					jQuery("#submit-comment").attr("value", "Comment");
				}
			});
			return false;
		}
	  });
	}
});
/* =========================================================
Home page slider
============================================================ */
jQuery(document).ready(function(){
	$status = $(".status");
	var options = {
		autoPlay: true,
		autoPlayDelay: 4000,
		pauseOnHover: true,
		hidePreloaderDelay: 500,
		nextButton: true,
		prevButton: true,
		pauseButton: true,
		preloader: true,
		hidePreloaderUsingCSS: false,						
		animateStartingFrameIn: true,		
		navigationSkipThreshold: 750,
		customKeyEvents: {
			80: "pause"
		}
	};

	var sequence = jQuery("#sequence").sequence(options).data("sequence");

	sequence.afterNextFrameAnimatesIn = function() {
		if(sequence.settings.autoPlay && !sequence.hardPaused && !sequence.isPaused) {
			$status.addClass("active").css("opacity", 1);
		}
		jQuery(".prev, .next").css("cursor", "pointer").animate({"opacity": 1}, 500);
	};
	sequence.beforeCurrentFrameAnimatesOut = function() {
		if(sequence.settings.autoPlay && !sequence.hardPaused) {
			$status.css({"opacity": 0}, 500).removeClass("active");
		}
		jQuery(".prev, .next").css("cursor", "auto").animate({"opacity": .7}, 500);
	};
	sequence.paused = function() {
		$status.css({"opacity": 0}).removeClass("active").addClass("paused");
	};
	sequence.unpaused = function() {
		if(!sequence.hardPaused) {
			$status.removeClass("paused").addClass("active").css("opacity", 1)
		}				
	};
});


 