var KTAppAssetApprove = function () {
    var crudUrlTemplate = JSON.parse(jsonURL);
 // bind delete link to click event
 $(".approve-single-record").click(function (event) {
             event.preventDefault();
             var rowId = $(this).attr('data-id');
             swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'success',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approved it!'
             }).then(function (result) {
                if (result.value) {
                   axios.post(crudUrlTemplate.deletepdfimg,{id:rowId})
                   .then(function (response) {
                      toastr.success(
                         "Record has been Approved!", 
                         "Approved!", 
                         {timeOut: 0,showProgressbar: true, extendedTimeOut: 0,allow_dismiss: false, closeButton: true, closeDuration: 0}
                      );
                      setTimeout(function() {
                         if (history.scrollRestoration) {
                            history.scrollRestoration = 'manual';
                         }
                         //location.href = 'contentpage-edit?id='+id; // reload page
                      }, 1500);
 
                   })
                   .catch(function (error) {
                      var errorMsg = 'Could not Approved record. Try later.';
                      if (error.response.status >= 400 && error.response.status <= 499)
                         errorMsg = error.response.data.message;
                      swal.fire(
                         'Error!',
                         errorMsg,
                         'error'
                      )
                   });     
                }
             });
          });
       }();
 // On document ready
 jQuery(document).ready(function() {
    KTAppAssetApprove.init();
 });