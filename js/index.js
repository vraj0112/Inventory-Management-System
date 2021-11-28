

jQuery(document).ready(function(){

	"use strict";
	
	edina_tm_animate_text();

	

	
});

function edina_tm_animate_text(){
	
	"use strict";
	
	var animateSpan			= jQuery('.edina_tm_animation_text_word');
	
		animateSpan.typed({
			strings: ["Cement", "Vitrified Tiles", "Wall Tiles", "Floor Tiles", "Parking Tiles", "Sanitryware", "Bathroom Fittings", "Kichen Sink", "Chemicals", "Hardware"],
			loop: true,
			startDelay: 1e3,
			backDelay: 2e3
		});
}

