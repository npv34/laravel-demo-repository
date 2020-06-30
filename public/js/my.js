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
        let location = window.location.origin;
        // console.log(location);
        $.ajax({
            url: location + '/admin/users/search',
            method: 'GET',
            type: 'json',
            data: {
                keyword: keyword
            },
            success: function (result) {
                console.log(result);
                let html = '';

                $.each(result, function (index, item) {
                    html += '<tr class="data-user">';
                    html += '<td>';
                    html += index + 1;
                    html += '</td>';
                    html += '<td class="data-name">';
                    html += item.name;
                    html += '</td>';
                    html += '<td class="data-email">';
                    html += item.email;
                    html += '</td>';
                    html += '<td class="data-birthday">';
                    html += item.birthday;
                    html += '</td>';
                    html += '<td class="data-role">';
                    $.each(item.roles, function (i, role) {
                        html += role.name + ','
                    });
                    html += '</td>';
                    html += '<td>';
                    html += '<a href="">\n' +
                        '<i class="fa fa-edit"></i>\n' +
                        '</a>';
                    html += '</td>';
                    html += '</tr>';
                });

                $('#list-user').html(html)
            },
            error: function (error) {
                console.log(error)
            }
        })
    })
});

