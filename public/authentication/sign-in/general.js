"use strict";
// Class definition
var KTSigninGeneral = function () {
    // Elements
    var form;
    var submitButton;
    var validator;
    
    // Handle form
    var handleValidation = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'email': {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: 'The value is not a valid email address',
                            },
                            notEmpty: {
                                message: 'Email address is required'
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                        
                    },
                    'SecurityCodea': {
                        validators: {
                            notEmpty: {
                                message: 'The Captcha Code is required'
                            }
                        }
                        
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
                }
            }
        );
    }

    var handleSubmitDemo = function (e) {
        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Validate form
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;


                    // Simulate ajax request
                    setTimeout(function () {
                        // Hide loading indication
                        submitButton.removeAttribute('data-kt-indicator');

                        // Enable button
                        submitButton.disabled = false;

                        // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "You have successfully logged in!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                form.querySelector('[name="email"]').value = "";
                                form.querySelector('[name="password"]').value = "";

                                //form.submit(); // submit form
                                var redirectUrl = form.getAttribute('data-kt-redirect-url');
                                if (redirectUrl) {
                                    location.href = redirectUrl;
                                }
                            }
                        });
                    }, 1000);
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });
    }
    function reverseString(str) {
        var splitString = str.split("");
        var reverseArray = splitString.reverse();
        var joinArray = reverseArray.join("");
        return joinArray;
        
        }
    function hashPassword(str) {
        for(var i=0; i<5;i++)
            {
                var hashHex=reverseString(btoa(str));
            }
        return hashHex;
      }
    
    var handleSubmitAjax = function (e) {
        // Handle form submit
        //submitButton.addEventListener('click', function (e) {
        $('.submit-login-btn').click( function(e) {
            // Prevent button default action
            e.preventDefault();
            // Validate form
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    // Disable button to avoid multiple click
                    submitButton.disabled = true;
                    var pas = hashPassword($('.password').val());
                    // Check axios library docs: https://axios-http.com/docs/intro
                    //axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form)).then(function (response) {
                    axios.post(submitButton.closest('form').getAttribute('action'), {
                        email: $('.email').val(),
                        password: pas,
                        captcha: $('.SecurityCode').val()
                     }).then(function (response) {
                        if (response.status == 200) {
                            form.reset();
                            toastr.success(
                                "You have successfully logged in!", 
                                "Successfully logged in!", 
                                {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                             );
                             setTimeout(function() {
                                if (history.scrollRestoration) {
                                   history.scrollRestoration = 'manual';
                                }
                                location.href = response.data.redirectUrl; // reload page
                             }, 1500);
                           
                        } else {
                            toastr.error(
                                "Sorry, the email or password is incorrect, please try again K.", 
                                "email or password is incorrect", 
                                {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                             );
                        }
                    }).catch(function (error) {
                        toastr.error(
                            'Sorry, '+error.response.data.message, 
                            "error", 
                            {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                         );
                    }).then(() => {
                        // Hide loading indication
                        submitButton.removeAttribute('data-kt-indicator');
                        // Enable button
                        submitButton.disabled = false;
                    });
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    toastr.error(
                        "Sorry, looks like there are some errors detected, please try again.", 
                        "error", 
                        {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                     );
                }
            });
        });
    }
    var isValidUrl = function(url) {
        try {
            new URL(url);
            return true;
        } catch (e) {
            return false;
        }
    }
    // Public functions
    return {
        // Initialization
        init: function () {
            form = document.querySelector('#kt_sign_in_form');
            submitButton = document.querySelector('#kt_sign_in_submit');
            handleValidation();
            if (isValidUrl(submitButton.closest('form').getAttribute('action'))) {
                handleSubmitAjax(); // use for ajax submit
            } else {
                handleSubmitDemo(); // used for demo purposes only
            }
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
// $('#reload').click(function () {
//     $.ajax({
//         type: 'GET',
//         url: 'reload-captcha',
//         success: function (data) {
//             $(".captcha").html(data.captcha);
//         }
//     });
// });