    var c2cbtns = document.querySelectorAll('button');
    var clipboard = new Clipboard(c2cbtns);
    clipboard.on('success', function(e) {
        console.log(e);
    });
    clipboard.on('error', function(e) {
        console.log(e);
    });
