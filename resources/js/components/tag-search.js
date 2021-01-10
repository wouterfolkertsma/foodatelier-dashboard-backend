export default class TagSearch {
    constructor(UIkit) {
        var tagContainer = document.body.querySelector('.tag-container');
        var tagInput = document.body.querySelector('.tag-container input');

        if (tagContainer) {
            console.log('tagSearch is ready');
        } else {
            //console.error('CSRF token not found!');
        }
    }
    createTag() {
        const div = document.createElement('div');
        div.setAttribute('class','tag')
        const span = document.createElement('span');
        span.innerHTML = label;
        const closeBtn = document.createElement('span');
        closeBtn.setAttribute('uk-icon', 'close');
        closeBtn.innerHTML = 'close';

        div.appendChild(span);
        div.appendChild(closeBtn);
        return div;
    }


}
