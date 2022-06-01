<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
    </head>
    <body>
        <div style="width: 100vw;height: 100vh" id="reader"></div>

        <style>
            #reader__dashboard_section{
                display: none!important;
            }

            #reader > div > img {
                display: none!important;
            }

            body{
                margin: auto;
            }
        </style>

        <script type="text/javascript">

            var html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 1000, qrbox: 250 });

            function onScanSuccess(decodedText, decodedResult) {
                // Handle on success condition with the decoded text or result.
                console.log(`Scan result: ${decodedText}`, decodedResult);
                alert(decodedText);
                html5QrcodeScanner.clear();
            }

            function onScanError(errorMessage) {
                console.error(errorMessage);
            }

            html5QrcodeScanner.render(onScanSuccess);

            setTimeout(function (){
                const scannerRequest = document.getElementById('reader__camera_permission_button');
                if(scannerRequest){
                    scannerRequest.click();
                }
            }, 500)



        </script>
    </body>
</html>
