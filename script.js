document.addEventListener('DOMContentLoaded', loadComuni);

function getXMLHttpRequest() {
        return new XMLHttpRequest();
}

function loadComuni() {
    var xmlHttpRequest = getXMLHttpRequest();
    xmlHttpRequest.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            if (this.status === 200) {
                var jsonData = JSON.parse(this.responseText);
                var postRequest = getXMLHttpRequest();
                postRequest.onreadystatechange = function() {
                    if (this.readyState === 4) {
                        if (this.status === 200) {
                            document.getElementById('combo').innerHTML = this.responseText;
                        } else {
                            console.error('POST failed: ' + this.status);
                        }
                    }
                };
                postRequest.open('POST', '/php/viewer/ComuniViewer.php', true);
                postRequest.setRequestHeader('Content-Type', 'application/json');
                postRequest.send(JSON.stringify(jsonData));
            } else {
                console.error('GET failed: ' + this.status);
            }
        }
    };
    xmlHttpRequest.open('GET', '/php/Comuni.php', true);
    xmlHttpRequest.send();
    document.getElementById('combo').addEventListener('change', loadContribuenti);
}

function loadContribuenti() {
    var comune = document.getElementById('comuni').value;
    if (comune === "-1")
    {
        document.getElementById('AjaxResponse').innerHTML = '<div id="AjaxResponse></div>';
        return;
    }

    var xmlHttpRequest = getXMLHttpRequest();
    xmlHttpRequest.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            if (this.status === 200) {
                var jsonData = JSON.parse(this.responseText);
                var postRequest = getXMLHttpRequest();
                postRequest.onreadystatechange = function() {
                    if (this.readyState === 4) {
                        if (this.status === 200) {
                            document.getElementById('AjaxResponse').innerHTML = this.responseText;
                        } else {
                            console.error('POST failed: ' + this.status);
                        }
                    }
                };
                postRequest.open('POST', '/php/viewer/ContribuentiViewer.php', true);
                postRequest.setRequestHeader('Content-Type', 'application/json');
                postRequest.send(JSON.stringify(jsonData));
            } else {
                console.error('GET failed: ' + this.status);
            }
        }
    };
    xmlHttpRequest.open('GET', `/php/Contribuenti.php?com_id=${encodeURIComponent(comune)}`, true);
    xmlHttpRequest.send();
}