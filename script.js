document.addEventListener('DOMContentLoaded', loadComuni);

function loadComuni() {
    fetch('php/Comuni.php')
        .then(res => {
            if (!res.ok)
                throw new Error('GET failed: ' + res.status);
            return res.json();
        })
        .then(jsonData => {
            console.log("Data received:", jsonData);
            return fetch('php/viewer/ComuniViewer.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(jsonData)
            });
        })
        .then(res => {
            if (!res.ok)
                throw new Error('POST failed: ' + res.status);
            return res.text();
        })
        .then(html => {
            const target = document.getElementById('combo');
            if (target)
                target.innerHTML = html;
        })
        .catch(err => console.error('Error:', err));

    document.getElementById('combo').addEventListener('change', loadContribuenti);
}

function loadContribuenti() {
    var comune = document.getElementById('comuni').value;
    fetch(`php/Contribuenti.php?com_id=${encodeURIComponent(comune)}`)
        .then(res => {
            if (!res.ok)
                throw new Error('GET failed: ' + res.status);
            return res.json();
        })
        .then(jsonData => {
            return fetch('php/viewer/ContribuentiViewer.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(jsonData)
            });
        })
        .then(res => {
            if (!res.ok)
                throw new Error('POST failed: ' + res.status);
            return res.text();
        })
        .then(html => {
            document.getElementById('AjaxResponse').innerHTML = html;
        })
        .catch(err => console.error('Error:', err));
}