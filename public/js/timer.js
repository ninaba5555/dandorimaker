function timer(id)
{
    const timerBtn = document.querySelector('#timer-btn');

    var Format = new DateFormat('yyyy-MM-dd HH:mm:ss');
    if (timerBtn.dataset.mode == 'start') {
        timerBtn.dataset.mode = 'stop';
        timerBtn.dataset.start = Format.format(new Date());
        timerBtn.innerText = '終了';

    } else if (timerBtn.dataset.mode == 'stop') {
        const start = timerBtn.dataset.start;
        const end = Format.format(new Date());

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/plan/do",
            data: {
                id: id,
                start: start,
                end: end
            },
            cache: false,
            dataType: 'json'
        }).done(function (response, textStatus, jqXHR) {
            if (response.status === "err") {
                alert(response.msg);
            } else {
                if (response.status === "next") {
                    window.location.href =
                        '/plan/do?plan_id=' + response.plan_id
                        + '&task_id=' + response.task_id;
                } else {
                    window.location.href = '/plan';
                }
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert("サーバー内でエラーがあったか、サーバーから応答がありませんでした。");
        });
    }

}