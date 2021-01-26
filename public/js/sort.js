const up = (id) => {
    ajaxCall("/task/up/" + id);
};

const down = (id) => {
    ajaxCall("/task/down/" + id);
};

const submitSortData = () => {
    const $tasks = document.getElementById('tasks').querySelectorAll('[data-id]');
    const tasksLength = $tasks.length;
    let tasksIndex = 0;
    let ids = '';

    while (tasksIndex < tasksLength) {
        ids += $tasks[tasksIndex].dataset.id;
        if (tasksIndex != tasksLength - 1) {
            ids += '/';
        }
        tasksIndex++;
    }

    ajaxCall("/task/sort", {
        id: ids
    });
};

window.onload = () => {
    let el = document.getElementById('tasks');
    Sortable.create(el, {
        handle: '.handle',
        chosenClass: 'tasks__item--chosen',
        animation: 100,
        onEnd: (ev) => {
            submitSortData();
        }
    });
};
