var KTvalidationModule= function() {
    var _officeAdd;
    var jsonURL = $('#urlListData').attr('data-info');
    var crudUrlTemplate = JSON.parse(jsonURL);
    var _handleOfficeAddForm = function(e) {
        var validation;
        var form = document.getElementById('kt_settings_module_form');
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            form,
            {
                fields: {
                    menuName_en: {
                        validators: {
                            notEmpty: {
                                message: 'This field is required'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9-' ]*$/,
                                message: 'This field can consist of alphabetical characters, spaces, digits only'
                            },
                        },
                    },
                    url: {
                        validators: {
                            notEmpty: {
                                message: 'This field is required'
                            },
                        },
                    },
                 shortorder: {
                        validators: {
                            notEmpty: {
                                message: 'This field is required'
                            },
                        },
                    },
                prefix: {
                        validators: {
                            notEmpty: {
                                message: 'This field is required'
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5()
                }
            }
        );
        $('.submit-add-module-btn').click( function(e) {
            e.preventDefault();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    //$('#examAddModal').modal('hide');
                    $('#loading').addClass('loading');
                    $('#loading-content').addClass('loading-content');
                 axios.post(crudUrlTemplate.create, {
                       name_en: $('.menuName_en').val(),
                       name_hi: $('.menuName_hi').val(),
                       sort_order: $('.shortorder').val(),
                       prefix: $('.prefix').val(),
                       url: $('.url').val(),
                    })
                    .then(function (response) {
                       
                    if (response.data.status == 200) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                       toastr.success(
                          response.data.message, 
                          "New Module!", 
                          {timeOut: 0, extendedTimeOut: 0, closeButton: true,progressBar:true, closeDuration: 0}
                       );
                       setTimeout(function() {
                          if (history.scrollRestoration) {
                             history.scrollRestoration = 'manual';
                          }
                          location.href = 'module-create'; // reload page
                       }, 1500);
                      
                    } else {
                       toastr.error(
                          response.data.message.name_en, 
                          response.data.message, 
                          "Something went wrong!", 
                          {timeOut: 0, extendedTimeOut: 0, closeButton: true,progressBar:true, closeDuration: 0}
                       );
                       }
                    })
                    .catch(function (error) {
                          toastr.error(
                             "Sorry, looks like there are some errors detected, please try again B.", 
                             "Something went wrong!", 
                             {timeOut: 0, extendedTimeOut: 0, closeButton: true,progressBar:true, closeDuration: 0}
                          );
                       }).then(() => {
                             // Hide loading indication
                             submitButton.removeAttribute('data-kt-indicator');
                             // Enable button
                             submitButton.disabled = false;
                       });
                    } else {
                          toastr.error(
                                "Sorry, looks like there are some errors detected, please try again K.", 
                                "Something went wrong!", 
                                {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                             );
                       }
                 })
              });
        }
    return {
        init: function() {
            _officeAdd = $('#kt_settings_module_form');
        _handleOfficeAddForm();
        submitButton = document.querySelector('#kt_module_submit');
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
  KTvalidationModule.init();
});