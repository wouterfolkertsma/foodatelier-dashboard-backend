export default class FileUpload {
    constructor(UIkit) {
        var bar = document.getElementById('js-progressbar');
        var tokenElement = document.body.querySelector('meta[name="csrf-token"]');
        var token;

        if (tokenElement) {
            token = tokenElement.content;
        } else {
            console.error('CSRF token not found!');
        }
        console.log('token:' , token);
        console.log('uploader is ready');
        UIkit.upload('.js-upload', {

            url: '/manage/files/upload',
            multiple: false,


            beforeSend: function (environment) {
                console.log('beforeSend', arguments);

                environment.data.append('_token', token);
            },
            beforeAll: function () {
                console.log('beforeAll', arguments);
            },
            load: function () {
                console.log('load', arguments);
            },
            error: function () {
                console.log('error', arguments);
            },
            complete: function () {
                console.log('complete', arguments);
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

            completeAll: function () {
                console.log('completeAll', arguments);

                setTimeout(function () {
                    bar.setAttribute('hidden', 'hidden');
                }, 1000);


            }

        });
    }
}
