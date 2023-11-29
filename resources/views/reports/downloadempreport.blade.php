<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EMPLOYEE REPORT DOEC EMIS SYSTEM</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: 15px;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: 15px;
        }

        h1 {
            font-family: Verdana;
        }

        .gray {
            background-color: lightgray
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 0cm;
        }

        @page {
            size: {{ $page_size }} {{ $page_orientation }};
        }

        table.GeneratedTable {
            width: 100%;
            background-color: #ffffff;
            border-collapse: collapse;
            border-width: 1px;
            border-color: #000000;
            border-style: solid;
            color: #000000;
        }

        table.GeneratedTable td,
        table.GeneratedTable th {
            border-width: 1px;
            border-color: #000000;
            border-style: solid;
            padding: 3px;
        }

        table.GeneratedTable thead {
            background-color: #ffffff;
        }

        .page_break {
            page-break-before: always;
        }

        p {
            margin: 0px;
            padding: 3px;
        }

        .avoid-page-break-inside {
            page-break-inside: avoid;
        }
    </style>

</head>

<body>

    <table style="padding: 5px; width: 100%;">
        <tbody>
            <tr>
                <td style="">
                    <table style="width: 100%; border-collapse: collapse; border-style: none; padding: 5px;"
                        border="1">
                        <tbody>
                            <tr>
                                <td style="width: 20%; border-style: none; text-align: right;"><img src="img/ppra.jpeg"
                                        alt="" width="100" /></td>
                                <td style="width: 80%; border-style: none;">
                                    <h2 style="text-align: center;margin:0;padding:0">GILGIT BALTISTAN PUBLIC
                                        PROCUREMENT REGULATORY AUTHORITY</h2>
                                    <h2 style="text-align: center;margin:0;padding:0">GOVERNMENT OF GILGIT BALTISTAN
                                    </h2>

                                    <h2 style="text-align: center;margin:0;padding:0">FINANCE DEPARTMENT GB</h2>
                                    <h4 style="font-weight:normal;text-align: center;margin:0;padding:0">PROCUREMENTS
                                        MANAGEMENT INFORMATION SYSTEM (PMIS)</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    @if ($dept_procurements)
        <!-- BUILDING CAPACITY -->
        <!-- Black Heading -->
        <table style="width:100%;padding-bottom:10px;">
            <tbody>
                <tr>
                    <td>
                        <strong>
                            <p
                                style="padding-left:10px;text-align:left;width:100%;color:#ffffff;background-color:#000000;">
                                INVOICE DETAILS
                                @if(!empty($opening_date) && !empty($closing_date))
                                    FROM ({{ strtoupper($opening_date) }} TO {{ strtoupper($closing_date) }})
                                @endif

                                @if(!empty($opening_date) && empty($closing_date))
                                    ONWARDS ({{ strtoupper($opening_date) }})
                                @endif

                                @if(empty($opening_date) && !empty($closing_date))
                                    BEFORE ({{ strtoupper($closing_date) }})
                                @endif
                            </p>
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- End Black Heading -->
        <table style="border-collapse:collapse; padding-bottom:10px;" border="1" width="100%">
            <tbody>
                <tr>
                    <td style="background-color: #eeeef5">
                        <p><strong>SE #</strong></p>
                    </td>
                    <td style="background-color: #eeeef5">
                        <p><strong>DDO Code</strong></p>
                    </td>
                    <td style="background-color: #eeeef5">
                        <p><strong>TITLE</strong></p>
                    </td>
                    <td style="background-color: #eeeef5">
                        <p><strong>TYPE</strong></p>
                    </td>
                    <td style="background-color: #eeeef5">
                        <p><strong>OPENING DATE</strong></p>
                    </td>
                    <td style="background-color: #eeeef5">
                        <p><strong>CLOSING DATE</strong></p>
                    </td>
                    <td style="background-color: #eeeef5">
                        <p><strong>STATUS</strong></p>
                    </td>
                    <td style="background-color: #eeeef5">
                        <p><strong>AMOUNT</strong></p>
                    </td>
                </tr>
                @foreach ($dept_procurements as $procurement)
                    <tr>
                        <td>
                            <p>[TSE-{{ date('Ymd', strtotime($procurement->opening_date)).$procurement->id }}]</p>
                        </td>
                        <td>
                            <p>{{ $procurement->ddo_code }}</p>
                        </td>
                        <td>
                            <p>{{ $procurement->title }}</p>
                        </td>
                        <td>
                            <p>{{ $procurement->procurement->name }}</p>
                        </td>
                        <td>
                            <p>{{ date('d F, Y', strtotime($procurement->opening_date)) }}</p>
                        </td>
                        <td>
                            <p>{{ date('d F, Y', strtotime($procurement->closing_date)) }}</p>
                        </td>
                        <td>
                            <p>{{ $procurement->status == 0 ? 'Rejected' : ($procurement->status == 1 ? 'Approved' : ($procurement->status == 2 ? 'In Objection' : 'Waiting Approval')) }}</p>
                        </td>
                        <td>
                            <p>{{ $procurement->procurement->department_fee_amount }}</p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- End BUILDING CAPACITY -->
    @else
        <p style="text-align: center;">There is no any record to show.</p>
    @endif


    <footer>
        <p style="font-size:13px;text-align: center;">Powered By <a href="https://gbit.gov.pk">Inforation Technology Department, Gilgit Baltistan</a></p>
    </footer>

</body>

</html>
