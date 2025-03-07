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

    // Menu Toggle
    let menuBtn = $(".menu-btn i");
    let sidebar = $(".sidebar");
    let content = $(".content");
    function checkScreenSize() {
        if ($(window).width() < 768) {
            sidebar.removeClass("active");
            content.removeClass("active");
            menuBtn.removeClass("fa-times fa-arrow-right").addClass("fa-bars");
        }
    }
    checkScreenSize();
    $(window).resize(checkScreenSize);
    $(".menu-btn").click(function () {
        sidebar.toggleClass("active");
        content.toggleClass("active");
        if (sidebar.hasClass("active")) {
            menuBtn.removeClass("fa-arrow-right").addClass("fa-times");
        } else {
            menuBtn.removeClass("fa-times").addClass("fa-arrow-right");
        }
    });
    $(".menu-btn").hover(
        function () {
            if ($(".sidebar").hasClass("active")) {
                menuBtn.removeClass("fa-bars").addClass("fa-times");
            } else {
                menuBtn
                    .removeClass("fa-arrow-right")
                    .addClass("fa-arrow-right");
            }
        },
        function () {
            if (!$(".sidebar").hasClass("active")) {
                menuBtn.removeClass("fa-arrow-right").addClass("fa-bars");
            } else {
                menuBtn.removeClass("fa-times").addClass("fa-bars");
            }
        }
    );

    // Sidebar Dropdown Toggle with Auto Close
    $(".menu-toggle").click(function (e) {
        e.preventDefault();
        let parent = $(this).closest(".nav-item");
        let submenu = parent.find(".nav-content");
        let icon = parent.find(".fa-chevron-down, .fa-chevron-up");
        $(".nav-item")
            .not(parent)
            .removeClass("open")
            .find(".nav-content")
            .slideUp(300);
        $(".nav-item")
            .not(parent)
            .find(".fa-chevron-up")
            .removeClass("fa-chevron-up")
            .addClass("fa-chevron-down");
        parent.toggleClass("open");
        submenu.slideToggle(300);
        if (parent.hasClass("open")) {
            icon.removeClass("fa-chevron-down").addClass("fa-chevron-up");
        } else {
            icon.removeClass("fa-chevron-up").addClass("fa-chevron-down");
        }
    });
    // Dark theme
    const isDarkMode = sessionStorage.getItem("darkMode") === "true";
    if (isDarkMode) {
        $("body").addClass("dark-mode");
        $("#theme-toggle").html('<i class="fa fa-sun"></i> Light Mode');
    }
    $("#theme-toggle").click(function () {
        $("body").toggleClass("dark-mode");
        const isEnabled = $("body").hasClass("dark-mode");
        sessionStorage.setItem("darkMode", isEnabled);
        if (isEnabled) {
            $("#theme-toggle").html(
                '<i class="fa fa-sun me-3"></i> <span>Light Mode</span>'
            );
        } else {
            $("#theme-toggle").html(
                '<i class="fa fa-moon me-3"></i> <span>Dark Mode</span>'
            );
        }
    });
    // reload scroll place
    var scrollPosition = sessionStorage.getItem("scrollPosition");
    if (scrollPosition) {
        $(window).scrollTop(scrollPosition);
    }
    // Save scroll position before page reload
    $(window).on("beforeunload", function () {
        sessionStorage.setItem("scrollPosition", $(window).scrollTop());
    });
    // AI
    // $.ajax({
    //     url: "https://api.deepseek.com/chat/completions", // Replace with the actual endpoint
    //     method: "POST", // Change to "POST" if needed
    //     headers: {
    //         Authorization: "Bearer sk-627b64daa5ad468cbd7df9b481b5ee95", // If authentication is required
    //         "Content-Type": "application/json",
    //     },
    //     data: JSON.stringify({
    //         model: "deepseek-chat",
    //         messages: [
    //             { role: "system", content: "You are a helpful assistant." },
    //             { role: "user", content: "Hello!" },
    //         ],
    //         stream: false,
    //     }),
    //     success: function (response) {
    //         console.log("Success:", response);
    //     },
    //     error: function (xhr, status, error) {
    //         console.error("Error:", status, error);
    //     },
    // });
});
