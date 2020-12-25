function up(id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "/task/up/" + id,
        cache: false,
        dataType: 'json'
    }).done(function (response, textStatus, jqXHR) {
        console.log(response);
        if (response.status === "err") {
            alert(response.msg);
        } else {
            location.reload();
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        alert("サーバー内でエラーがあったか、サーバーから応答がありませんでした。");
    });
}

function down(id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "/task/down/" + id,
        cache: false,
        dataType: 'json'
    }).done(function (response, textStatus, jqXHR) {
        console.log(response);
        if (response.status === "err") {
            alert(response.msg);
        } else {
            location.reload();
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        alert("サーバー内でエラーがあったか、サーバーから応答がありませんでした。");
    });

}
