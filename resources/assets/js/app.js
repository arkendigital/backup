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
