import './bootstrap';
/* import $ from 'jquery';
window.jQuery = window.$ = $; */

/* import Html5QrcodeScanner from 'html5-qrcode';

function onScanSuccess(decodedText, decodedResult) {
    console.log(`Code scanned = ${decodedText}`, decodedResult);
}
var html5QrcodeScanner = new Html5QrcodeScanner(
	"qr-reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess); */

/* import Quagga from 'quagga'; // ES6
//const Quagga = require('quagga').default;
Quagga.init({
    inputStream : {
        name : "Live",
        type : "LiveStream",
        target: document.querySelector('#camera-stream')
    },
    decoder : {
        readers : ["code_128_reader", "ean_reader", "upc_reader"]
    }
}, function(err) {
    if (err) {
        console.log(err);
        return;
    }
    Quagga.start();

    Quagga.onDetected(function(result) {
        // Implement your code here to handle the scanned QR code
        console.log(result.codeResult.code);
        Quagga.stop();
    });
});

Quagga.onDetected(function(result) {
    // Implement your code here to handle the scanned QR code
    console.log(result.codeResult.code);
    Quagga.stop();
}); */

/* Quagga.onDetected(function(result) {
    $.ajax({
        url: '{{ route("filament.checkbarcode") }}',
        method: 'POST',
        data: { code: result.codeResult.code }
    }).done(function(response) {
        console.log(response);
    });
}); */
