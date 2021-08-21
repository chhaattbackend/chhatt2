// $('.fa-search').on('click', function(e) {
//     keyword=$('#table_search').val()
//     event.preventDefault()
//     data = {
//         'keyword': $('#table_search').val()
//     }
//     e.preventDefault();
//     $.ajax({
//         type: "GET",
//         url: window.location.href+'?keyword='+$('#table_search').val(),
//         dataType: 'html',

//         success: function(response) {
//             $('body').html(response)
//             $('#table_search').val(keyword)
//             $('#table_search').focus()
//             // console.log(response)
//             // alert('Data Saved!');
//         },
//     });
// });

// $('#table_search').on('keyup', function(e) {
//     keyword=$('#table_search').val()
//     event.preventDefault()
//     data = {
//         'keyword': $('#table_search').val()
//     }
//     e.preventDefault();
//     $.ajax({
//         type: "GET",
//         url: window.location.href,
//         dataType: 'html',
//         data: data,
//         success: function(response) {
//             $('.searcharea').html(response)
//             $('#table_search').val(keyword)
//             $('#table_search').focus()
//             // console.log(response)
//             // alert('Data Saved!');
//         },
//     });
// });

function search() {
    keyword = $('#table_search').val()
    event.preventDefault()
    data = {
        'keyword': keyword
    }
    history.replaceState('.', '.', window.location.href.split('?')[0] + '?page=1');
    $.ajax({
        type: 'get',
        url: window.location.href,
        dataType: 'html',
        data: data,
        success: function(response) {
            $('.searcharea').html(response)
            $('#table_search').val(keyword)
            $('#table_search').focus()
                // console.log(response)
                // alert('Data Saved!');
        },
    });
}


// {{-- --------------------------displaying image after uploading--------------------------------------- --}}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah')
                .attr('src', e.target.result)
                .width('100%')
                .height('90%');
        };

        reader.readAsDataURL(input.files[0]);
    }
}


// {{-- -------------------------------------------------------------------------------------------- --}}

$('select').select2();
$('#response_status').select2()


$('.fa-trash-alt').click(function(event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
            title: `Are you sure you want to delete?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
                swal("Your  file has been deleted!", {
                    icon: "success",
                });
            }
        });
});



// {{-- -------------------------------dynamic dropdown---------------------------------------- --}}

$('#area_one_id').change(function() {
    // alert('h')
    var id = $(this).val();
    var name1 = $("#area_one_id option:selected").text();

    $('#area_two_id').find('option').not(':first').remove();
    $.ajax({
        url: '/categories/' + id,
        type: 'get',
        dataType: 'json',
        success: function(response) {
            var len = 0;
            if (response.data != null) {
                len = response.data.length;
            }

            if (len > 0) {
                for (var i = 0; i < len; i++) {
                    var id = response.data[i].id;
                    var name = response.data[i].name;

                    var option = "<option value='" + id + "'>" + name + '-' + name1 + "</option>";

                    $("#area_two_id").append(option);
                }
            }
            $("#area_three_id").html(
                '<option disabled selected value="">Select Sub-Sub-Area</option>');
        }
    })
});

$('#area_two_id').change(function() {

    var id = $(this).val();

    $('#area_three_id').find('option').not(':first').remove();

    $.ajax({
        url: '/subcategories/' + id,
        type: 'get',
        dataType: 'json',
        success: function(response) {
            var len = 0;
            if (response.data != null) {
                len = response.data.length;
            }

            if (len > 0) {
                for (var i = 0; i < len; i++) {
                    var id = response.data[i].id;
                    var name = response.data[i].name;

                    var option = "<option value='" + id + "'>" + name + "</option>";

                    $("#area_three_id").append(option);
                }
            }

        }
    })
});


// {{-- ----------------------------------------------------------------------- --}}



function disableButton() {
    var e = this;
    setTimeout(function() { e.disabled = true; }, 0);
    return true;
}

// rotate();
function rotate(degree, id) {
    // alert(id)
    // degree=degree*.5
    var $elie = $('#' + id);
    $elie.css({ WebkitTransform: 'rotate(' + degree + 'deg)' });
    $elie.css({ '-moz-transform': 'rotate(' + degree + 'deg)' });


}


$('.response_status').on('change', function() {
    lead_id = $(this).attr('lead_id')
    status = $(this).find(":selected").val();

    $.ajax({
        url: 'leads/ajax',
        type: 'post',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        data: {
            responsestatus_id: lead_id,
            responsestatus_val: status
        },
        success: function() {
            $('.status' + lead_id).text(status)
            $('.status' + lead_id).css({ 'background-color': 'red' })

        }
    })
})

$('.call_status').on('change', function() {
    lead_id = $(this).attr('lead_id')
    status = $(this).find(":selected").val();

    $.ajax({
        url: 'leads/ajax',
        type: 'post',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        data: {
            callstatus_id: lead_id,
            callstatus_val: status
        },
        success: function() {
            // $('.status' + lead_id).text(status)
            // $('.status' + lead_id).css({ 'background-color': 'red' })
        }
    })
})