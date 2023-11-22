var KTvalidationCoreWebsiteSetting1= function() {
    var jsonURL = $('#urlListData').attr('data-info');
    var crudUrlTemplate = JSON.parse(jsonURL);
    var _officeAdd;
    var _handleOfficeAddForm = function(e) {
        var validation;
        var form = document.getElementById('kt_core_website_settings_form');
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            form,
            {
                fields: {
                 logo_title: {
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
                    header_logo: {
                        validators: {
                            notEmpty: {
                                message: 'This field is required'
                            },
                            regexp: {
                                regexp: /\.(gif|jpe?g|tiff?|png|webp|bmp)$/i,
                                message: 'This field can consist of png, jpeg, jpg, image only'
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
        $('.submit-coreWebsiteSetting-btn').click( function(e) {
            e.preventDefault();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    //$('#examAddModal').modal('hide');
                    $('#loading').addClass('loading');
                    $('#loading-content').addClass('loading-content');
                 axios.post(crudUrlTemplate.create_headerlogo,new FormData(form), {
                    }).then(function (response) {
                       console.log(response.data.message);
                    if (response.data.status ==200) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                       toastr.success(
                          "New Header Logo added successfully!", 
                          "New Header!", 
                          {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                       );
                       setTimeout(function() {
                          if (history.scrollRestoration) {
                             history.scrollRestoration = 'manual';
                          }
                          location.href = 'websitecoresetting-create'; // reload page
                       }, 1500);
                      
                    } else {
                       toastr.error(
                          response.data.message.header_logo,
                          "Something went wrong!", 
                          {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                       );
                       }
                    })
                    .catch(function (error) {
                          toastr.error(
                             "Sorry, looks like there are some errors detected, please try again B.", 
                             "Something went wrong!", 
                             {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
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
            _officeAdd = $('#kt_core_website_settings_form');
        _handleOfficeAddForm();
        submitButton = document.querySelector('#kt_coreWebsiteSetting_submit');
        }
    };
}();
var KTvalidationCoreWebsiteSetting2= function() {
    var jsonURL = $('#urlListData').attr('data-info');
    var crudUrlTemplate = JSON.parse(jsonURL);
    var _officeAdd2;
    var _handleOfficeAddForm2 = function(e) {
        var validation;
        var form = document.getElementById('kt_footer_content_settings_form');
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            form,
            {
                fields: {
                 logo_title: {
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
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5()
                }
            }
        );
        $('.submit-coreWebsiteSetting-btn2').click( function(e) {
            e.preventDefault();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    //$('#examAddModal').modal('hide');
                    $('#loading').addClass('loading');
                    $('#loading-content').addClass('loading-content');
                    var formData= new FormData(form);
                    formData.append("kt_description_en", $('#kt_summernote_en').summernote('code'));
                    formData.append("kt_description_hi", $('#kt_summernote_hi').summernote('code'));
                    formData.append("locate_map_links", $('#locate_map_link').val());
                 axios.post(crudUrlTemplate.create_footerContent, formData, {
                    })
                    .then(function (response) {
                    if (response.data.status ==200) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                       toastr.success(
                          "New Footer added successfully!", 
                          "New Footer!", 
                          {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                       );
                       setTimeout(function() {
                          if (history.scrollRestoration) {
                             history.scrollRestoration = 'manual';
                          }
                          location.href = 'websitecoresetting-create'; // reload page
                       }, 1500);
                      
                    } else {
                       toastr.error(
                             response.data.message,
                          "Something went wrong!", 
                          {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                       );
                       }
                    })
                    .catch(function (error) {
                          toastr.error(
                             "Sorry, looks like there are some errors detected, please try again B.", 
                             "Something went wrong!", 
                             {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
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
var demos = function () {
    $('.summernote').summernote({
        placeholder: 'Description...',
        height: 200,
        tabsize: 2
    });
}
    return {
        init: function() {
           demos();
            _officeAdd2 = $('#kt_footer_content_settings_form');
        _handleOfficeAddForm2();
        submitButton = document.querySelector('#kt_coreWebsiteSetting_submit2');
        }
    };
}();
var KTvalidationCoreWebsiteSetting3= function() {
    var jsonURL = $('#urlListData').attr('data-info');
    var crudUrlTemplate = JSON.parse(jsonURL);
    var _officeAdd3;
    var _handleOfficeAddForm3 = function(e) {
        var validation;
        var form = document.getElementById('kt_social_link_settings_form');
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            form,
            {
                fields: {
                 google_link: {
                        validators: {
                            notEmpty: {
                                message: 'This url is you have fill http or https url'
                            },
                            regexp: {
                                regexp: /^(http|https):\/\//,
                                message: 'This field can consist of http or https url only'
                            },
                        },
                    },
                    linkedin: {
                        validators: {
                            notEmpty: {
                                message: 'This url is you have fill http or https url'
                            },
                            regexp: {
                                regexp: /^(http|https):\/\//,
                                message: 'This field can consist of http or https url only'
                            },
                        },
                    },
                    facebook: {
                        validators: {
                            notEmpty: {
                                message: 'This url is you have fill http or https url'
                            },
                            regexp: {
                                regexp: /^(http|https):\/\//,
                                message: 'This field can consist of http or https url only'
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
        $('.submit-coreWebsiteSetting-btn3').click( function(e) {
            e.preventDefault();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    //$('#examAddModal').modal('hide');
                    $('#loading').addClass('loading');
                    $('#loading-content').addClass('loading-content');
                 axios.post(crudUrlTemplate.create_sociallink, {
                       google_link: $('.google_link').val(),
                       linkedin: $('.linkedin').val(),
                       facebook: $('.facebook').val(),
                       twitter: $('.twitter').val(),
                       instagram: $('.instagram').val(),
                       github: $('.github').val(),
                    })
                    .then(function (response) {

                    if (response) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                       toastr.success(
                          "New Social Link added successfully!", 
                          "New Social Link!", 
                          {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                       );
                       setTimeout(function() {
                          if (history.scrollRestoration) {
                             history.scrollRestoration = 'manual';
                          }
                          location.href = 'websitecoresetting-create'; // reload page
                       }, 1500);
                      
                    } else {
                       toastr.error(
                          "Sorry, the information is incorrect, please try again.", 
                          "Something went wrong!", 
                          {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                       );
                       }
                    })
                    .catch(function (error) {
                          toastr.error(
                             "Sorry, looks like there are some errors detected, please try again B.", 
                             "Something went wrong!", 
                             {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
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
            _officeAdd3 = $('#kt_social_link_settings_form');
        _handleOfficeAddForm3();
        submitButton = document.querySelector('#kt_coreWebsiteSetting_submit3');
        }
    };
}();
var KTvalidationCoreWebsiteSetting4= function() {
    var jsonURL = $('#urlListData').attr('data-info');
    var crudUrlTemplate = JSON.parse(jsonURL);
    var _officeAdd4;
    var _handleOfficeAddForm4 = function(e) {
        var validation;
        var form = document.getElementById('kt_popupadvertising_settings_form');
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            form,
            {
                fields: {
                    popupadvertising_title: {
                        validators: {
                            notEmpty: {
                                message: 'This field is required'
                            },
                            
                        },
                    },
                    popupadvertising_file: {
                        validators: {
                            notEmpty: {
                                message: 'This field is required'
                            },
                            regexp: {
                                regexp: /[^\s]+(.*?).(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)$/,
                                message: 'Valid image file, image only'
                            },
                        },
                    },
                    popupadvertising_from: {
                        validators: {
                            notEmpty: {
                                message: 'This field is required'
                            },
                            
                        },
                    },
                    popupadvertising_to: {
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
        $('.submit-popupadvertising-btn').click( function(e) {
            e.preventDefault();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    //$('#examAddModal').modal('hide');
                    $('#loading').addClass('loading');
                    $('#loading-content').addClass('loading-content');
                 axios.post(crudUrlTemplate.create_popupadvertising, new FormData(form),{
                      
                    })
                    .then(function (response) {

                    if (response.data.status ==200) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                       toastr.success(
                          "New Popup Advertising added successfully!", 
                          "New Popup Advertising!", 
                          {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                       );
                       setTimeout(function() {
                          if (history.scrollRestoration) {
                             history.scrollRestoration = 'manual';
                          }
                          location.href = 'websitecoresetting-create'; // reload page
                       }, 1500);
                      
                    } else {
                       toastr.error(
                          response.data.message,  
                          "Something went wrong!", 
                          {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                       );
                       }
                    })
                    .catch(function (error) {
                          toastr.error(
                             "Sorry, looks like there are some errors detected, please try again B.", 
                             "Something went wrong!", 
                             {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
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
            _officeAdd4 = $('#kt_popupadvertising_settings_form');
        _handleOfficeAddForm4();
        submitButton = document.querySelector('#kt_popupadvertising_submit');
        }
    };
}();
jQuery(document).ready(function() {
  KTvalidationCoreWebsiteSetting1.init();
  KTvalidationCoreWebsiteSetting2.init();
  KTvalidationCoreWebsiteSetting3.init();
  KTvalidationCoreWebsiteSetting4.init();
});