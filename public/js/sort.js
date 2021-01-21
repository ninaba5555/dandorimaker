function up(id)
{
    ajaxCall("/task/up/" + id);
}

function down(id)
{
    ajaxCall("/task/down/" + id);
}

window.onload = function() {
    var el = document.getElementById('tasks');
    var sortable = Sortable.create(el, {
        handle: '.handle',
        chosenClass: 'tasks__item--chosen',
        animation: 100,
        onEnd: function (ev) {
            submitSortData();
        }
    });
}

function submitSortData()
{
    var tasks = document.getElementById('tasks').querySelectorAll('[data-id]');
    var ids = '';
    for (var i = 0; i < tasks.length; i++) {
        ids += tasks[i].dataset.id;
        if (i != tasks.length - 1) {
            ids += '/';
        }
    }
    ajaxCall("/task/sort", {
        id: ids
    });
}