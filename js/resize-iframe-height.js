(function () {
    var iFrameID;

    /**
     * Set iframe's height based on its content's height
     */
    function iframeLoaded() {
        if (iFrameID) {
            iFrameID.height = '';
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + 'px';
        }
    }

    function onDocumentReady() {
        document.domain = 'vtldesign.dev'; // Fix cross-origin iframe issue
        iFrameID = document.getElementById('gform-iframe');

        iFrameID.onload = function() {
            iframeLoaded();
        };

    }

    document.addEventListener('DOMContentLoaded', function() {
        onDocumentReady();
    });

})();
