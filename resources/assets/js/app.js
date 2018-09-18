require("./components/alert")
require("./components/uploadphoto")
require("./components/discussion")
require("./components/jobs")
require("./components/navigation")
require("./components/search")
require("./components/exams")
require("./components/map")
require("./components/fileupload")
require("./components/salary-survey")
require("./components/scroll-to-top")
require("./components/account")

$(function() {
	var myLazyLoad = new LazyLoad({
		elements_selector: ".lazy"
	});
});

$(document).euCookieLawPopup().init({
	cookiePolicyUrl : "/privacy-cookies",
	popupPosition : 'bottom',
	colorStyle : 'default',
	compactStyle : false,
	popupTitle : 'We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.',
	popupText : '',
	buttonContinueTitle : 'Continue',
	buttonLearnmoreTitle : 'More Info',
	buttonLearnmoreOpenInNewWindow : false,
	agreementExpiresInDays : 30,
	autoAcceptCookiePolicy : false,
	htmlMarkup : null
});
