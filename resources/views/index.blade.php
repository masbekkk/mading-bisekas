<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Mading Biseka System</title>

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

    <!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/fresh-bootstrap-table" />

    <!--  Social tags    -->
    <meta name="keywords"
        content="creative tim, html table, html css table, web table, freebie, free bootstrap table, bootstrap, css3 table, bootstrap table, fresh bootstrap table, frontend, modern table, responsive bootstrap table, responsive bootstrap table">

    <meta name="description"
        content="Probably the most beautiful and complex bootstrap table you've ever seen on the internet, this bootstrap table is one of the essential plugins you will need.">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Fresh Bootstrap Table by Creative Tim">
    <meta itemprop="description"
        content="Probably the most beautiful and complex bootstrap table you've ever seen on the internet, this bootstrap table is one of the essential plugins you will need.">

    <meta itemprop="image"
        content="http://s3.amazonaws.com/creativetim_bucket/products/31/original/opt_fbt_thumbnail.jpg">
    <!-- Twitter Card data -->

    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Fresh Bootstrap Table by Creative Tim">

    <meta name="twitter:description"
        content="Probably the most beautiful and complex bootstrap table you've ever seen on the internet, this bootstrap table is one of the essential plugins you will need.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image"
        content="http://s3.amazonaws.com/creativetim_bucket/products/31/original/opt_fbt_thumbnail.jpg">
    <meta name="twitter:data1" content="Fresh Bootstrap Table by Creative Tim">
    <meta name="twitter:label1" content="Product Type">
    <meta name="twitter:data2" content="Free">
    <meta name="twitter:label2" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="Fresh Bootstrap Table by Creative Tim" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://wenzhixin.github.io/fresh-bootstrap-table/full-screen-table.html" />
    <meta property="og:image"
        content="http://s3.amazonaws.com/creativetim_bucket/products/31/original/opt_fbt_thumbnail.jpg" />
    <meta property="og:description"
        content="Probably the most beautiful and complex bootstrap table you've ever seen on the internet, this bootstrap table is one of the essential plugins you will need." />
    <meta property="og:site_name" content="Creative Tim" />


    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!--   Fonts and icons   -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.js"></script>

    <!--  Just for demo purpose, do not include in your project   -->
    <script src="assets/js/demo/gsdk-switch.js"></script>
    <script src="assets/js/demo/jquery.sharrre.js"></script>
    <script src="assets/js/demo/demo.js"></script>

    <style>
        /* html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        } */

        .full-screen-table {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .table {
            width: 100%;
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
            flex: 0 0 auto;
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
    </style>

</head>

<body>

    <div class="wrapper">
        <!--   Creative Tim Branding   -->
        <a href="http://creative-tim.com">
            <div class="logo-container full-screen-table-demo">
                <div class="logo">
                    <img src="https://bisekas.com/wp-content/uploads/2022/05/Logo_Biseka-removebg-preview.png"
                        width="60" height="60">
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
            <table id="fresh-table" class="table">
                <thead>
                    <th data-field="id">ID</th>
                    <th data-field="name" data-sortable="true">Project Owner</th>
                    <th data-field="salary" data-sortable="true">Work Location</th>
                    <th data-field="country" data-sortable="true">Type Of Work</th>
                    <th data-field="city">Status</th>
                    <th data-field="actions" data-events="operateEvents">Date</th>
                    <th data-field="actions" data-events="operateEvents">PIC</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Dakota Rice</td>
                        <td>$36,738</td>
                        <td>Niger</td>
                        <td><span class="badge badge-warning">Tagihan DP</span></td>
                        <td>15 Jul 2024</td>
                        <td>Teknisi</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Minerva Hooper</td>
                        <td>$23,789</td>
                        <td>Curaçao</td>
                        <td>Sinaai-Waas</td>
                        <td>15 Jul 2024</td>
                        <td>Teknisi</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Sage Rodriguez</td>
                        <td>$56,142</td>
                        <td>Netherlands</td>
                        <td>Baileux</td>
                        <td>15 Jul 2024</td>
                        <td>Teknisi</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Philip Chaney</td>
                        <td>$38,735</td>
                        <td>Korea, South</td>
                        <td>Overland Park</td>
                        <td>15 Jul 2024</td>
                        <td>Teknisi</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Doris Greene</td>
                        <td>$63,542</td>
                        <td>Malawi</td>
                        <td>Feldkirchen in Kärnten</td>
                        <td>15 Jul 2024</td>
                        <td>Teknisi</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    {{-- <div class="fixed-plugin" style="top: 300px">
        <div class="dropdown open">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
                <li class="header-title">Adjustments</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger">
                        <p>Full Background</p>
                        <div class="switch" data-on-label="ON" data-off-label="OFF">
                            <input type="checkbox" checked data-target="section-header" data-type="parallax" />
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger">
                        <p>Colors</p>
                        <div class="pull-right">
                            <span class="badge filter badge-blue" data-color="blue"></span>
                            <span class="badge filter badge-azure" data-color="azure"></span>
                            <span class="badge filter badge-green" data-color="green"></span>
                            <span class="badge filter badge-orange active" data-color="orange"></span>
                            <span class="badge filter badge-red" data-color="red"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="header-title">Layouts</li>
                <li>
                    <a class="img-holder" href="compact-table.html">
                        <img src="assets/img/compact.jpg">
                        <h5>Compact Table</h5>
                    </a>
                </li>
                <li class="active">
                    <a class="img-holder" href="full-screen-table.html">
                        <img src="assets/img/full.jpg">
                        <h5>Full Screen Table</h5>
                    </a>
                </li>
            </ul>
        </div>
    </div> --}}

    <script>
        var $table = $('#fresh-table')

        window.operateEvents = {
            'click .like': function(e, value, row, index) {
                alert('You click like icon, row: ' + JSON.stringify(row))
                console.log(value, row, index)
            },
            'click .edit': function(e, value, row, index) {
                alert('You click edit icon, row: ' + JSON.stringify(row))
                console.log(value, row, index)
            },
            'click .remove': function(e, value, row, index) {
                $table.bootstrapTable('remove', {
                    field: 'id',
                    values: [row.id]
                })
            }
        }

        function operateFormatter(value, row, index) {
            return [
                '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
                '<i class="fa fa-heart"></i>',
                '</a>',
                '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
                '<i class="fa fa-edit"></i>',
                '</a>',
                '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
                '<i class="fa fa-remove"></i>',
                '</a>'
            ].join('')
        }

        $(function() {
            $table.bootstrapTable({
                classes: 'table table-hover table-striped',
                toolbar: '.toolbar',

                search: true,
                showRefresh: true,
                showToggle: true,
                showColumns: true,
                // pagination: true,
                striped: true,
                sortable: true,
                height: $(window).height(),
                // pageSize: 25,
                // pageList: [25, 50, 100],

                // formatShowingRows: function(pageFrom, pageTo, totalRows) {
                //     return ''
                // },
                // formatRecordsPerPage: function(pageNumber) {
                //     return pageNumber + ' rows visible'
                // }
            })


            $(window).resize(function() {
                $table.bootstrapTable('resetView', {
                    height: $(window).height()
                })
            })
        })

        $('#sharrreTitle').sharrre({
            share: {
                twitter: true,
                facebook: true
            },
            template: '',
            enableHover: false,
            enableTracking: true,
            render: function(api, options) {
                $("#sharrreTitle").html('Thank you for ' + options.total + ' shares!')
            },
            enableTracking: true,
            url: location.href
        })

        $('#twitter').sharrre({
            share: {
                twitter: true
            },
            enableHover: false,
            enableTracking: true,
            buttons: {
                twitter: {
                    via: 'CreativeTim'
                }
            },
            click: function(api, options) {
                api.simulateClick()
                api.openPopup('twitter')
            },
            template: '<i class="fa fa-twitter"></i> {total}',
            url: location.href
        })

        $('#facebook').sharrre({
            share: {
                facebook: true
            },
            enableHover: false,
            enableTracking: true,
            click: function(api, options) {
                api.simulateClick()
                api.openPopup('facebook')
            },
            template: '<i class="fa fa-facebook-square"></i> {total}',
            url: location.href
        })
    </script>

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
    </script>

</body>

</html>
