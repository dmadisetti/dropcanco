container = document.getElementById('container');
check = function() {
    xhr = new XMLHttpRequest();
    time = (new Date).getTime();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.response != null) {
                var frag = document.createDocumentFragment(),
                    tmp = document.createElement('body'),
                    child;
                tmp.innerHTML = xhr.response;
                while (child = tmp.firstChild)
                    frag.appendChild(child);
                container.insertBefore(frag, container.firstElementChild); // Now, append all elements at once
            }
            window.setTimeout(check, 5000 + time - (new Date).getTime());
        }
    }
    xhr.open('GET', '/new/', true);
    xhr.send();
}

window.setTimeout(check, 5000);