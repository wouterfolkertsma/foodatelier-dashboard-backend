export default class FileUpload {
    constructor(UIkit) {
        var bar = document.getElementById('js-progressbar');
        var tokenElement = document.body.querySelector('meta[name="csrf-token"]');
        var token;
        var currentUploadedFiles;

        if (tokenElement) {
            token = tokenElement.content;
            console.log('uploader is ready');
        } else {
            //console.error('CSRF token not found!');
        }


        UIkit.upload('.js-upload', {

            url: '/manage/files/upload',
            multiple: true,

            beforeSend: function (environment) {
                console.log('beforeSend', arguments);

                environment.data.append('_token', token);
            },
            beforeAll: function () {
                console.log('beforeAll', arguments);
                currentUploadedFiles = '<div><br><ul class="uk-list uk-list-disc">'
            },
            load: function () {
                console.log('load', arguments);
            },
            error: function () {
                console.log('error', arguments);
            },
            complete: function (e) {
                let response = JSON.parse(e.response);
                console.log('complete', arguments);

                currentUploadedFiles = currentUploadedFiles.concat("<li>",response.file.name,"</li>");
            },

            loadStart: function (e) {
                console.log('loadStart', arguments);

                bar.removeAttribute('hidden');
                bar.max = e.total;
                bar.value = e.loaded;
            },

            progress: function (e) {
                console.log('progress', arguments);

                bar.max = e.total;
                bar.value = e.loaded;
            },

            loadEnd: function (e) {
                console.log('loadEnd', arguments);

                bar.max = e.total;
                bar.value = e.loaded;
            },

            completeAll: function (e) {
                let response = JSON.parse(e.response);

                console.log(response);
                let successMessage = "Upload Complete!"
                currentUploadedFiles = currentUploadedFiles.concat('</ul></div>');
                successMessage = successMessage.concat(currentUploadedFiles);

                if (response.success) {
                    jsAlertSuccessHTMLConfirm(successMessage, "files" )
                }else{
                    jsAlertError('something went wrong')
                }

                setTimeout(function () {
                    bar.setAttribute('hidden', 'hidden');
                }, 1000);

            }

        });
    }
}
