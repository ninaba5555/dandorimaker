function up(id)
{
    ajaxCall("/task/up/" + id);
}

function down(id)
{
    ajaxCall("/task/down/" + id);
}
