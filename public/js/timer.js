const timer = (id, ideal) => {
    const Format = new DateFormat('yyyy-MM-dd HH:mm:ss');
    const $timer = document.querySelector('#timer');
    const $timerBtn = document.querySelector('#timer-btn');
    let start, end;

    if ($timerBtn.dataset.mode === 'start') {
        $timerBtn.dataset.mode = 'stop';
        $timerBtn.innerText = '終了';

        // 開始時間を保持
        start = new Date();
        $timerBtn.dataset.start = Format.format(start);

        // タイマー
        startU = start.getTime();
        ideal *= 1000;
        setInterval(() => {
            let seconds = ideal - (Date.now() - startU);
            seconds = Math.floor(seconds / 1000);
            $timer.innerHTML = s2m(seconds);
        });
    } else if ($timerBtn.dataset.mode === 'stop') {
        start = $timerBtn.dataset.start;
        end = Format.format(new Date());
        ajaxCall("/plan/do", {
            id: id,
            start: start,
            end: end
        }, timerCallBack);
    }
}

// 分秒に変換
const s2m = (seconds) => {
    let minutes;
    let text = '残り';

    if (seconds < 0) {
        seconds = Math.abs(seconds);
        text += '-';
    }
    minutes = Math.floor((seconds / 60) % 60);
    seconds = seconds % 60;
    if (minutes > 0) {
        text += minutes + '分' + seconds + '秒';
    } else {
        text += seconds + '秒';
    }

    return text;
}

// ajax通信成功時のコールバック関数
const timerCallBack = (response) => {
    if (response.status === "err") {
        alert(response.msg);
    } else {
        if (response.status === "next") {
            // 次のタスクがある場合
            window.location.href =
                '/plan/do?plan_id=' + response.plan_id
                + '&task_id=' + response.task_id;
        } else {
            window.location.href = '/plan';
        }
    }
}
