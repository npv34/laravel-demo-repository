$(document).ready(function () {
    $('.checkbox-info').click(function () {
        let value = $(this).attr("data-id");
        $("." + value).toggle();
    });

    $('.data-user').mouseenter(function () {
        $(this).css("background-color", "red");
        $(this).css("color", "white")
    }).mouseleave(function () {
        $(this).css("background-color", "white");
        $(this).css("color", "black")
    });

    $('#search-user').on('keyup', function () {
        let keyword = $(this).val();
        if (keyword) {
            let location = window.location.origin;
            $('#ul-user').html('');
            $.ajax({
                url: location + '/admin/users/search',
                method: 'GET',
                type: 'json',
                data: {
                    keyword: keyword
                },
                success: function (result) {
                    let html = '';
                    $.each(result, function (index, item) {
                        html += '<li>';
                        html += item.name;
                        html += '</li>';
                    })
                    $('#ul-user').append(html)
                    console.log(result);
                },
                error: function (error) {
                    console.log(error)
                }
            })
        } else {
            $('#ul-user').html('');
        }


    });

});

