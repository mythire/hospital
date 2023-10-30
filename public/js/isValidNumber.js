var input = document.querySelector("#phone"); 
var errorMsg = document.querySelector("#phone_value_alert");
var validMsg = document.querySelector("#phone_value_valid");



// initialise plugin
var iti = window.intlTelInput(input, {
  initialCountry: "auto",
  separateDialCode: true,
  geoIpLookup: function(callback) {
    $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
      var countryCode = (resp && resp.country) ? resp.country : "us";
      callback(countryCode);
    });
  },
  utilsScript: "/js/utils.js",
  excludeCountries: ['cu','ir','ly','kp','ni','so','sd','sy','ve','ye','by','mm','ci','cg','iq','lr','sl','zw']
});


// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Number you provided is too long", "Invalid number"];



var reset = function() {
  // input.classList.remove("error");
  
  // errorMsg.innerHTML = "";
  // $('#phone_value_alert').hide()
  // validMsg.classList.add("hide");
};

// on blur: validate
input.addEventListener('blur', function() {
  reset();
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
      // validMsg.classList.remove("hide");
      // input.classList.add("is-valid");
    } else {
      // input.classList.add("error");
      // var errorCode = iti.getValidationError();
      // errorMsg.innerHTML = errorMap[errorCode];
      // // $('#phone_value_alert').show().html( errorMap[errorCode]);
      // errorMsg.classList.remove("hide");
    }
  }
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);
