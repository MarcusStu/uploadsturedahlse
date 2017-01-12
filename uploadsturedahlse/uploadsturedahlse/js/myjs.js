// How many files input currently script..

/*
	By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License
*/

//'use strict';

//; (function ($, window, document, undefined) {
//    $('.inputfile').each(function () {
//        var $input = $(this),
//			$label = $input.next('label'),
//			labelVal = $label.html();

//        $input.on('change', function (e) {
//            var fileName = '';

//            if (this.files && this.files.length > 1)
//                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
//            else if (e.target.value)
//                fileName = e.target.value.split('\\').pop();

//            if (fileName)
//                $label.find('span').html(fileName);
//            else
//                $label.html(labelVal);
//        });

//        // Firefox bug fix
//        $input
//		.on('focus', function () { $input.addClass('has-focus'); })
//		.on('blur', function () { $input.removeClass('has-focus'); });
//    });
//})(jQuery, window, document);


// Copy Button Function
(function () {
    new Clipboard('#copy-button');
})();


// File Selector Function

$(function () {

    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function () {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    // We can watch for our custom `fileselect` event like this
    $(document).ready(function () {
        $(':file').on('fileselect', function (event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });
    });

});

// Browse Uploads Button, Toggle hide/show div content
$("#uploaded_files_list_div").hide();
$("#browse_uploads_btn").click(function () {
    $("#uploaded_files_list_div").toggle();
});

// Progress Bar AJAX

function _(el) {
    return document.getElementById(el);
}

function uploadFile() {
    var file = _("UploadFileField").files[0];
    //alert(file.name + " | " + file.size + " | " + file.type);
    var formdata = new FormData();
    formdata.append("UploadFileField", file);
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST", "file_upload_parser.php");
    ajax.send(formdata);
}

function progressHandler(event) {
    //_("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
    var percent = (event.loaded / event.total) * 100;
    _("progressBar").value = Math.round(percent);
    _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
}

function completeHandler(event) {
    _("status").innerHTML = event.target.responseText;
    _("progressBar").value = 0;
}

function errorHandler(event) {
    _("status").innerHTML = "Upload Failed";
}

function abortHandler(event) {
    _("status").innerHTML = "Upload Aborted";
}