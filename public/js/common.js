const ajaxCall = (url, data = {}, doneCallBack = defaultCallBack) =>
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        cache: false,
        dataType: 'json'
    }).done((response, textStatus, jqXHR) => {
        doneCallBack(response);
    }).fail((jqXHR, textStatus, errorThrown) => {
        alert("サーバー内でエラーがあったか、サーバーから応答がありませんでした。");
    });
}

const defaultCallBack = (response) =>
{
    if (response.status === "err") {
        alert(response.msg);
    } else {
        location.reload();
    }
}
