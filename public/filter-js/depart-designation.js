    $('#deprt_id').on('change', function () {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        var iddepartment = this.value;
        $("#designation-dropdown").html('');
        $.ajax({
            url: 'fetch-designation',
            type: "POST",
            data: {
                department_id: iddepartment,
            },
            dataType: 'json',
            success: function (res) {
                $('#designation-dropdown').html('<option value="">-- Select Designation --</option>');
                $.each(res.cities, function (key, value) {
                    $("#designation-dropdown").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });