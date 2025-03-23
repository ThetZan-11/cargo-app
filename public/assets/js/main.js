$(document).ready(function () {
    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": token.content,
            },
        });
    } else {
        console.error("CSRF Token not found.");
    }
    $.extend(true, $.fn.dataTable.defaults, {
        processing: false,
        serverSide: true,
        responsive: true,
        mark: true,
        columnDefs: [
            {
                targets: "no-sort",
                orderable: false,
            },
            {
                targets: "no-search",
                searchable: false,
            },
            {
                targets: "hidden",
                visible: false,
            },
        ],
        lengthMenu: [
            [10, 25, 50, 100, 2000, -1],
            ["10 rows", "25 rows", "50 rows", "100 rows", "2000 rows", "All"],
        ],
        language: {
            paginate: {
                previous: '<i class="fa fa-circle-left"></i>',
                next: '<i class="fa fa-circle-right"></i>',
            },
        },
    });

    $("#toggle-btn").click(function () {
        $(".sidebar").toggleClass("active");
        $("#main-content").toggleClass("active");
    });
});
