const up = (id) => {
    ajaxCall("/task/up/" + id);
}

const down = (id) => {
    ajaxCall("/task/down/" + id);
}

const submitSortData = () => {
    const tasks = document.getElementById('tasks').querySelectorAll('[data-id]');
    let ids = '';
    for (let i = 0; i < tasks.length; i++) {
        ids += tasks[i].dataset.id;
        if (i != tasks.length - 1) {
            ids += '/';
        }
    }
    ajaxCall("/task/sort", {
        id: ids
    });
}

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
}
