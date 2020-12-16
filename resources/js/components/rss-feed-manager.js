export default class RssFeedUploader {
    constructor(props) {
        this.previewButton = document.getElementById('js-preview-rss');
        this.previewExistingButtons = document.getElementsByClassName('js-preview-rss');
        this.previewContainer = document.getElementById('js-rss-preview-container');

        if (this.previewButton) {
            this.previewButton.addEventListener('click', (e) => {
                this.previewRssFeed(e);
            })
        }

        if (this.previewExistingButtons) {
            [...this.previewExistingButtons].forEach((button) => {
                button.addEventListener('click', (e) => {
                    this.previewExistingRssFeed(e);
                });
            });
        }
    }

    previewRssFeed(e) {
        let url = document.getElementById('url').value;
        fetch(`/manage/rss/preview?url=${url}`).then((response) => { return response.json() })
            .then((response) => {
                this.previewContainer.innerHTML = '';
                let htmlObject = document.createElement('div');
                htmlObject.innerHTML = response.html;
                htmlObject.classList.add('row', 'justify-content-between');
                this.previewContainer.insertAdjacentElement('afterbegin', htmlObject);
            })
    }

    previewExistingRssFeed(e) {
        let id = e.currentTarget.getAttribute('data-id');
        fetch(`/manage/rss/${id}/preview`).then((response) => { return response.json() })
            .then((response) => {
                this.previewContainer.innerHTML = '';
                let htmlObject = document.createElement('div');
                htmlObject.innerHTML = response.html;
                htmlObject.classList.add('row', 'justify-content-between');
                this.previewContainer.insertAdjacentElement('afterbegin', htmlObject);
            })
    }
}