// Magnific Popup Catch-all
var mpYouTubeOpts = {
	type: 'iframe',
	iframe: {
		patterns: {
			youtube: {
				index: 'youtube.com/',
				id: 'v=',
				src: 'https://www.youtube.com/embed/%id%?autoplay=1&autohide=1&modestbranding=1&rel=0&showinfo=0'
			},
			youtube_short: {
				index: 'youtu.be/',
				id: 'youtu.be/',
				src: 'https://www.youtube.com/embed/%id%?autoplay=1&autohide=1&modestbranding=1&rel=0&showinfo=0'
			}
		}
	},
	removalDelay: 300,
	mainClass: 'mfp-fade'
},
mpVimeoOpts = {
	type: 'iframe',
	removalDelay: 300,
	mainClass: 'mfp-fade'
},
mpWistiaOpts = {
	type: 'iframe',
	iframe: {
		patterns: {
			wistia: {
				index: 'wistia.com',
				id: function(url) {
					var m = url.match(/^.+wistia.com\/(medias)\/([^_]+)[^#]*(#medias=([^_&]+))?/);
					if (m !== null) {
						if(m[4] !== undefined) {
							return m[4];
						}
						return m[2];
					}
					return null;
				},
				src: 'https://fast.wistia.net/embed/iframe/%id%?autoPlay=1&muted=0&endVideoBehavior=reset' // https://wistia.com/doc/embed-options#options_list
			}
		}
	},
	removalDelay: 300,
    mainClass: 'mfp-fade'
},
mpImageOpts = {
	type: 'image',
	closeOnContentClick: true,
	fixedContentPos: true,
	image: {
		verticalFit: true,
		titleSrc: function(item) {
			var link    = item.el,
				img     = link.find('img'),
				title   = img.attr('title'),
				alt     = img.attr('alt'),
				caption = '';
			if (typeof alt !== 'undefined') {
				caption = alt;
			} else if (typeof title !== 'undefined') {
				caption = title;
			}
			return caption;
		}
	},
	zoom: {
		enabled: true,
		duration: 300,
		opener: function(element) {
			return element.find('img');
		}
	}
},
mpGalleryOpts = {
	type: 'image',
	delegate: 'a',
	image: {
		verticalFit: true,
		titleSrc: function(item) {
			var link    = item.el,
				img     = link.find('img'),
				title   = img.attr('title'),
				alt     = img.attr('alt'),
				caption = '';
			if (typeof alt !== 'undefined') {
				caption = alt;
			} else if (typeof title !== 'undefined') {
				caption = title;
			}
			return caption;
		}
	},
	gallery: {
		enabled: true
	},
	zoom: {
		enabled: true,
		duration: 300,
		opener: function(element) {
			return element.find('img');
		}
	}
};

// Links with .lightbox class
$('.lightbox').magnificPopup();

// Images (images linked to media file)
$('a[href$=".jpg"], a[href$=".png"], a[href$=".jpeg"], a[href$=".gif"]').not('.gallery a').magnificPopup(mpImageOpts);

// Image galleries (images linked to media file)
$('.gallery').magnificPopup(mpGalleryOpts);

// Video links
$('a[href*="youtube.com"]').magnificPopup(mpYouTubeOpts);
$('a[href*="youtu.be"]').magnificPopup(mpYouTubeOpts);
$('a[href*="vimeo.com"]').magnificPopup(mpVimeoOpts);
$('a[href*="wistia.com"]').magnificPopup(mpWistiaOpts);
