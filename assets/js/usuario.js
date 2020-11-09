
function onUserSearch(e) {
    let value = $('#inputEmail').val();

    if (value.length > 2) {
        $.ajax({
            type: "POST",
            url: "search.php",
            datatype: "application/json",
            data: value,
            success: function (data) {
                buildDatalist(data);
            }
        });
    }

}

function buildDatalist(data) {
    datalist = $('#userlist');
    datalist.empty();
    data.forEach(function (element) {
        option = '<option>' + element.user_email + '</option>';
        datalist.append(option);
    });
}

function fetchLoginData(email) {
    $.ajax({
        type: "POST",
        url: "login.php",
        datatype: "application/json",
        data: { email: email},
        success: function (data) {
            updateLoginInfo(data[0]);
        }
    });
}

function updateLoginInfo(login) {
    $('#no-login-info, #login-info').css('display' ,'none');
    $('#loginMap').empty();
    if (login) {
        $('#loginEmail').html(login.email);
        $('#loginCreated').html(login.created_at);
        $('#loginProvincia').html(login.provincia);
        $('#login-info').css('display' ,'block');

        let map = '<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBCHmAbrq2Z-YNVEPmmhbfGJlPTE2MUids&q='+login.provincia+'&center='+login.latitude+','+login.longitude+'" allowfullscreen></iframe>';
        $('#loginMap').append(map);
    } else {
        $('#no-login-info').css('display' ,'block');
    }
}

$(document).on('change', 'input', function () {
    var options = $('datalist')[0].options;
    for (var i = 0; i < options.length; i++) {
        if (options[i].value == $(this).val()) {
            fetchLoginData($(this).val());
            $('input').blur();
        }
    }

});