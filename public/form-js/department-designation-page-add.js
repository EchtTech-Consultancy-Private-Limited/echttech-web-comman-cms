var KTvalidationDepartment= function() {
    var _officeAdd;
    var jsonURL = $('#urlListData').attr('data-info');
    var crudUrlTemplate = JSON.parse(jsonURL);
    var _handleOfficeAddForm = function(e) {
        var validation;
        var form = document.getElementById('kt_department_settings_general');
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            form,
            {
                fields: {
                    departmentName: {
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
    $('.submit-department-btn').click( function(e) {
            e.preventDefault();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    //$('#examAddModal').modal('hide');
                    $('#loading').addClass('loading');
                   $('#loading-content').addClass('loading-content');
                 axios.post(crudUrlTemplate.create_deptDesig, {
                       name_en: $('.departmentName').val(),
                    })
                    .then(function (response) {
                    if (response.data.status ==200) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                       toastr.success(
                          "New Department added successfully!", 
                          "New Department!", 
                          {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                       );
                       setTimeout(function() {
                          if (history.scrollRestoration) {
                             history.scrollRestoration = 'manual';
                          }
                          location.href = 'departmentdesignation-create'; // reload page
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
            _officeAdd = $('#kt_department_settings_general');
        _handleOfficeAddForm();
        submitButton = document.querySelector('#kt_department_submit');
        }
    };
}();

var KTvalidationDesignation= function() {
    var _officeAdd2;
    var jsonURL = $('#urlListData').attr('data-info');
    var crudUrlTemplate = JSON.parse(jsonURL);
    var _handleOfficeAddForm2 = function(e) {
        var validation;
        var form = document.getElementById('kt_designation_content_settings');
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            form,
            {
                fields: {
                    designationName: {
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
                    'deprt_id': {
                          validators: {
                             notEmpty: {
                                message: 'This field is required'
                             }
                          }
                       }
                 },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5()
                }
            }
        );
        
        $('.submit-designation-btn').click( function(e) {
            e.preventDefault();
            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    $('#loading').addClass('loading');
                    $('#loading-content').addClass('loading-content');
                    //$('#examAddModal').modal('hide');
                 axios.post(crudUrlTemplate.create_deptDesig, {
                       name_en: $('.designationName').val(),
                       parent_id: $('.deprt_id').val(),
                    })
                    .then(function (response) {

                    if (response.data.status ==200) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                       toastr.success(
                          "New Designation added successfully!", 
                          "New Designation!", 
                          {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                       );
                       setTimeout(function() {
                          if (history.scrollRestoration) {
                             history.scrollRestoration = 'manual';
                          }
                          location.href = 'departmentdesignation-create'; // reload page
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
            _officeAdd2 = $('#kt_designation_content_settings');
        _handleOfficeAddForm2();
        submitButton = document.querySelector('#kt_designation_submit');
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTvalidationDepartment.init();
    KTvalidationDesignation.init();
});