<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/png" href="assets/img/logo_putih.png" />
    <link rel="icon" type="image/png" href="assets/img/logo_putih.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Mading Biseka System</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <!-- Canonical SEO -->
    <link rel="canonical" href="https://yourwebsite.com/mading-biseka-system" />

    <!--  Social tags -->
    <meta name="keywords"
        content="Mading Biseka, bulletin board system, school communication, digital noticeboard, web app, responsive design, modern UI, school system, education" />

    <meta name="description"
        content="Mading Biseka System is a modern digital bulletin board designed for schools, offering a responsive and user-friendly platform for easy communication and announcements." />

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Mading Biseka System">
    <meta itemprop="description"
        content="Mading Biseka System is a modern digital bulletin board designed for schools, offering a responsive and user-friendly platform for easy communication and announcements.">
    <meta itemprop="image" content="https://bisekas.com/wp-content/uploads/2022/05/Logo_Biseka-removebg-preview.png">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@bisekas">
    <meta name="twitter:title" content="Mading Biseka System - Digital Bulletin Board for Schools">
    <meta name="twitter:description"
        content="Discover the Mading Biseka System, a digital bulletin board that makes school communication easy and efficient.">
    <meta name="twitter:creator" content="@bisekas">
    <meta name="twitter:image"
        content="https://bisekas.com/wp-content/uploads/2022/05/Logo_Biseka-removebg-preview.png">

    <!-- Open Graph data -->
    <meta property="og:title" content="Mading Biseka System - Digital Bulletin Board for Schools" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://bisekas.com/" />
    <meta property="og:image"
        content="https://bisekas.com/wp-content/uploads/2022/05/Logo_Biseka-removebg-preview.png" />
    <meta property="og:description"
        content="Mading Biseka System is a modern digital bulletin board designed for schools, providing an intuitive platform for effective communication." />
    <meta property="og:site_name" content="Mading Biseka System" />



    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
    {{-- <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.2/dist/bootstrap-table.min.css"> --}}
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!--   Fonts and icons   -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    {{-- js --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" {{-- integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"  --}} crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous">
    </script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.2/dist/bootstrap-table.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.29.0/tableExport.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.2/dist/bootstrap-table-locale-all.min.js"></script> --}}

    <style>
        html,
        body {
            font-family: "Plus Jakarta Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
            /* margin: 0;
            padding: 0; */
            height: 100%;
            overflow: hidden;
        }

        .full-screen-table {
            /* width: 100%; */
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .table {
            /* width: 100%; */
            height: 108%;
            display: flex;
            flex-direction: column;
            table-layout: fixed;
        }

        .table thead,
        .table tbody {
            display: block;
        }

        .table thead {
            /* flex: 0 0 auto; */
        }

        .table tbody {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
        }

        .table tbody tr {
            flex: 1 1 0;
            display: flex;
        }

        .th-inner {
            font-size: 2rem !important;
        }

        .table tbody tr td,
        .table thead th {
            flex: 1 1 0;
            /* display: flex; */
            align-items: center;
            justify-content: center;
            overflow: hidden;
            word-wrap: break-word;
            text-align: center;
            border: 1px solid #ccc;
            color: #f5f5f5;
            font-size: 1.8rem !important;
        }

        td {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;

        }

        /* .table thead th {
            background: #f2f2f2;
        } */
        tr:hover {
            /* background-color: #f5f5f5; */
        }

        .id-column {
            width: 20rem;
        }

        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 1rem;
        }

        .badge-primary {
            color: #fff;
            background-color: #0d6efd;
        }

        .badge-secondary {
            color: #fff;
            background-color: #6c757d;
        }

        .badge-success {
            color: #fff;
            background-color: #198754;
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }

        .badge-warning {
            color: #212529;
            background-color: #ffc107;
        }

        .badge-info {
            color: #fff;
            background-color: #0dcaf0;
        }

        .badge-light {
            color: #212529;
            background-color: #f8f9fa;
        }

        .badge-dark {
            color: #fff;
            background-color: #212529;
        }
    </style>

</head>

<body>

    <div class="wrapper">
        <a href="https://bisekas.com">
            <div class="logo-container full-screen-table-demo">
                <div class="logo">
                    <img src="assets/img/logo_putih.png" width="60" height="60">
                </div>
                <h3 class="brand text-nowrap font-weight-bold">
                    Project Information Dashboard
                </h3>
                <p class="font-weight-normal ml-2 mt-1 text-light">
                    Monitoring Projects In Progress
                </p>
            </div>

        </a>

        <div class="fresh-table full-color-blue full-screen-table">
            <table id="fresh-table" class="table" data-show-refresh="true" data-auto-refresh="true">
                <thead>
                    <th data-field="id" data-width="900">ID</th>
                    <th data-field="project_owner">Project Owner</th>
                    <th data-field="work_location">Work Location</th>
                    <th data-field="type_of_work">Type Of Work</th>
                    <th data-field="status">Status</th>
                    <th data-field="tanggal">Date</th>
                    <th data-field="pic">PIC</th>
                </thead>
            </table>
        </div>
        <script>
            $(function() {
                var $table = $('#fresh-table');
                var fetchDataUrl = "{{ route('mading.fetch') }}"; // The URL for fetching all data at once

                // Function to fetch all data from the server
                function fetchAllData() {
                    $.ajax({
                        url: fetchDataUrl,
                        method: 'GET',
                        async: true,
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response)
                            var data = response.data;
                            // console.log(data.data)
                            $table.bootstrapTable('load', data); // Load all data into the table
                        }
                    });
                }

                // Initialize the table with client-side pagination
                $table.bootstrapTable({
                    classes: 'table table-hover table-striped',
                    toolbar: '.toolbar',
                    search: true,
                    showRefresh: true,
                    showToggle: true,
                    showColumns: true,
                    striped: true,
                    sortable: true,
                    pagination: true, // Enable client-side pagination
                    sidePagination: 'client', // Client-side pagination
                    pageSize: 10, // Set page size as desired
                    pageList: [10, 25, 50, 100], // Optional: list of page sizes
                    height: $(window).height(),
                    columns: [{
                            field: 'id',
                            formatter: function(value, row, index) {
                                return index +
                                1; // Simple continuous row numbering for client-side pagination
                            },
                        },
                        {
                            field: 'project_owner',
                        },
                        {
                            field: 'work_location',
                        },
                        {
                            field: 'type_of_work',
                        },
                        {
                            field: 'status',
                            formatter: createBadge,
                        },
                        {
                            field: 'tanggal',
                            formatter: formatDate
                        },
                        {
                            field: 'pic',
                        },
                    ]
                });

                // Fetch all data and load it into the table
                fetchAllData();

                // Set interval to refresh data every 30 seconds
                setInterval(function() {
                    fetchAllData(); // Reload all data to keep it up to date
                }, 30000); // 30000 ms = 30 seconds

                // Handle refresh button click
                $table.on('refresh.bs.table', function() {
                    fetchAllData(); // Reload all data on manual refresh
                });

                // Format date to Indonesian format
                function formatDate(date, row, index) {
                    let tgl = new Date(date);
                    return new Intl.DateTimeFormat('id-ID', {
                        weekday: 'long',
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    }).format(tgl);
                }

                // Create a status badge based on the status color and value
                function createBadge(optionValue, row, index) {
                    return `<span class="badge badge-${row.status_color} text-bg-${row.status_color} rounded-3 py-2 fw-semibold d-inline-flex align-items-center gap-1">
            <i class="ti ti-circle fs-4"></i>${optionValue}
        </span>`;
                }

                // Adjust table height on window resize
                $(window).resize(function() {
                    $table.bootstrapTable('resetView', {
                        height: $(window).height()
                    });
                });
            });
        </script>
        {{-- 
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga')

        ga('create', 'UA-46172202-1', 'auto')
        ga('send', 'pageview')
    </script> --}}

</body>

</html>
