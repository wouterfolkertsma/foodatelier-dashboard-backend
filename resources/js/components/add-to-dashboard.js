export default class AddToDashboard {
    constructor() {
        this.addButtons = document.getElementsByClassName('js-add-to-dashboard');
        this.submitButton = document.getElementById('js-add-to-dashboard');
        this.currentType = '';
        this.currentId = '';

        if (this.addButtons && this.submitButton) {

            [...this.addButtons].forEach((button) => {
                console.log('HIEerrroooooooooo');

                button.addEventListener('click', (e) => {
                    this.currentType = button.getAttribute('data-type');
                    this.currentId = button.id;
                })
            })

            this.submitButton.addEventListener('click', (e) => {
                this.makeRequest();
            })
        }
    }

    makeRequest() {
        let dashboard = document.getElementById('dashboard');

        if (dashboard) {
            let dashBoardId = dashboard.value;
            let url = `/manage/${dashBoardId}/dashboards/${this.currentId}/add`;

            fetch(url)
                .then((response) => {
                    return response.json()
                }).then((response) => {
                if (response.success) {
                    jsAlertSuccessHTMLConfirm('Added to dashboard', "files" )
                }
            });
        }
    }
}