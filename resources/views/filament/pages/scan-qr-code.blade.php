<x-filament::page>
    {{-- <script src="node_modules/quagga/dist/quagga.min.js"></script> --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- <div id="camera-stream"></div> --}}
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/highlight.min.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
        crossorigin="anonymous"></script>
        <div id="hdn-msg" style="background: rgb(152, 240, 240); border-top:3px solid teal; color:rgb(4, 100, 100);" class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md hidden" role="alert">
            <div class="flex">
              <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
              <div>
                <p class="font-bold">Record Updated Successfully</p>
                <p class="text-sm">Make sure you know how these changes affect you.</p>
              </div>
            </div>
          </div>
    <div>

        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-11 ...">
                <div id="reader" style="display: block; margin:auto; width:100%;"></div>
            </div>
            <div class="...">
                <h1 id="conter-side" style="font-size:40px; font-weight:bold; text-align:center;">0</h1>
            </div>
          </div>


        <div style="display:block; margin:auto;" class="empty"></div>
        <div class="mt-4 mb-4" style="display:block; margin:auto;" id="scanned-result"></div>
        <h1 class="filament-header-heading text-1xl font-bold tracking-tight">Scan Results</h1>

        <div id="scanresults">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <div class="custom-error-msg hidden">
                                <div class="bg-red-100 rounded-lg py-5 px-6 text-base text-red-700 mb-3" role="alert">
                                    Something Went Wrong! Please try Again Later.
                                </div>
                            </div>
                            <table class="min-w-full">
                                <thead class="bg-white border-b">
                                    <tr>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Count
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Tender Title
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Contractor
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Format
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Procurement ID
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Verification Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="qr-scanned-tbody">
                                    {{-- <tr class="bg-white border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Strenthening of IT Department
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Bireno Associates
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            QR Code
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            1312345
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <svg class="text-success-500 h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function docReady(fn) {
            // see if DOM is already available
            if (document.readyState === "complete" || document.readyState === "interactive") {
                // call on next available tick
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }
        /** Ugly function to write the results to a table dynamically. */
        function printScanResultPretty(codeId, decodedText, decodedResult) {

            parsed = parseInt(decodedText);
            if (parsed) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $(
                                'meta[name="csrf-token"]')
                            .attr('content')
                    },
                    type: "POST",
                    url: '{{ route("filament.verifyqrcode") }}',
                    data: {
                        decoded_text: decodedText
                    },
                    beforeSend: function() {

                    },
                    complete: function() {

                    },
                    success: function(data) {
                        if (data['success'] == 'true') {


                            //$("#hdn-msg").show().delay(500).fadeOut();

                            $('#conter-side').html(codeId);
                            $('#qr-scanned-tbody').append('\
                                <tr class="bg-white border-b">\
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">' + codeId + '</td>\
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">\
                                        ' + data['tender_title'] + '\
                                    </td>\
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">\
                                        '+ data['contractor_name'] +'\
                                    </td>\
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">\
                                        ' + decodedResult.result.format.formatName + '\
                                    </td>\
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">\
                                        ' + decodedText + '\
                                    </td>\
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">\
                                        <svg class="text-success-500 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">\
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>\
                                        </svg>\
                                    </td>\
                                </tr>\
                            ');
                        } else {
                            $('.custom-error-msg').removeClass('hidden');
                        }
                    }
                });
            }

            /* let resultSection = document.getElementById('scanned-result');
            let tableBodyId = "scanned-result-table-body";
            if (!document.getElementById(tableBodyId)) {
                let table = document.createElement("table");
                table.className = "styled-table";
                table.style.width = "100%";
                resultSection.appendChild(table);
                let theader = document.createElement('thead');
                let trow = document.createElement('tr');
                let th1 = document.createElement('td');
                th1.innerText = "Count";
                let th2 = document.createElement('td');
                th2.innerText = "Tender Title";
                let th3 = document.createElement('td');
                th3.innerText = "Contractor";
                let th4 = document.createElement('td');
                th4.innerText = "Format";
                let th5 = document.createElement('td');
                th5.innerText = "Result";
                let th6 = document.createElement('td');
                th6.innerText = "Value";
                trow.appendChild(th1);
                trow.appendChild(th2);
                trow.appendChild(th3);
                trow.appendChild(th4);
                trow.appendChild(th5);
                trow.appendChild(th6);
                theader.appendChild(trow);
                table.appendChild(theader);
                let tbody = document.createElement("tbody");
                tbody.id = tableBodyId;
                table.appendChild(tbody);
            }
            let tbody = document.getElementById(tableBodyId);
            let trow = document.createElement('tr');
            let td1 = document.createElement('td');
            td1.innerText = `${codeId}`;
            let td2 = document.createElement('td');
            td2.innerText = 'Strenthening of IT Department GB';
            let td3 = document.createElement('td');
            td3.innerText = 'Bireno Associates';
            let td4 = document.createElement('td');
            td4.innerText = `${decodedResult.result.format.formatName}`;
            let td5 = document.createElement('td');
            td5.innerText = `${decodedText}`;
            let td6 = document.createElement('td');
            td6.append('<input type="text" name="contractor_procurement_id" value="' + `${codeId}` + '"/>');
            trow.appendChild(td1);
            trow.appendChild(td2);
            trow.appendChild(td3);
            trow.appendChild(td4);
            trow.appendChild(td5);
            trow.appendChild(td6);
            tbody.appendChild(trow); */
        }
        docReady(function() {
            hljs.initHighlightingOnLoad();
            var lastMessage;
            var codeId = 1;

            function onScanSuccess(decodedText, decodedResult) {
                /**
                 * If you following the code example of this page by looking at the
                 * source code of the demo page - good job!!
                 *
                 * Tip: update this function with a success callback of your choise.
                 */
                if (lastMessage !== decodedText) {
                    lastMessage = decodedText;
                    printScanResultPretty(codeId, decodedText, decodedResult);
                    ++codeId;
                }
            }
            var qrboxFunction = function(viewfinderWidth, viewfinderHeight) {
                // Square QR Box, with size = 80% of the min edge.
                var minEdgeSizeThreshold = 250;
                var edgeSizePercentage = 0.75;
                var minEdgeSize = (viewfinderWidth > viewfinderHeight) ?
                    viewfinderHeight : viewfinderWidth;
                var qrboxEdgeSize = Math.floor(minEdgeSize * edgeSizePercentage);
                if (qrboxEdgeSize < minEdgeSizeThreshold) {
                    if (minEdgeSize < minEdgeSizeThreshold) {
                        return {
                            width: minEdgeSize,
                            height: minEdgeSize
                        };
                    } else {
                        return {
                            width: minEdgeSizeThreshold,
                            height: minEdgeSizeThreshold
                        };
                    }
                }
                return {
                    width: qrboxEdgeSize,
                    height: qrboxEdgeSize
                };
            }
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: 250,
                    //qrbox: qrboxFunction,
                    // Important notice: this is experimental feature, use it at your
                    // own risk. See documentation in
                    // mebjas@/html5-qrcode/src/experimental-features.ts
                    experimentalFeatures: {
                        useBarCodeDetectorIfSupported: true
                    },
                    rememberLastUsedCamera: true,
                    showTorchButtonIfSupported: true
                });
            html5QrcodeScanner.render(onScanSuccess);
        });
    </script>

    <script type="text/javascript">
        /* function onScanSuccess(decodedText, decodedResult) {
                        console.log(`Code scanned = ${decodedText}`, decodedResult);
                    }
                    var html5QrcodeScanner = new Html5QrcodeScanner(
                        "qr-reader", { fps: 10, qrbox: 250 });
                    html5QrcodeScanner.render(onScanSuccess); */
    </script>
</x-filament::page>
