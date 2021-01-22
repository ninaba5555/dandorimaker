const ajaxCall = (url, data = {}, doneCallBack = defaultDoneCallBack) =>
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

// ajax通信成功時の標準コールバック関数
const defaultDoneCallBack = (response) =>
{
    if (response.status === "err") {
        alert(response.msg);
    } else {
        location.reload();
    }
}
