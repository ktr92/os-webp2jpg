
$( document ).ready(function() {
  var Promise = window.Promise;
    if (!Promise) {
        Promise = JSZip.external.Promise;
    }

    /**
     * Fetch the content and return the associated promise.
     * @param {String} url the url of the content to fetch.
     * @return {Promise} the promise containing the data.
     */
    function urlToPromise(url) {
        return new Promise(function(resolve, reject) {
            JSZipUtils.getBinaryContent(url, function (err, data) {
                if(err) {
                    reject(err);
                } else {
                    resolve(data);
                }
            });
        });
    }

    var $form = $(document).on('click', '.downloadAll', function () {



        var zip = new JSZip();

        // find every checked item
        $('.container').find("a.filelist__button").each(function () {
            var $this = $(this);
            var url = $this.attr("href");
            var filename = url.replace(/.*\//g, "");

            zip.file(filename, urlToPromise(url), {binary:true});
        });

        // when everything has been downloaded, we can trigger the dl
        zip.generateAsync({type:"blob"})
				.then(function(content) {
				    // see FileSaver.js
				    saveAs(content, "example.zip");
				});

        return false;
    });
});