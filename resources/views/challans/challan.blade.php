<!DOCTYPE html>
<html lang="en">
    <body>
        <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
            <tbody>
                <tr>
                    <td style="text-align:center; width:30%;font-size:20px;"><strong>Applicant Copy</strong></td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="text-align:center; width:30%;font-size:20px;"><strong>Department Copy</strong></td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="text-align:center; width:30%;font-size:20px;"><strong>Bank Copy</strong></td>
                </tr>
                <tr>
                    <td style="width:30%"><strong>Challan #</strong>: TS-PR{{ $procurement->id }}CR{{ $contractor->id }}</td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="width:30%"><strong>Challan #</strong>: TS-PR{{ $procurement->id }}CR{{ $contractor->id }}</td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="width:30%"><strong>Challan #</strong>: TS-PR{{ $procurement->id }}CR{{ $contractor->id }}</td>
                </tr>
                <tr>
                    <td style="width:30%"><strong>Due Date</strong>:&nbsp; {{ date('d-m-Y', strtotime($procurement->closing_date)) }}</td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="width:30%"><strong>Due Date</strong>:&nbsp; {{ date('d-m-Y', strtotime($procurement->closing_date)) }}</td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="width:30%"><strong>Due Date</strong>:&nbsp; {{ date('d-m-Y', strtotime($procurement->closing_date)) }}</td>
                </tr>
                <tr>
                    <td style="text-align:center; width:30%"><strong>Public Procurement Regulatory Authority Gilgit-Baltistan</strong><br />
                    Habib Bank Limited<br />
                    107 HBL Gilgit Branch<br />
                    PLS Account # <strong>1234567890</strong></td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="text-align:center; width:30%"><strong>Public Procurement Regulatory Authority Gilgit-Baltistan</strong><br />
                    Habib Bank Limited<br />
                    107 HBL Gilgit Branch<br />
                    PLS Account # <strong>1234567890</strong></td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="text-align:center; width:30%"><strong>Public Procurement Regulatory Authority Gilgit-Baltistan</strong><br />
                    Habib Bank Limited<br />
                    107 HBL Gilgit Branch<br />
                    PLS Account # <strong>1234567890</strong></td>
                </tr>
                <tr>
                    <td style="text-align:center; width:30%">&nbsp;</td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="text-align:center; width:30%">&nbsp;</td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="text-align:center; width:30%">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center; width:30%">
                    <table border="1" style="border-collapse: collapse;" cellpadding="1" cellspacing="1" style="width:100%">
                        <tbody>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;"><strong>Procurement ID</strong></td>
                                <td style="text-align:left;border:1px solid #000;">TSE-{{ $procurement->id }}</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;"><strong>Contractor/Firm Name</strong></td>
                                <td style="text-align:left;border:1px solid #000;">{{ $contractor->contractor_name }}</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;"><strong>Address</strong></td>
                                <td style="text-align:left;border:1px solid #000;">{{ $contractor->office_address }}</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;"><strong>Phone</strong></td>
                                <td style="text-align:left;border:1px solid #000;">{{ $contractor->phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="text-align:center; width:30%">
                    <table border="1" style="border-collapse: collapse;" cellpadding="1" cellspacing="1" style="width:100%">
                        <tbody>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;"><strong>Procurement ID</strong></td>
                                <td style="text-align:left;border:1px solid #000;">TSE-{{ $procurement->id }}</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;"><strong>Contractor/Firm Name</strong></td>
                                <td style="text-align:left;border:1px solid #000;">{{ $contractor->contractor_name }}</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;"><strong>Address</strong></td>
                                <td style="text-align:left;border:1px solid #000;">{{ $contractor->office_address }}</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;"><strong>Phone</strong></td>
                                <td style="text-align:left;border:1px solid #000;">{{ $contractor->phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="text-align:center; width:30%">
                    <table border="1" style="border-collapse: collapse;" cellpadding="1" cellspacing="1" style="width:100%">
                        <tbody>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;"><strong>Procurement ID</strong></td>
                                <td style="text-align:left;border:1px solid #000;">TSE-{{ $procurement->id }}</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;"><strong>Contractor/Firm Name</strong></td>
                                <td style="text-align:left;border:1px solid #000;">{{ $contractor->contractor_name }}</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;"><strong>Address</strong></td>
                                <td style="text-align:left;border:1px solid #000;">{{ $contractor->office_address }}</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;"><strong>Phone</strong></td>
                                <td style="text-align:left;border:1px solid #000;">{{ $contractor->phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
                <tr>
                    <td style="width:30%"><strong>Fee Particulars</strong></td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="width:30%"><strong>Fee Particulars</strong></td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="width:30%"><strong>Fee Particulars</strong></td>
                </tr>
                <tr>
                    <td style="text-align:center; width:30%">
                    <table border="1" style="border-collapse: collapse;" cellpadding="1" cellspacing="1" style="width:100%">
                        <tbody>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;">Total Amount</td>
                                <td style="text-align:left;border:1px solid #000;"><strong>{{ $procurement->procurement->contractor_fee_amount }}</strong></td>
                            </tr>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;">Amount in Words</td>
                                @php
                                    $see = new App\Models\ContractorProcurement;
                                @endphp
                                <td style="text-align:left;border:1px solid #000;"><strong>{{ $see->convert_number($procurement->procurement->contractor_fee_amount) }} Rupees Only.</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="text-align:center; width:30%">
                    <table border="1" style="border-collapse: collapse;" cellpadding="1" cellspacing="1" style="width:100%">
                        <tbody>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;">Total Amount</td>
                                <td style="text-align:left;border:1px solid #000;"><strong>{{ $procurement->procurement->contractor_fee_amount }}</strong></td>
                            </tr>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;">Amount in Words</td>
                                <td style="text-align:left;border:1px solid #000;"><strong>{{ $see->convert_number($procurement->procurement->contractor_fee_amount) }} Rupees Only.</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="text-align:center; width:30%">
                    <table border="1" cellpadding="1" cellspacing="1" style="width:100%">
                        <tbody>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;">Total Amount</td>
                                <td style="text-align:left;border:1px solid #000;"><strong>{{ $procurement->procurement->contractor_fee_amount }}</strong></td>
                            </tr>
                            <tr>
                                <td style="text-align:left;border:1px solid #000;">Amount in Words</td>
                                <td style="text-align:left;border:1px solid #000;"><strong>{{ $see->convert_number($procurement->procurement->contractor_fee_amount) }} Rupees Only.</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center; width:30%">&nbsp;</td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="text-align:center; width:30%">&nbsp;</td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="text-align:center; width:30%">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:30%">
                    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
                        <tbody>
                            <tr>
                                <td style="width:70%">
                                <p>Dear applicant please submit the above mentioned Fee in any branch of HBL</p>

                                <p>Once fee submitted you&#39;ll be placed in list of active contractors of PPRA.</p>
                                </td>

                                <td style="width:30%"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($contractor->id)) !!}"></td>
                            </tr>
                            <tr>
                                <td style="width:70%">_______________</td>
                                <td style="text-align:right; width:30%">______________</td>
                            </tr>
                            <tr>
                                <td style="width:70%">Depositor Sign</td>
                                <td style="text-align:right; width:30%">Cashier Sign</td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="width:30%">
                    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
                        <tbody>
                            <tr>
                                <td style="width:70%">
                                <p>Dear applicant please submit the above mentioned Fee in any branch of HBL</p>

                                <p>Once fee submitted you&#39;ll be placed in list of active contractors of PPRA.</p>
                                </td>
                                <td style="width:30%"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($contractor->id)) !!}"></td>
                            </tr>
                            <tr>
                                <td style="width:70%">_______________</td>
                                <td style="text-align:right; width:30%">______________</td>
                            </tr>
                            <tr>
                                <td style="width:70%">Depositor Sign</td>
                                <td style="text-align:right; width:30%">Cashier Sign</td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                    <td style="width:5%">&nbsp;</td>
                    <td style="width:30%">
                    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
                        <tbody>
                            <tr>
                                <td style="width:70%">
                                <p>Dear applicant please submit the above mentioned Fee in any branch of HBL</p>

                                <p>Once fee submitted you&#39;ll be placed in list of active contractors of PPRA.</p>
                                </td>
                                <td style="width:30%"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($contractor->id)) !!}"></td>
                            </tr>
                            <tr>
                                <td style="width:70%">_______________</td>
                                <td style="text-align:right; width:30%">______________</td>
                            </tr>
                            <tr>
                                <td style="width:70%">Depositor Sign</td>
                                <td style="text-align:right; width:30%">Cashier Sign</td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
