/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(14);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(2);
__webpack_require__(3);
__webpack_require__(4);
__webpack_require__(5);
__webpack_require__(6);
__webpack_require__(7);
__webpack_require__(8);
__webpack_require__(9);
__webpack_require__(10);
__webpack_require__(11);
__webpack_require__(12);
__webpack_require__(13);

$(function () {
	var myLazyLoad = new LazyLoad({
		elements_selector: ".lazy"
	});
});

$(document).euCookieLawPopup().init({
	cookiePolicyUrl: "/privacy-cookies",
	popupPosition: 'bottom',
	colorStyle: 'default',
	compactStyle: false,
	popupTitle: 'We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.',
	popupText: '',
	buttonContinueTitle: 'Continue',
	buttonLearnmoreTitle: 'More Info',
	buttonLearnmoreOpenInNewWindow: false,
	agreementExpiresInDays: 30,
	autoAcceptCookiePolicy: false,
	htmlMarkup: null
});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

$(function () {

  $(".alert_button").click(function () {
    $(this).closest(".alert").fadeOut();
  });
});

/***/ }),
/* 3 */
/***/ (function(module, exports) {

function readURL(input, element) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(element).attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

$(function () {
  $("#avatar-image").click(function () {
    $("#avatar").click();
  });
  $("#avatar").change(function () {
    readURL(this, "#avatar-image");
  });
});

/***/ }),
/* 4 */
/***/ (function(module, exports) {

/**
* Open add discussion popover.
*
*/
$(".discussion-add-button").click(function () {
  $("html, body").css("overflow", "hidden");
  $(".discussion-popover").addClass("discussion-popover-active");
});

/**
* Close popover.
*
*/
$(".discussion-popover-close").click(function () {
  $("html, body").css("overflow", "scroll");
  $(this).closest(".discussion-popover").removeClass("discussion-popover-active");
});

/**
* Discussion reply form submission.
*
*/
/*
$("#discussion-reply-form").submit(function(e) {

  e.preventDefault;

  $.ajax({
    type: "POST",
    url: $(this).attr('action'),
    data: new FormData( this ),
    processData: false,
    contentType: false,
    success: function(response){

      $("#newDiscussionReply").append(response);
      $(".discussion-view-reply-editor").trumbowyg("empty");

    },
    error: function(response) {

      alert("Please enter some content...");

    }
  });

  return false;

});
*/

$('.discussion-view-reply-editor, .discussion-edit-content-editor').trumbowyg({
  svgPath: '/images/icons.svg',
  btns: ['strong', 'link', 'unorderedList', 'orderedList', 'undo', 'redo', 'upload']
});

/**
 * User clicks the reply button
 *
 */
$(".discussion-button--reply").click(function () {
  $('html, body').animate({
    scrollTop: $(".discussion-view-reply").offset().top - 15
  }, 1000);
});

$(".discussion-sidebar__mobile-menu").click(function () {

  if ($(".discussion-sidebar__categories").hasClass("active")) {

    hideCategories();
  } else {

    showCategories();
  }
});

function showCategories() {

  $(".discussion-sidebar__categories").addClass("active");
  $(".discussion-sidebar__categories").slideDown();

  $(".discussion-sidebar__mobile-menu span").html("Hide Categories");

  $("html, body").animate({
    scrollTop: $('.discussion-sidebar__mobile-menu').offset().top - 15
  }, 1000);
}

function hideCategories() {

  $(".discussion-sidebar__categories").removeClass("active");
  $(".discussion-sidebar__categories").slideUp();

  $(".discussion-sidebar__mobile-menu span").html("Show Categories");
}

/***/ }),
/* 5 */
/***/ (function(module, exports) {

$(".advertising-toggle").click(function () {

    console.log($(this).attr("data-id"));

    /**
    * Hide any current showing toggle items.
    *
    */
    $(".advertising-toggle-item").slideUp();

    /**
    * Show the correct one.
    *
    */
    $("#" + $(this).attr("data-id")).slideDown();

    $('html, body').animate({
        scrollTop: $("#" + $(this).attr("data-id")).offset().top - 50
    }, 1000);
});

$(".job-list-filter-toggle").click(function () {

    if ($(".job-list-sidebar").hasClass("active")) {

        hideCategories();
    } else {

        showCategories();
    }
});

function showCategories() {

    $(".job-list-sidebar").addClass("active");
    $(".job-list-sidebar").slideDown();
    $(".job-list-banner").slideDown();

    $(".job-list-filter-toggle").html("Hide Filtering");

    $("html, body").animate({
        scrollTop: $('.job-list-banner').offset().top - 15
    }, 1000);
}

function hideCategories() {

    $(".job-list-sidebar").removeClass("active");
    $(".job-list-sidebar").slideUp();
    $(".job-list-banner").slideUp();

    $(".job-list-filter-toggle").html("Show Filtering");
}

/***/ }),
/* 6 */
/***/ (function(module, exports) {

$(".header-burger").click(function () {
  showNav();
});

$(".navigation-overlay").click(function () {
  hideNav();
});

function hideNav() {
  $("html, body").removeClass("navigation-active");
  $(".navigation-overlay").fadeOut();
  $("nav").animate({
    width: "0"
  });
}

function showNav() {
  $("html, body").addClass("navigation-active");
  $(".navigation-overlay").fadeIn();
  $("nav").show();
  $("nav").animate({
    width: "85%"
  });
}

/***/ }),
/* 7 */
/***/ (function(module, exports) {

$(".header-search, .header-search-icon").click(function () {

    if ($(".search").hasClass("search-open")) {
        closeSearch();
    } else {
        showSearch();
    }
});

$(".search__close").click(function () {
    closeSearch();
});

function showSearch() {
    $(".search").fadeIn();
    $(".search__input").focus();
}

function closeSearch() {
    $(".search").fadeOut();
}

/***/ }),
/* 8 */
/***/ (function(module, exports) {

$(".exam-modules-slider-item").click(function () {

  /**
  * Get module id.
  *
  */
  var module_id = $(this).attr("data-module-id");

  /**
  * Remove any active classes.
  * Hide all of the containers
  *
  */
  $(".exam-modules-slider-item").removeClass("exam-modules-slider-item-active");
  $(".exam-modules-info-container").hide();

  /**
  * Activate this item.
  *
  */
  $(this).addClass("exam-modules-slider-item-active");
  $("#exam-modules-info-container-" + module_id).show();
});

$(".survey-answer-dropdown-item").click(function () {

  /**
  * Get vars.
  *
  */
  var module_id = $(this).attr("data-module-id");
  var module_name = $(this).attr("data-module-name");
  var category_id = $(this).attr("data-category-id");

  $(".survey-answer-cat").removeClass("survey-answer-active");

  // $(".survey-answer-cat").hide();
  // $(".survey-answer-dropdown").hide();
  // $("#survey-answer-cat-"+category_id).show();
  $("#survey-answer-category-" + category_id).html(module_name);
  $("#survey-answer-category-" + category_id).parent().parent().addClass("survey-answer-active");

  $("#module_id").val(module_id);
});

$(".survey-answer-difficulty").click(function () {

  var difficulty = $(this).attr("data-difficulty");

  $(".survey-answer-difficulty").removeClass("survey-answer-active");

  $(this).addClass("survey-answer-active");

  $("#difficulty").val(difficulty);
});

$(".survey-button-add").click(function (e) {

  e.preventDefault;

  var module_id = $("#module_id").val();
  var difficulty = $("#difficulty").val();

  $.ajax({
    type: "POST",
    url: $("#survey-form").attr('action'),
    data: {
      module_id: module_id,
      difficulty: difficulty
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(response) {

      if (response == "OK") {
        // location.href = '/exams/survey/results';

        $("#survey-before").hide();
        $("#salary-survey-footer-after-submission").show();
      }
    },
    error: function error(response) {
      console.log("ERROR");
      console.log(response);
    }
  });

  return false;
});

/***/ }),
/* 9 */
/***/ (function(module, exports) {

// AIzaSyBHVFTM_LS8YLRx8fog61RzDT054G4C8jY

function initMap() {
  var myLatLng = { lat: -25.363, lng: 131.044 };

  // Create a map object and specify the DOM element for display.
  var map = new google.maps.Map(document.getElementById('map'), {
    center: myLatLng,
    zoom: 4
  });

  // Create a marker and set its position.
  var marker = new google.maps.Marker({
    map: map,
    position: myLatLng,
    title: 'Hello World!'
  });
}

/***/ }),
/* 10 */
/***/ (function(module, exports) {

function readName(input, element) {

  if (input.files && input.files[0]) {

    var file_name = input.files[0].name;

    $(element + " span").html(file_name);
  }
}

$(function () {
  $(".file-upload").click(function () {

    var file_input = $(this).attr("data-id");

    $("#" + file_input).click();
  });
  $(".file-upload-input").change(function () {

    var file_upload_container = $(this).attr("data-id");

    readName(this, "#" + file_upload_container);
  });
});

/***/ }),
/* 11 */
/***/ (function(module, exports) {

$("#salary-survey-form").submit(function (e) {

  e.preventDefault;

  $.ajax({
    type: "POST",
    url: $(this).attr('action'),
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function success(response) {

      console.log("SUCCESS");
      console.log(response);

      if (response == "OK") {
        $("#salary-survey-footer-before-submission").hide();
        $("#salary-survey-footer-after-submission").show();
      }
    },
    error: function error(response) {

      console.log("ERROR");
      console.log(response);

      alert("Please enter some content...");
    }
  });

  return false;
});

$(".salary-survey-question-answer-clickable").click(function () {

  /**
  * Define variables.
  *
  */
  var key = $(this).attr("data-key");
  var value = $(this).attr("data-value");

  if (key == "type") {
    $(".salary-survey-question-answer-input").hide();

    $("#input-" + value).show();
  }

  /**
  * Update hidden field with value.
  *
  */
  $("#" + key).val(value);

  /**
  * Remove active from other answers on this question.
  *
  */
  $(".salary-survey-question-answer-clickable-" + key).removeClass("salary-survey-question-answer-clickable-active");

  /**
  * Activate clicked answer.
  *
  */
  $(this).addClass("salary-survey-question-answer-clickable-active");
});

/***/ }),
/* 12 */
/***/ (function(module, exports) {

$(".site-scroll-to-top").click(function () {

    $('html, body').animate({
        scrollTop: $("html").offset().top
    }, 1000);
});

/***/ }),
/* 13 */
/***/ (function(module, exports) {

$(function () {

  $(".account_page_delete").click(function () {
    swal({
      title: "Are you sure?",
      text: "Once deleted you cannot retrieve this again in the future!",
      icon: "warning",
      buttons: true,
      dangerMode: true
    }).then(function (willDelete) {
      if (willDelete) {

        $("#delete_account_form").submit();
      } else {

        return false;
      }
    });
  });
});

/***/ }),
/* 14 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAgOTQ0Y2FhNjZjOGEwOWU2MGExZWQiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9jb21wb25lbnRzL2FsZXJ0LmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvY29tcG9uZW50cy91cGxvYWRwaG90by5qcyIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2NvbXBvbmVudHMvZGlzY3Vzc2lvbi5qcyIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2NvbXBvbmVudHMvam9icy5qcyIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2NvbXBvbmVudHMvbmF2aWdhdGlvbi5qcyIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2NvbXBvbmVudHMvc2VhcmNoLmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvY29tcG9uZW50cy9leGFtcy5qcyIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2NvbXBvbmVudHMvbWFwLmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvY29tcG9uZW50cy9maWxldXBsb2FkLmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvY29tcG9uZW50cy9zYWxhcnktc3VydmV5LmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvY29tcG9uZW50cy9zY3JvbGwtdG8tdG9wLmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvY29tcG9uZW50cy9hY2NvdW50LmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvc2Fzcy9hcHAuc2NzcyJdLCJuYW1lcyI6WyJyZXF1aXJlIiwiJCIsIm15TGF6eUxvYWQiLCJMYXp5TG9hZCIsImVsZW1lbnRzX3NlbGVjdG9yIiwiZG9jdW1lbnQiLCJldUNvb2tpZUxhd1BvcHVwIiwiaW5pdCIsImNvb2tpZVBvbGljeVVybCIsInBvcHVwUG9zaXRpb24iLCJjb2xvclN0eWxlIiwiY29tcGFjdFN0eWxlIiwicG9wdXBUaXRsZSIsInBvcHVwVGV4dCIsImJ1dHRvbkNvbnRpbnVlVGl0bGUiLCJidXR0b25MZWFybm1vcmVUaXRsZSIsImJ1dHRvbkxlYXJubW9yZU9wZW5Jbk5ld1dpbmRvdyIsImFncmVlbWVudEV4cGlyZXNJbkRheXMiLCJhdXRvQWNjZXB0Q29va2llUG9saWN5IiwiaHRtbE1hcmt1cCIsImNsaWNrIiwiY2xvc2VzdCIsImZhZGVPdXQiLCJyZWFkVVJMIiwiaW5wdXQiLCJlbGVtZW50IiwiZmlsZXMiLCJyZWFkZXIiLCJGaWxlUmVhZGVyIiwib25sb2FkIiwiZSIsImF0dHIiLCJ0YXJnZXQiLCJyZXN1bHQiLCJyZWFkQXNEYXRhVVJMIiwiY2hhbmdlIiwiY3NzIiwiYWRkQ2xhc3MiLCJyZW1vdmVDbGFzcyIsInRydW1ib3d5ZyIsInN2Z1BhdGgiLCJidG5zIiwiYW5pbWF0ZSIsInNjcm9sbFRvcCIsIm9mZnNldCIsInRvcCIsImhhc0NsYXNzIiwiaGlkZUNhdGVnb3JpZXMiLCJzaG93Q2F0ZWdvcmllcyIsInNsaWRlRG93biIsImh0bWwiLCJzbGlkZVVwIiwiY29uc29sZSIsImxvZyIsInNob3dOYXYiLCJoaWRlTmF2Iiwid2lkdGgiLCJmYWRlSW4iLCJzaG93IiwiY2xvc2VTZWFyY2giLCJzaG93U2VhcmNoIiwiZm9jdXMiLCJtb2R1bGVfaWQiLCJoaWRlIiwibW9kdWxlX25hbWUiLCJjYXRlZ29yeV9pZCIsInBhcmVudCIsInZhbCIsImRpZmZpY3VsdHkiLCJwcmV2ZW50RGVmYXVsdCIsImFqYXgiLCJ0eXBlIiwidXJsIiwiZGF0YSIsImhlYWRlcnMiLCJzdWNjZXNzIiwicmVzcG9uc2UiLCJlcnJvciIsImluaXRNYXAiLCJteUxhdExuZyIsImxhdCIsImxuZyIsIm1hcCIsImdvb2dsZSIsIm1hcHMiLCJNYXAiLCJnZXRFbGVtZW50QnlJZCIsImNlbnRlciIsInpvb20iLCJtYXJrZXIiLCJNYXJrZXIiLCJwb3NpdGlvbiIsInRpdGxlIiwicmVhZE5hbWUiLCJmaWxlX25hbWUiLCJuYW1lIiwiZmlsZV9pbnB1dCIsImZpbGVfdXBsb2FkX2NvbnRhaW5lciIsInN1Ym1pdCIsIkZvcm1EYXRhIiwicHJvY2Vzc0RhdGEiLCJjb250ZW50VHlwZSIsImFsZXJ0Iiwia2V5IiwidmFsdWUiLCJzd2FsIiwidGV4dCIsImljb24iLCJidXR0b25zIiwiZGFuZ2VyTW9kZSIsInRoZW4iLCJ3aWxsRGVsZXRlIl0sIm1hcHBpbmdzIjoiO0FBQUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLGFBQUs7QUFDTDtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBLG1DQUEyQiwwQkFBMEIsRUFBRTtBQUN2RCx5Q0FBaUMsZUFBZTtBQUNoRDtBQUNBO0FBQ0E7O0FBRUE7QUFDQSw4REFBc0QsK0RBQStEOztBQUVySDtBQUNBOztBQUVBO0FBQ0E7Ozs7Ozs7Ozs7Ozs7OztBQzdEQUEsbUJBQU9BLENBQUMsQ0FBUjtBQUNBQSxtQkFBT0EsQ0FBQyxDQUFSO0FBQ0FBLG1CQUFPQSxDQUFDLENBQVI7QUFDQUEsbUJBQU9BLENBQUMsQ0FBUjtBQUNBQSxtQkFBT0EsQ0FBQyxDQUFSO0FBQ0FBLG1CQUFPQSxDQUFDLENBQVI7QUFDQUEsbUJBQU9BLENBQUMsQ0FBUjtBQUNBQSxtQkFBT0EsQ0FBQyxDQUFSO0FBQ0FBLG1CQUFPQSxDQUFDLEVBQVI7QUFDQUEsbUJBQU9BLENBQUMsRUFBUjtBQUNBQSxtQkFBT0EsQ0FBQyxFQUFSO0FBQ0FBLG1C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Ozs7Ozs7QUNBQTVDLEVBQUUsWUFBVzs7QUFFVEEsSUFBRSxzQkFBRixFQUEwQm1CLEtBQTFCLENBQWdDLFlBQVc7QUFDdkNxRixTQUFLO0FBQ0hiLGFBQU8sZUFESjtBQUVIYyxZQUFNLDREQUZIO0FBR0hDLFlBQU0sU0FISDtBQUlIQyxlQUFTLElBSk47QUFLSEMsa0JBQVk7QUFMVCxLQUFMLEVBT0NDLElBUEQsQ0FPTSxVQUFDQyxVQUFELEVBQWdCO0FBQ3BCLFVBQUlBLFVBQUosRUFBZ0I7O0FBRVo5RyxVQUFFLHNCQUFGLEVBQTBCaUcsTUFBMUI7QUFFSCxPQUpELE1BSU87O0FBRUwsZUFBTyxLQUFQO0FBRUQ7QUFDRixLQWpCRDtBQWtCSCxHQW5CRDtBQXFCSCxDQXZCRCxFOzs7Ozs7QUNBQSx5QyIsImZpbGUiOiJcXGpzXFxhcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyIgXHQvLyBUaGUgbW9kdWxlIGNhY2hlXG4gXHR2YXIgaW5zdGFsbGVkTW9kdWxlcyA9IHt9O1xuXG4gXHQvLyBUaGUgcmVxdWlyZSBmdW5jdGlvblxuIFx0ZnVuY3Rpb24gX193ZWJwYWNrX3JlcXVpcmVfXyhtb2R1bGVJZCkge1xuXG4gXHRcdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuIFx0XHRpZihpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSkge1xuIFx0XHRcdHJldHVybiBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXS5leHBvcnRzO1xuIFx0XHR9XG4gXHRcdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG4gXHRcdHZhciBtb2R1bGUgPSBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSA9IHtcbiBcdFx0XHRpOiBtb2R1bGVJZCxcbiBcdFx0XHRsOiBmYWxzZSxcbiBcdFx0XHRleHBvcnRzOiB7fVxuIFx0XHR9O1xuXG4gXHRcdC8vIEV4ZWN1dGUgdGhlIG1vZHVsZSBmdW5jdGlvblxuIFx0XHRtb2R1bGVzW21vZHVsZUlkXS5jYWxsKG1vZHVsZS5leHBvcnRzLCBtb2R1bGUsIG1vZHVsZS5leHBvcnRzLCBfX3dlYnBhY2tfcmVxdWlyZV9fKTtcblxuIFx0XHQvLyBGbGFnIHRoZSBtb2R1bGUgYXMgbG9hZGVkXG4gXHRcdG1vZHVsZS5sID0gdHJ1ZTtcblxuIFx0XHQvLyBSZXR1cm4gdGhlIGV4cG9ydHMgb2YgdGhlIG1vZHVsZVxuIFx0XHRyZXR1cm4gbW9kdWxlLmV4cG9ydHM7XG4gXHR9XG5cblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGVzIG9iamVjdCAoX193ZWJwYWNrX21vZHVsZXNfXylcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubSA9IG1vZHVsZXM7XG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlIGNhY2hlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmMgPSBpbnN0YWxsZWRNb2R1bGVzO1xuXG4gXHQvLyBkZWZpbmUgZ2V0dGVyIGZ1bmN0aW9uIGZvciBoYXJtb255IGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uZCA9IGZ1bmN0aW9uKGV4cG9ydHMsIG5hbWUsIGdldHRlcikge1xuIFx0XHRpZighX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIG5hbWUpKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIG5hbWUsIHtcbiBcdFx0XHRcdGNvbmZpZ3VyYWJsZTogZmFsc2UsXG4gXHRcdFx0XHRlbnVtZXJhYmxlOiB0cnVlLFxuIFx0XHRcdFx0Z2V0OiBnZXR0ZXJcbiBcdFx0XHR9KTtcbiBcdFx0fVxuIFx0fTtcblxuIFx0Ly8gZ2V0RGVmYXVsdEV4cG9ydCBmdW5jdGlvbiBmb3IgY29tcGF0aWJpbGl0eSB3aXRoIG5vbi1oYXJtb255IG1vZHVsZXNcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubiA9IGZ1bmN0aW9uKG1vZHVsZSkge1xuIFx0XHR2YXIgZ2V0dGVyID0gbW9kdWxlICYmIG1vZHVsZS5fX2VzTW9kdWxlID9cbiBcdFx0XHRmdW5jdGlvbiBnZXREZWZhdWx0KCkgeyByZXR1cm4gbW9kdWxlWydkZWZhdWx0J107IH0gOlxuIFx0XHRcdGZ1bmN0aW9uIGdldE1vZHVsZUV4cG9ydHMoKSB7IHJldHVybiBtb2R1bGU7IH07XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18uZChnZXR0ZXIsICdhJywgZ2V0dGVyKTtcbiBcdFx0cmV0dXJuIGdldHRlcjtcbiBcdH07XG5cbiBcdC8vIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbFxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5vID0gZnVuY3Rpb24ob2JqZWN0LCBwcm9wZXJ0eSkgeyByZXR1cm4gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsKG9iamVjdCwgcHJvcGVydHkpOyB9O1xuXG4gXHQvLyBfX3dlYnBhY2tfcHVibGljX3BhdGhfX1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5wID0gXCJcIjtcblxuIFx0Ly8gTG9hZCBlbnRyeSBtb2R1bGUgYW5kIHJldHVybiBleHBvcnRzXG4gXHRyZXR1cm4gX193ZWJwYWNrX3JlcXVpcmVfXyhfX3dlYnBhY2tfcmVxdWlyZV9fLnMgPSAwKTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyB3ZWJwYWNrL2Jvb3RzdHJhcCA5NDRjYWE2NmM4YTA5ZTYwYTFlZCIsInJlcXVpcmUoXCIuL2NvbXBvbmVudHMvYWxlcnRcIilcbnJlcXVpcmUoXCIuL2NvbXBvbmVudHMvdXBsb2FkcGhvdG9cIilcbnJlcXVpcmUoXCIuL2NvbXBvbmVudHMvZGlzY3Vzc2lvblwiKVxucmVxdWlyZShcIi4vY29tcG9uZW50cy9qb2JzXCIpXG5yZXF1aXJlKFwiLi9jb21wb25lbnRzL25hdmlnYXRpb25cIilcbnJlcXVpcmUoXCIuL2NvbXBvbmVudHMvc2VhcmNoXCIpXG5yZXF1aXJlKFwiLi9jb21wb25lbnRzL2V4YW1zXCIpXG5yZXF1aXJlKFwiLi9jb21wb25lbnRzL21hcFwiKVxucmVxdWlyZShcIi4vY29tcG9uZW50cy9maWxldXBsb2FkXCIpXG5yZXF1aXJlKFwiLi9jb21wb25lbnRzL3NhbGFyeS1zdXJ2ZXlcIilcbnJlcXVpcmUoXCIuL2NvbXBvbmVudHMvc2Nyb2xsLXRvLXRvcFwiKVxucmVxdWlyZShcIi4vY29tcG9uZW50cy9hY2NvdW50XCIpXG5cbiQoZnVuY3Rpb24oKSB7XG5cdHZhciBteUxhenlMb2FkID0gbmV3IExhenlMb2FkKHtcblx0XHRlbGVtZW50c19zZWxlY3RvcjogXCIubGF6eVwiXG5cdH0pO1xufSk7XG5cbiQoZG9jdW1lbnQpLmV1Q29va2llTGF3UG9wdXAoKS5pbml0KHtcblx0Y29va2llUG9saWN5VXJsIDogXCIvcHJpdmFjeS1jb29raWVzXCIsXG5cdHBvcHVwUG9zaXRpb24gOiAnYm90dG9tJyxcblx0Y29sb3JTdHlsZSA6ICdkZWZhdWx0Jyxcblx0Y29tcGFjdFN0eWxlIDogZmFsc2UsXG5cdHBvcHVwVGl0bGUgOiAnV2UgdXNlIGNvb2tpZXMgdG8gZW5oYW5jZSB5b3VyIGV4cGVyaWVuY2UuIEJ5IGNvbnRpbnVpbmcgdG8gdmlzaXQgdGhpcyBzaXRlIHlvdSBhZ3JlZSB0byBvdXIgdXNlIG9mIGNvb2tpZXMuJyxcblx0cG9wdXBUZXh0IDogJycsXG5cdGJ1dHRvbkNvbnRpbnVlVGl0bGUgOiAnQ29udGludWUnLFxuXHRidXR0b25MZWFybm1vcmVUaXRsZSA6ICdNb3JlIEluZm8nLFxuXHRidXR0b25MZWFybm1vcmVPcGVuSW5OZXdXaW5kb3cgOiBmYWxzZSxcblx0YWdyZWVtZW50RXhwaXJlc0luRGF5cyA6IDMwLFxuXHRhdXRvQWNjZXB0Q29va2llUG9saWN5IDogZmFsc2UsXG5cdGh0bWxNYXJrdXAgOiBudWxsXG59KTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvYXBwLmpzIiwiJChmdW5jdGlvbigpIHtcblxuICAkKFwiLmFsZXJ0X2J1dHRvblwiKS5jbGljayhmdW5jdGlvbigpIHtcbiAgICAkKHRoaXMpLmNsb3Nlc3QoXCIuYWxlcnRcIikuZmFkZU91dCgpO1xuICB9KTtcblxufSk7XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2NvbXBvbmVudHMvYWxlcnQuanMiLCJmdW5jdGlvbiByZWFkVVJMKGlucHV0LGVsZW1lbnQpIHtcblxuICBpZiAoaW5wdXQuZmlsZXMgJiYgaW5wdXQuZmlsZXNbMF0pIHtcbiAgICB2YXIgcmVhZGVyID0gbmV3IEZpbGVSZWFkZXIoKTtcblxuICAgIHJlYWRlci5vbmxvYWQgPSBmdW5jdGlvbihlKSB7XG4gICAgICAkKGVsZW1lbnQpLmF0dHIoJ3NyYycsIGUudGFyZ2V0LnJlc3VsdCk7XG4gICAgfVxuXG4gICAgcmVhZGVyLnJlYWRBc0RhdGFVUkwoaW5wdXQuZmlsZXNbMF0pO1xuICB9XG5cbn1cblxuJChmdW5jdGlvbigpIHtcbiAgJChcIiNhdmF0YXItaW1hZ2VcIikuY2xpY2soZnVuY3Rpb24oKSB7XG4gICAgJChcIiNhdmF0YXJcIikuY2xpY2soKTtcbiAgfSk7XG4gICQoXCIjYXZhdGFyXCIpLmNoYW5nZShmdW5jdGlvbigpIHtcbiAgICByZWFkVVJMKHRoaXMsIFwiI2F2YXRhci1pbWFnZVwiKTtcbiAgfSk7XG5cbn0pO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9jb21wb25lbnRzL3VwbG9hZHBob3RvLmpzIiwiLyoqXG4qIE9wZW4gYWRkIGRpc2N1c3Npb24gcG9wb3Zlci5cbipcbiovXG4kKFwiLmRpc2N1c3Npb24tYWRkLWJ1dHRvblwiKS5jbGljayhmdW5jdGlvbigpIHtcbiAgJChcImh0bWwsIGJvZHlcIikuY3NzKFwib3ZlcmZsb3dcIiwgXCJoaWRkZW5cIik7XG4gICQoXCIuZGlzY3Vzc2lvbi1wb3BvdmVyXCIpLmFkZENsYXNzKFwiZGlzY3Vzc2lvbi1wb3BvdmVyLWFjdGl2ZVwiKTtcbn0pO1xuXG4vKipcbiogQ2xvc2UgcG9wb3Zlci5cbipcbiovXG4kKFwiLmRpc2N1c3Npb24tcG9wb3Zlci1jbG9zZVwiKS5jbGljayhmdW5jdGlvbigpIHtcbiAgJChcImh0bWwsIGJvZHlcIikuY3NzKFwib3ZlcmZsb3dcIiwgXCJzY3JvbGxcIik7XG4gICQodGhpcykuY2xvc2VzdChcIi5kaXNjdXNzaW9uLXBvcG92ZXJcIikucmVtb3ZlQ2xhc3MoXCJkaXNjdXNzaW9uLXBvcG92ZXItYWN0aXZlXCIpO1xufSk7XG5cblxuLyoqXG4qIERpc2N1c3Npb24gcmVwbHkgZm9ybSBzdWJtaXNzaW9uLlxuKlxuKi9cbi8qXG4kKFwiI2Rpc2N1c3Npb24tcmVwbHktZm9ybVwiKS5zdWJtaXQoZnVuY3Rpb24oZSkge1xuXG4gIGUucHJldmVudERlZmF1bHQ7XG5cbiAgJC5hamF4KHtcbiAgICB0eXBlOiBcIlBPU1RcIixcbiAgICB1cmw6ICQodGhpcykuYXR0cignYWN0aW9uJyksXG4gICAgZGF0YTogbmV3IEZvcm1EYXRhKCB0aGlzICksXG4gICAgcHJvY2Vzc0RhdGE6IGZhbHNlLFxuICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcbiAgICBzdWNjZXNzOiBmdW5jdGlvbihyZXNwb25zZSl7XG5cbiAgICAgICQoXCIjbmV3RGlzY3Vzc2lvblJlcGx5XCIpLmFwcGVuZChyZXNwb25zZSk7XG4gICAgICAkKFwiLmRpc2N1c3Npb24tdmlldy1yZXBseS1lZGl0b3JcIikudHJ1bWJvd3lnKFwiZW1wdHlcIik7XG5cbiAgICB9LFxuICAgIGVycm9yOiBmdW5jdGlvbihyZXNwb25zZSkge1xuXG4gICAgICBhbGVydChcIlBsZWFzZSBlbnRlciBzb21lIGNvbnRlbnQuLi5cIik7XG5cbiAgICB9XG4gIH0pO1xuXG4gIHJldHVybiBmYWxzZTtcblxufSk7XG4qL1xuXG4kKCcuZGlzY3Vzc2lvbi12aWV3LXJlcGx5LWVkaXRvciwgLmRpc2N1c3Npb24tZWRpdC1jb250ZW50LWVkaXRvcicpLnRydW1ib3d5Zyh7XG4gIHN2Z1BhdGg6ICcvaW1hZ2VzL2ljb25zLnN2ZycsXG4gIGJ0bnM6IFtcbiAgICAnc3Ryb25nJywgJ2xpbmsnLCAndW5vcmRlcmVkTGlzdCcsICdvcmRlcmVkTGlzdCcsICd1bmRvJywgJ3JlZG8nLCAndXBsb2FkJyxcbiAgXVxufSk7XG5cbi8qKlxuICogVXNlciBjbGlja3MgdGhlIHJlcGx5IGJ1dHRvblxuICpcbiAqL1xuJChcIi5kaXNjdXNzaW9uLWJ1dHRvbi0tcmVwbHlcIikuY2xpY2soZnVuY3Rpb24oKSB7XG4gICAgJCgnaHRtbCwgYm9keScpLmFuaW1hdGUoe1xuICAgICAgICBzY3JvbGxUb3A6ICQoXCIuZGlzY3Vzc2lvbi12aWV3LXJlcGx5XCIpLm9mZnNldCgpLnRvcCAtIDE1XG4gICAgfSwgMTAwMCk7XG59KTtcblxuXG4kKFwiLmRpc2N1c3Npb24tc2lkZWJhcl9fbW9iaWxlLW1lbnVcIikuY2xpY2soZnVuY3Rpb24oKSB7XG5cbiAgICBpZiAoJChcIi5kaXNjdXNzaW9uLXNpZGViYXJfX2NhdGVnb3JpZXNcIikuaGFzQ2xhc3MoXCJhY3RpdmVcIikpIHtcblxuICAgICAgICBoaWRlQ2F0ZWdvcmllcygpO1xuXG4gICAgfVxuXG4gICAgZWxzZSB7XG5cbiAgICAgICAgc2hvd0NhdGVnb3JpZXMoKTtcblxuICAgIH1cblxufSk7XG5cbmZ1bmN0aW9uIHNob3dDYXRlZ29yaWVzKClcbntcblxuICAgICQoXCIuZGlzY3Vzc2lvbi1zaWRlYmFyX19jYXRlZ29yaWVzXCIpLmFkZENsYXNzKFwiYWN0aXZlXCIpO1xuICAgICQoXCIuZGlzY3Vzc2lvbi1zaWRlYmFyX19jYXRlZ29yaWVzXCIpLnNsaWRlRG93bigpO1xuXG4gICAgJChcIi5kaXNjdXNzaW9uLXNpZGViYXJfX21vYmlsZS1tZW51IHNwYW5cIikuaHRtbChcIkhpZGUgQ2F0ZWdvcmllc1wiKTtcblxuICAgICQoXCJodG1sLCBib2R5XCIpLmFuaW1hdGUoe1xuICAgICAgICBzY3JvbGxUb3A6ICQoJy5kaXNjdXNzaW9uLXNpZGViYXJfX21vYmlsZS1tZW51Jykub2Zmc2V0KCkudG9wIC0gMTVcbiAgICB9LCAxMDAwKTtcblxufVxuXG5mdW5jdGlvbiBoaWRlQ2F0ZWdvcmllcygpXG57XG5cbiAgICAkKFwiLmRpc2N1c3Npb24tc2lkZWJhcl9fY2F0ZWdvcmllc1wiKS5yZW1vdmVDbGFzcyhcImFjdGl2ZVwiKTtcbiAgICAkKFwiLmRpc2N1c3Npb24tc2lkZWJhcl9fY2F0ZWdvcmllc1wiKS5zbGlkZVVwKCk7XG5cbiAgICAkKFwiLmRpc2N1c3Npb24tc2lkZWJhcl9fbW9iaWxlLW1lbnUgc3BhblwiKS5odG1sKFwiU2hvdyBDYXRlZ29yaWVzXCIpO1xuXG59XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2NvbXBvbmVudHMvZGlzY3Vzc2lvbi5qcyIsIiQoXCIuYWR2ZXJ0aXNpbmctdG9nZ2xlXCIpLmNsaWNrKGZ1bmN0aW9uKCkge1xuXG4gIGNvbnNvbGUubG9nKCAkKHRoaXMpLmF0dHIoXCJkYXRhLWlkXCIpICk7XG5cbiAgLyoqXG4gICogSGlkZSBhbnkgY3VycmVudCBzaG93aW5nIHRvZ2dsZSBpdGVtcy5cbiAgKlxuICAqL1xuICAkKFwiLmFkdmVydGlzaW5nLXRvZ2dsZS1pdGVtXCIpLnNsaWRlVXAoKTtcblxuICAvKipcbiAgKiBTaG93IHRoZSBjb3JyZWN0IG9uZS5cbiAgKlxuICAqL1xuICAkKFwiI1wiKyQodGhpcykuYXR0cihcImRhdGEtaWRcIikpLnNsaWRlRG93bigpO1xuXG4gICQoJ2h0bWwsIGJvZHknKS5hbmltYXRlKHtcbiAgICBzY3JvbGxUb3A6ICQoXCIjXCIrJCh0aGlzKS5hdHRyKFwiZGF0YS1pZFwiKSkub2Zmc2V0KCkudG9wIC0gNTBcbiAgfSwgMTAwMCk7XG5cbn0pO1xuXG5cblxuXG5cbiQoXCIuam9iLWxpc3QtZmlsdGVyLXRvZ2dsZVwiKS5jbGljayhmdW5jdGlvbigpIHtcblxuICAgIGlmICgkKFwiLmpvYi1saXN0LXNpZGViYXJcIikuaGFzQ2xhc3MoXCJhY3RpdmVcIikpIHtcblxuICAgICAgICBoaWRlQ2F0ZWdvcmllcygpO1xuXG4gICAgfVxuXG4gICAgZWxzZSB7XG5cbiAgICAgICAgc2hvd0NhdGVnb3JpZXMoKTtcblxuICAgIH1cblxufSk7XG5cbmZ1bmN0aW9uIHNob3dDYXRlZ29yaWVzKClcbntcblxuICAgICQoXCIuam9iLWxpc3Qtc2lkZWJhclwiKS5hZGRDbGFzcyhcImFjdGl2ZVwiKTtcbiAgICAkKFwiLmpvYi1saXN0LXNpZGViYXJcIikuc2xpZGVEb3duKCk7XG4gICAgJChcIi5qb2ItbGlzdC1iYW5uZXJcIikuc2xpZGVEb3duKCk7XG5cbiAgICAkKFwiLmpvYi1saXN0LWZpbHRlci10b2dnbGVcIikuaHRtbChcIkhpZGUgRmlsdGVyaW5nXCIpO1xuXG4gICAgJChcImh0bWwsIGJvZHlcIikuYW5pbWF0ZSh7XG4gICAgICAgIHNjcm9sbFRvcDogJCgnLmpvYi1saXN0LWJhbm5lcicpLm9mZnNldCgpLnRvcCAtIDE1XG4gICAgfSwgMTAwMCk7XG5cbn1cblxuZnVuY3Rpb24gaGlkZUNhdGVnb3JpZXMoKVxue1xuXG4gICAgJChcIi5qb2ItbGlzdC1zaWRlYmFyXCIpLnJlbW92ZUNsYXNzKFwiYWN0aXZlXCIpO1xuICAgICQoXCIuam9iLWxpc3Qtc2lkZWJhclwiKS5zbGlkZVVwKCk7XG4gICAgJChcIi5qb2ItbGlzdC1iYW5uZXJcIikuc2xpZGVVcCgpO1xuXG4gICAgJChcIi5qb2ItbGlzdC1maWx0ZXItdG9nZ2xlXCIpLmh0bWwoXCJTaG93IEZpbHRlcmluZ1wiKTtcblxufVxuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9jb21wb25lbnRzL2pvYnMuanMiLCIkKFwiLmhlYWRlci1idXJnZXJcIikuY2xpY2soZnVuY3Rpb24oKSB7XG4gIHNob3dOYXYoKTtcbn0pO1xuXG4kKFwiLm5hdmlnYXRpb24tb3ZlcmxheVwiKS5jbGljayhmdW5jdGlvbigpIHtcbiAgaGlkZU5hdigpO1xufSk7XG5cblxuZnVuY3Rpb24gaGlkZU5hdigpIHtcbiAgJChcImh0bWwsIGJvZHlcIikucmVtb3ZlQ2xhc3MoXCJuYXZpZ2F0aW9uLWFjdGl2ZVwiKTtcbiAgJChcIi5uYXZpZ2F0aW9uLW92ZXJsYXlcIikuZmFkZU91dCgpO1xuICAkKFwibmF2XCIpLmFuaW1hdGUoe1xuICAgIHdpZHRoOiBcIjBcIlxuICB9KTtcbn1cblxuZnVuY3Rpb24gc2hvd05hdigpIHtcbiAgJChcImh0bWwsIGJvZHlcIikuYWRkQ2xhc3MoXCJuYXZpZ2F0aW9uLWFjdGl2ZVwiKTtcbiAgJChcIi5uYXZpZ2F0aW9uLW92ZXJsYXlcIikuZmFkZUluKCk7XG4gICQoXCJuYXZcIikuc2hvdygpO1xuICAkKFwibmF2XCIpLmFuaW1hdGUoe1xuICAgIHdpZHRoOiBcIjg1JVwiXG4gIH0pO1xufVxuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9jb21wb25lbnRzL25hdmlnYXRpb24uanMiLCIkKFwiLmhlYWRlci1zZWFyY2gsIC5oZWFkZXItc2VhcmNoLWljb25cIikuY2xpY2soZnVuY3Rpb24oKSB7XG5cbiAgICBpZiAoICQoXCIuc2VhcmNoXCIpLmhhc0NsYXNzKFwic2VhcmNoLW9wZW5cIikgKSB7XG4gICAgICAgIGNsb3NlU2VhcmNoKCk7XG4gICAgfSBlbHNlIHtcbiAgICAgICAgc2hvd1NlYXJjaCgpO1xuICAgIH1cblxufSk7XG5cbiQoXCIuc2VhcmNoX19jbG9zZVwiKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgY2xvc2VTZWFyY2goKTtcbn0pO1xuXG5cbmZ1bmN0aW9uIHNob3dTZWFyY2goKSB7XG4gICAgJChcIi5zZWFyY2hcIikuZmFkZUluKCk7XG4gICAgJChcIi5zZWFyY2hfX2lucHV0XCIpLmZvY3VzKCk7XG59XG5cbmZ1bmN0aW9uIGNsb3NlU2VhcmNoKCkge1xuICAgICQoXCIuc2VhcmNoXCIpLmZhZGVPdXQoKTtcbn1cblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvY29tcG9uZW50cy9zZWFyY2guanMiLCIkKFwiLmV4YW0tbW9kdWxlcy1zbGlkZXItaXRlbVwiKS5jbGljayhmdW5jdGlvbigpIHtcblxuICAvKipcbiAgKiBHZXQgbW9kdWxlIGlkLlxuICAqXG4gICovXG4gIHZhciBtb2R1bGVfaWQgPSAkKHRoaXMpLmF0dHIoXCJkYXRhLW1vZHVsZS1pZFwiKTtcblxuICAvKipcbiAgKiBSZW1vdmUgYW55IGFjdGl2ZSBjbGFzc2VzLlxuICAqIEhpZGUgYWxsIG9mIHRoZSBjb250YWluZXJzXG4gICpcbiAgKi9cbiAgJChcIi5leGFtLW1vZHVsZXMtc2xpZGVyLWl0ZW1cIikucmVtb3ZlQ2xhc3MoXCJleGFtLW1vZHVsZXMtc2xpZGVyLWl0ZW0tYWN0aXZlXCIpO1xuICAkKFwiLmV4YW0tbW9kdWxlcy1pbmZvLWNvbnRhaW5lclwiKS5oaWRlKCk7XG5cbiAgLyoqXG4gICogQWN0aXZhdGUgdGhpcyBpdGVtLlxuICAqXG4gICovXG4gICQodGhpcykuYWRkQ2xhc3MoXCJleGFtLW1vZHVsZXMtc2xpZGVyLWl0ZW0tYWN0aXZlXCIpO1xuICAkKFwiI2V4YW0tbW9kdWxlcy1pbmZvLWNvbnRhaW5lci1cIittb2R1bGVfaWQpLnNob3coKTtcblxufSk7XG5cblxuJChcIi5zdXJ2ZXktYW5zd2VyLWRyb3Bkb3duLWl0ZW1cIikuY2xpY2soZnVuY3Rpb24oKSB7XG5cbiAgLyoqXG4gICogR2V0IHZhcnMuXG4gICpcbiAgKi9cbiAgdmFyIG1vZHVsZV9pZCA9ICQodGhpcykuYXR0cihcImRhdGEtbW9kdWxlLWlkXCIpO1xuICB2YXIgbW9kdWxlX25hbWUgPSAkKHRoaXMpLmF0dHIoXCJkYXRhLW1vZHVsZS1uYW1lXCIpO1xuICB2YXIgY2F0ZWdvcnlfaWQgPSAkKHRoaXMpLmF0dHIoXCJkYXRhLWNhdGVnb3J5LWlkXCIpO1xuXG4gICQoXCIuc3VydmV5LWFuc3dlci1jYXRcIikucmVtb3ZlQ2xhc3MoXCJzdXJ2ZXktYW5zd2VyLWFjdGl2ZVwiKTtcblxuICAvLyAkKFwiLnN1cnZleS1hbnN3ZXItY2F0XCIpLmhpZGUoKTtcbiAgLy8gJChcIi5zdXJ2ZXktYW5zd2VyLWRyb3Bkb3duXCIpLmhpZGUoKTtcbiAgLy8gJChcIiNzdXJ2ZXktYW5zd2VyLWNhdC1cIitjYXRlZ29yeV9pZCkuc2hvdygpO1xuICAkKFwiI3N1cnZleS1hbnN3ZXItY2F0ZWdvcnktXCIrY2F0ZWdvcnlfaWQpLmh0bWwobW9kdWxlX25hbWUpO1xuICAkKFwiI3N1cnZleS1hbnN3ZXItY2F0ZWdvcnktXCIrY2F0ZWdvcnlfaWQpLnBhcmVudCgpLnBhcmVudCgpLmFkZENsYXNzKFwic3VydmV5LWFuc3dlci1hY3RpdmVcIik7XG5cbiAgJChcIiNtb2R1bGVfaWRcIikudmFsKG1vZHVsZV9pZCk7XG5cbn0pO1xuXG4kKFwiLnN1cnZleS1hbnN3ZXItZGlmZmljdWx0eVwiKS5jbGljayhmdW5jdGlvbigpIHtcblxuICB2YXIgZGlmZmljdWx0eSA9ICQodGhpcykuYXR0cihcImRhdGEtZGlmZmljdWx0eVwiKTtcblxuICAkKFwiLnN1cnZleS1hbnN3ZXItZGlmZmljdWx0eVwiKS5yZW1vdmVDbGFzcyhcInN1cnZleS1hbnN3ZXItYWN0aXZlXCIpO1xuXG4gICQodGhpcykuYWRkQ2xhc3MoXCJzdXJ2ZXktYW5zd2VyLWFjdGl2ZVwiKTtcblxuICAkKFwiI2RpZmZpY3VsdHlcIikudmFsKGRpZmZpY3VsdHkpO1xuXG59KTtcblxuXG4kKFwiLnN1cnZleS1idXR0b24tYWRkXCIpLmNsaWNrKGZ1bmN0aW9uKGUpIHtcblxuICBlLnByZXZlbnREZWZhdWx0O1xuXG4gIHZhciBtb2R1bGVfaWQgPSAkKFwiI21vZHVsZV9pZFwiKS52YWwoKTtcbiAgdmFyIGRpZmZpY3VsdHkgPSAkKFwiI2RpZmZpY3VsdHlcIikudmFsKCk7XG5cbiAgJC5hamF4KHtcbiAgICB0eXBlOiBcIlBPU1RcIixcbiAgICB1cmw6ICQoXCIjc3VydmV5LWZvcm1cIikuYXR0cignYWN0aW9uJyksXG4gICAgZGF0YToge1xuICAgICAgbW9kdWxlX2lkOm1vZHVsZV9pZCxcbiAgICAgIGRpZmZpY3VsdHk6ZGlmZmljdWx0eVxuICAgIH0sXG4gICAgaGVhZGVyczoge1xuICAgICAgJ1gtQ1NSRi1UT0tFTic6ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JylcbiAgICB9LFxuICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKHJlc3BvbnNlKXtcblxuICAgICAgaWYgKHJlc3BvbnNlID09IFwiT0tcIikge1xuICAgICAgICAvLyBsb2NhdGlvbi5ocmVmID0gJy9leGFtcy9zdXJ2ZXkvcmVzdWx0cyc7XG5cbiAgICAgICAgJChcIiNzdXJ2ZXktYmVmb3JlXCIpLmhpZGUoKTtcbiAgICAgICAgJChcIiNzYWxhcnktc3VydmV5LWZvb3Rlci1hZnRlci1zdWJtaXNzaW9uXCIpLnNob3coKTtcblxuICAgICAgfVxuXG4gICAgfSxcbiAgICBlcnJvcjogZnVuY3Rpb24ocmVzcG9uc2UpIHtcbiAgICAgIGNvbnNvbGUubG9nKFwiRVJST1JcIik7XG4gICAgICBjb25zb2xlLmxvZyhyZXNwb25zZSk7XG4gICAgfVxuICB9KTtcblxuICByZXR1cm4gZmFsc2U7XG5cblxufSk7XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2NvbXBvbmVudHMvZXhhbXMuanMiLCIvLyBBSXphU3lCSFZGVE1fTFM4WUxSeDhmb2c2MVJ6RFQwNTRHNEM4allcblxuZnVuY3Rpb24gaW5pdE1hcCgpIHtcbiAgdmFyIG15TGF0TG5nID0ge2xhdDogLTI1LjM2MywgbG5nOiAxMzEuMDQ0fTtcblxuICAvLyBDcmVhdGUgYSBtYXAgb2JqZWN0IGFuZCBzcGVjaWZ5IHRoZSBET00gZWxlbWVudCBmb3IgZGlzcGxheS5cbiAgdmFyIG1hcCA9IG5ldyBnb29nbGUubWFwcy5NYXAoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ21hcCcpLCB7XG4gICAgY2VudGVyOiBteUxhdExuZyxcbiAgICB6b29tOiA0XG4gIH0pO1xuXG4gIC8vIENyZWF0ZSBhIG1hcmtlciBhbmQgc2V0IGl0cyBwb3NpdGlvbi5cbiAgdmFyIG1hcmtlciA9IG5ldyBnb29nbGUubWFwcy5NYXJrZXIoe1xuICAgIG1hcDogbWFwLFxuICAgIHBvc2l0aW9uOiBteUxhdExuZyxcbiAgICB0aXRsZTogJ0hlbGxvIFdvcmxkISdcbiAgfSk7XG59XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2NvbXBvbmVudHMvbWFwLmpzIiwiZnVuY3Rpb24gcmVhZE5hbWUoaW5wdXQsZWxlbWVudCkge1xuXG4gIGlmIChpbnB1dC5maWxlcyAmJiBpbnB1dC5maWxlc1swXSkge1xuXG4gICAgdmFyIGZpbGVfbmFtZSA9IGlucHV0LmZpbGVzWzBdLm5hbWU7XG5cbiAgICAkKGVsZW1lbnQgKyBcIiBzcGFuXCIpLmh0bWwoZmlsZV9uYW1lKTtcblxuICB9XG5cbn1cblxuJChmdW5jdGlvbigpIHtcbiAgJChcIi5maWxlLXVwbG9hZFwiKS5jbGljayhmdW5jdGlvbigpIHtcblxuICAgIHZhciBmaWxlX2lucHV0ID0gJCh0aGlzKS5hdHRyKFwiZGF0YS1pZFwiKTtcblxuICAgICQoXCIjXCIrZmlsZV9pbnB1dCkuY2xpY2soKTtcblxuICB9KTtcbiAgJChcIi5maWxlLXVwbG9hZC1pbnB1dFwiKS5jaGFuZ2UoZnVuY3Rpb24oKSB7XG5cbiAgICB2YXIgZmlsZV91cGxvYWRfY29udGFpbmVyID0gJCh0aGlzKS5hdHRyKFwiZGF0YS1pZFwiKTtcblxuICAgIHJlYWROYW1lKHRoaXMsIFwiI1wiK2ZpbGVfdXBsb2FkX2NvbnRhaW5lcik7XG5cbiAgfSk7XG5cbn0pO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9jb21wb25lbnRzL2ZpbGV1cGxvYWQuanMiLCIkKFwiI3NhbGFyeS1zdXJ2ZXktZm9ybVwiKS5zdWJtaXQoZnVuY3Rpb24oZSkge1xuXG4gIGUucHJldmVudERlZmF1bHQ7XG5cbiAgJC5hamF4KHtcbiAgICB0eXBlOiBcIlBPU1RcIixcbiAgICB1cmw6ICQodGhpcykuYXR0cignYWN0aW9uJyksXG4gICAgZGF0YTogbmV3IEZvcm1EYXRhKCB0aGlzICksXG4gICAgcHJvY2Vzc0RhdGE6IGZhbHNlLFxuICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcbiAgICBzdWNjZXNzOiBmdW5jdGlvbihyZXNwb25zZSl7XG5cbiAgICAgIGNvbnNvbGUubG9nKFwiU1VDQ0VTU1wiKTtcbiAgICAgIGNvbnNvbGUubG9nKHJlc3BvbnNlKTtcblxuICAgICAgaWYgKHJlc3BvbnNlID09IFwiT0tcIikge1xuICAgICAgICAkKFwiI3NhbGFyeS1zdXJ2ZXktZm9vdGVyLWJlZm9yZS1zdWJtaXNzaW9uXCIpLmhpZGUoKTtcbiAgICAgICAgJChcIiNzYWxhcnktc3VydmV5LWZvb3Rlci1hZnRlci1zdWJtaXNzaW9uXCIpLnNob3coKTtcbiAgICAgIH1cblxuICAgIH0sXG4gICAgZXJyb3I6IGZ1bmN0aW9uKHJlc3BvbnNlKSB7XG5cbiAgICAgIGNvbnNvbGUubG9nKFwiRVJST1JcIik7XG4gICAgICBjb25zb2xlLmxvZyhyZXNwb25zZSk7XG5cbiAgICAgIGFsZXJ0KFwiUGxlYXNlIGVudGVyIHNvbWUgY29udGVudC4uLlwiKTtcblxuICAgIH1cbiAgfSk7XG5cbiAgcmV0dXJuIGZhbHNlO1xuXG59KTtcblxuJChcIi5zYWxhcnktc3VydmV5LXF1ZXN0aW9uLWFuc3dlci1jbGlja2FibGVcIikuY2xpY2soZnVuY3Rpb24oKSB7XG5cbiAgLyoqXG4gICogRGVmaW5lIHZhcmlhYmxlcy5cbiAgKlxuICAqL1xuICB2YXIga2V5ID0gJCh0aGlzKS5hdHRyKFwiZGF0YS1rZXlcIik7XG4gIHZhciB2YWx1ZSA9ICQodGhpcykuYXR0cihcImRhdGEtdmFsdWVcIik7XG5cbiAgaWYgKGtleSA9PSBcInR5cGVcIikge1xuICAgICAgJChcIi5zYWxhcnktc3VydmV5LXF1ZXN0aW9uLWFuc3dlci1pbnB1dFwiKS5oaWRlKCk7XG5cbiAgICAgICQoXCIjaW5wdXQtXCIrdmFsdWUpLnNob3coKTtcblxuICB9XG5cbiAgLyoqXG4gICogVXBkYXRlIGhpZGRlbiBmaWVsZCB3aXRoIHZhbHVlLlxuICAqXG4gICovXG4gICQoXCIjXCIra2V5KS52YWwodmFsdWUpO1xuXG4gIC8qKlxuICAqIFJlbW92ZSBhY3RpdmUgZnJvbSBvdGhlciBhbnN3ZXJzIG9uIHRoaXMgcXVlc3Rpb24uXG4gICpcbiAgKi9cbiAgJChcIi5zYWxhcnktc3VydmV5LXF1ZXN0aW9uLWFuc3dlci1jbGlja2FibGUtXCIra2V5KS5yZW1vdmVDbGFzcyhcInNhbGFyeS1zdXJ2ZXktcXVlc3Rpb24tYW5zd2VyLWNsaWNrYWJsZS1hY3RpdmVcIik7XG5cbiAgLyoqXG4gICogQWN0aXZhdGUgY2xpY2tlZCBhbnN3ZXIuXG4gICpcbiAgKi9cbiAgJCh0aGlzKS5hZGRDbGFzcyhcInNhbGFyeS1zdXJ2ZXktcXVlc3Rpb24tYW5zd2VyLWNsaWNrYWJsZS1hY3RpdmVcIik7XG5cbn0pO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9jb21wb25lbnRzL3NhbGFyeS1zdXJ2ZXkuanMiLCIkKFwiLnNpdGUtc2Nyb2xsLXRvLXRvcFwiKS5jbGljayhmdW5jdGlvbigpIHtcblxuICAgICQoJ2h0bWwsIGJvZHknKS5hbmltYXRlKHtcbiAgICAgICAgc2Nyb2xsVG9wOiAkKFwiaHRtbFwiKS5vZmZzZXQoKS50b3BcbiAgICB9LCAxMDAwKTtcblxufSk7XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2NvbXBvbmVudHMvc2Nyb2xsLXRvLXRvcC5qcyIsIiQoZnVuY3Rpb24oKSB7XG5cbiAgICAkKFwiLmFjY291bnRfcGFnZV9kZWxldGVcIikuY2xpY2soZnVuY3Rpb24oKSB7XG4gICAgICAgIHN3YWwoe1xuICAgICAgICAgIHRpdGxlOiBcIkFyZSB5b3Ugc3VyZT9cIixcbiAgICAgICAgICB0ZXh0OiBcIk9uY2UgZGVsZXRlZCB5b3UgY2Fubm90IHJldHJpZXZlIHRoaXMgYWdhaW4gaW4gdGhlIGZ1dHVyZSFcIixcbiAgICAgICAgICBpY29uOiBcIndhcm5pbmdcIixcbiAgICAgICAgICBidXR0b25zOiB0cnVlLFxuICAgICAgICAgIGRhbmdlck1vZGU6IHRydWUsXG4gICAgICAgIH0pXG4gICAgICAgIC50aGVuKCh3aWxsRGVsZXRlKSA9PiB7XG4gICAgICAgICAgaWYgKHdpbGxEZWxldGUpIHtcblxuICAgICAgICAgICAgICAkKFwiI2RlbGV0ZV9hY2NvdW50X2Zvcm1cIikuc3VibWl0KCk7XG5cbiAgICAgICAgICB9IGVsc2Uge1xuXG4gICAgICAgICAgICByZXR1cm4gZmFsc2U7XG5cbiAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH0pO1xuXG59KTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvanMvY29tcG9uZW50cy9hY2NvdW50LmpzIiwiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW5cblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyAuL3Jlc291cmNlcy9hc3NldHMvc2Fzcy9hcHAuc2Nzc1xuLy8gbW9kdWxlIGlkID0gMTRcbi8vIG1vZHVsZSBjaHVua3MgPSAwIl0sInNvdXJjZVJvb3QiOiIifQ==