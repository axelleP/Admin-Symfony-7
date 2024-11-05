function initializeBootstrapTable() {
    if (!$('#table').data('bootstrap.table')) {
        $('#table').bootstrapTable();
    }
}

$(document).on('turbo:load', function() {
    initializeBootstrapTable();
});