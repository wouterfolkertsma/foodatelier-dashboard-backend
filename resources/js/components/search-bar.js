export default class SearchBar {
    constructor() {
        this.input = document.getElementById("js-search-bar");
        this.table = document.getElementById("resultsTable");
        this.refreshInput = document.getElementById("js-refresh-search");
        this.noResultsAlert = document.getElementById("no-results-alert");
        this.tableForm = document.getElementById("tableForm");

        this.refreshInput.addEventListener('click', (e) => {
            this.refreshTable()
        });

        this.input.addEventListener('keyup', (e) => {
            this.searchTable(e);
        })
    }

    searchTable(e) {
        this.filterTable(e.target.value);
    }

    refreshTable() {
        this.input.value = '';
        this.filterTable('');
    }

    filterTable(value) {
        let tr = this.table.getElementsByTagName("tr"),
            count = 0;

        value = value.toLowerCase()

        for (let i = 0; i < tr.length; i++) {
            let td = tr[i].querySelector('[data-type="name"]');
            if (td) {
                let txtValue = td.textContent || td.innerText;

                if (txtValue.toLowerCase().indexOf(value) > -1) {
                    tr[i].style.display = "";
                    count++;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        if (count < 1) {
            this.noResultsAlert.style.display='block';
            this.tableForm.style.display='none';
        } else {
            this.noResultsAlert.style.display='none';
            this.tableForm.style.display='table';
        }
    }
}