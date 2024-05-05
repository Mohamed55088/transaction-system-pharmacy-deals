$(document).ready(function () {
    $(".datatable").DataTable();
    // datatable export buttons
    $("#datatable-export").DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: "collection",
                text: " طباعة البيانات ",
                buttons: [
                    {
                        text: "استخراج pdf",
                        extend: "pdf",
                        exportOptions: {
                            columns: "thead th:not(.action-btn)",
                        },
                    },
                    {
                        text: " استخراج excel ",
                        extend: "excel",
                        exportOptions: {
                            columns: "thead th:not(.action-btn)",
                        },
                    },
                    {
                        text: "استخراج csv ",
                        extend: "csv",
                        exportOptions: {
                            columns: "thead th:not(.action-btn)",
                        },
                    },
                    {
                        text: " طباعة ",
                        extend: "print",
                        exportOptions: {
                            columns: "thead th:not(.action-btn)",
                        },
                    },
                ],
            },
        ],
    });
});
