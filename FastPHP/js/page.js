$(function() {
    var table = $("#admin-table");
    var currentPage = 0;
    var pageSize = 10;
    var sumRows = table.find('tbody tr').length;
    var sumPages = Math.ceil(sumRows / pageSize);
    var pager = $('<ul class="pagination pull-right"></ul>');
    table.bind('paging', function() {
        table.find('tbody tr').hide().slice(currentPage * pageSize, (currentPage + 1) * pageSize).show();
    });
    for (var pageIndex = 0; pageIndex < sumPages; pageIndex++) {
        $('<li><a href="#"><span>' + (pageIndex + 1) + '</span></a></li>').bind("click", { "newPage": pageIndex }, function(event) {
            currentPage = event.data["newPage"];
            table.trigger("paging");
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
        }).appendTo(pager);
        pager.append(" ");
    }
    pager.insertAfter(table);
    table.trigger("paging");
    $(".pagination li:first-child").addClass("active");
});