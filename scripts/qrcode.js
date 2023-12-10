    const url = new URLSearchParams(window.location.search)
    const schedule_id = url.get('schedule_id')

    let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
    Instascan.Camera.getCameras().then(function(cameras){
        if(cameras.length > 0 ){
            scanner.start(cameras[0]);
        } else{
            alert('No cameras found');
        }
    }).catch(function(e) {
        console.error(e);
    });

    scanner.addListener('scan',function(c){
        document.getElementById('text').value = c;
        if(schedule_id){
            document.getElementById('form').submit();
        } else {
            var element = document.querySelector('#form');
            element.style.display = '';
        }
        return false;
    });

    function fetchRequest(file, formData) {
        fetch("http://api.qrserver.com/v1/read-qr-code/", {
            method: 'POST', body: formData
        }).then(res => {
            if (!res.ok) {
                throw new Error("Network response was not ok");
            }
            return res.json();
        })
        .then(result => {
            if (result && result.length > 0 && result[0].symbol && result[0].symbol.length > 0 && result[0].symbol[0].data) {
                const scannedData = result[0].symbol[0].data;
                document.getElementById('text').value = scannedData;
                if(schedule_id){
                    document.getElementById('form').submit();
                } else {
                    var element = document.querySelector('#form');
                    element.style.display = '';
                }
            } else {
                throw new Error("Invalid response format");
            }
        })
        .catch(error => {
            alert("Couldn't scan QR Code: " + error.message);
        });
    }

    const file = document.getElementById('file')
    const form = document.querySelector('form');
    file.addEventListener("change", async e => {
        let file = e.target.files[0];
        if(!file) return;
        let formData = new FormData();
        formData.append('file', file);
        fetchRequest(file, formData);
    });