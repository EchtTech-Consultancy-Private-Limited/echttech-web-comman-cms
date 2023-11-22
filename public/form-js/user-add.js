var KTAppUserSave = function () {
    var jsonURL = $('#urlListData').attr('data-info');
    var crudUrlTemplate = JSON.parse(jsonURL);
    var _officeAdd;
    var _handleOfficeAddForm = function(e) {
    var validation;
    var form = document.getElementById('kt_modal_add_user_form');
       // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
       validation = FormValidation.formValidation(
             form,
             {
                fields: {
                 user_name: {
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
                   user_email: {
                         validators: {
                            notEmpty: {
                               message: 'This field is required'
                            },
                             regexp: {
                                 regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                 message: 'The value is not a valid email address',
                            },
                         },
                   },
                   user_role: {
                         validators: {
                            notEmpty: {
                               message: 'This field is required'
                            },
                         },
                   },
                   password: {
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
       $('.submit-user-btn').click( function(e) {
             e.preventDefault();
             validation.validate().then(function(status) {
                if (status == 'Valid') {
                   submitButton.setAttribute('data-kt-indicator', 'on');
                   submitButton.disabled = true;
                   //$('#examAddModal').modal('hide');
                    $('#loading').addClass('loading');
                    $('#loading-content').addClass('loading-content');
                  //var formData= new FormData(form);
                 // formData.append("kt_description_en", $('#kt_summernote_en').summernote('code'));
                 // formData.append("kt_description_hi", $('#kt_summernote_hi').summernote('code'));
                axios.post(crudUrlTemplate.create,
                         new FormData(form), {
                   }).then(function (response) {
                   if (response.data.status == 200) {
                    $('#loading').removeClass('loading');
                    $('#loading-content').removeClass('loading-content');
                      toastr.success(
                         "New User added successfully!", 
                         "New User!", 
                         {timeOut: 0, extendedTimeOut: 0, closeButton: true, closeDuration: 0}
                      );
                      setTimeout(function() {
                         if (history.scrollRestoration) {
                            history.scrollRestoration = 'manual';
                         }
                         location.href = 'user-list'; // reload page
                      }, 1500);
                      
                   } else {
                      toastr.error(
                         response.data.email, 
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
 
 // Cancel button handler
 const cancelButton = document.getElementById('kt_modal_add_user').querySelector('[data-kt-users-modal-action="cancel"]');
     cancelButton.addEventListener('click', e => {
         e.preventDefault();
 
         Swal.fire({
             text: "Are you sure you would like to cancel?",
             icon: "warning",
             showCancelButton: true,
             buttonsStyling: false,
             confirmButtonText: "Yes, cancel it!",
             cancelButtonText: "No, return",
             customClass: {
                 confirmButton: "btn btn-primary",
                 cancelButton: "btn btn-active-light"
             }
         }).then(function (result) {
             if (result.value) {
                 document.getElementById('kt_modal_add_user_form').reset(); // Reset form			
                 $('#kt_modal_add_user').modal('hide');
             } else if (result.dismiss === 'cancel') {
                 Swal.fire({
                     text: "Your form has not been cancelled!.",
                     icon: "error",
                     buttonsStyling: false,
                     confirmButtonText: "Ok, got it!",
                     customClass: {
                         confirmButton: "btn btn-primary",
                     }
                 });
             }
         });
     });
 
     // Close button handler
 const closeButton = document.getElementById('kt_modal_add_user').querySelector('[data-kt-users-modal-action="close"]');
     closeButton.addEventListener('click', e => {
         e.preventDefault();
 
         Swal.fire({
             text: "Are you sure you would like to cancel?",
             icon: "warning",
             showCancelButton: true,
             buttonsStyling: false,
             confirmButtonText: "Yes, cancel it!",
             cancelButtonText: "No, return",
             customClass: {
                 confirmButton: "btn btn-primary",
                 cancelButton: "btn btn-active-light"
             }
         }).then(function (result) {
             if (result.value) {
                 document.getElementById('kt_modal_add_user_form').reset(); // Reset form			
                 $('#kt_modal_add_user').modal('hide');
             } else if (result.dismiss === 'cancel') {
                 Swal.fire({
                     text: "Your form has not been cancelled!.",
                     icon: "error",
                     buttonsStyling: false,
                     confirmButtonText: "Ok, got it!",
                     customClass: {
                         confirmButton: "btn btn-primary",
                     }
                 });
             }
         });
     });
 return {
         init: function () {
             _officeAdd = $('#kt_modal_add_user_form');
             _handleOfficeAddForm();
             submitButton = document.querySelector('#kt_add_user_submit');
             // Handle forms
         }
     };
 }();
 // On document ready
 jQuery(document).ready(function() {
     KTAppUserSave.init();
 });