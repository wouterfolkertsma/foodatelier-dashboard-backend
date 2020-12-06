import {toBoolean} from "uikit/src/js/util";

export default class DashboardDataManager {
    constructor() {
        this.addButtons = document.getElementsByClassName('js-dashboard-data-add');
        this.removeButtons = document.getElementsByClassName('js-dashboard-data-remove');
        this.addTable = document.getElementById('add-table');
        this.removeTable = document.getElementById('remove-table');

        if (this.addButtons && this.removeButtons) {
            [...this.addButtons].forEach((button) => {
               button.addEventListener('click', (e) => {
                   this.addDataToDashboard(e);
               })
            });

            [...this.removeButtons].forEach((button) => {
                button.addEventListener('click', (e) => {
                    this.removeDataFromDashboard(e);
                })
            });
        }
    }

    removeDataFromDashboard(e) {
        let node = e.target,
            data = node.getAttribute('data-id');

        fetch(window.location + `/${data}/remove`)
            .then((response) => {
                return response.json()
            }).then((response) => {
                if (response.success) {
                    this.swapRowToAddTable(node, data);
                }
            });
    }

    addDataToDashboard(e) {
        let node = e.target,
            data = node.getAttribute('data-id');

        fetch(window.location + `/${data}/add`)
        .then((response) => {
            return response.json()
        }).then((response) => {
            if (response.success) {
                this.swapRowToRemoveTable(node, data);
            }
        });
    }

    swapRowToAddTable(node, data) {
        let parent = node.closest("tr");
        parent.remove();
        node.insertAdjacentElement('beforebegin', this.createAddButton(data))
        node.remove();
        this.addTable.insertAdjacentElement('afterbegin', parent);
    }

    swapRowToRemoveTable(node, data) {
        let parent = node.closest("tr");
        parent.remove();
        node.insertAdjacentElement('beforebegin', this.createDeleteButton(data))
        node.remove();
        this.removeTable.insertAdjacentElement('afterbegin', parent);
    }

    createAddButton(dataId) {
        let button = document.createElement('button');

        button.className = 'uk-button uk-button-secondary js-dashboard-data-add';
        button.setAttribute('data-id', dataId);
        button.innerText = 'Add';
        button.addEventListener('click', (e) => {
            this.addDataToDashboard(e);
        })

        return button;
    }

    createDeleteButton(dataId) {
        let button = document.createElement('button');

        button.className = 'uk-button uk-button-primary js-dashboard-data-remove';
        button.setAttribute('data-id', dataId);
        button.innerText = 'Remove';
        button.addEventListener('click', (e) => {
            this.removeDataFromDashboard(e);
        })

        return button;
    }
}