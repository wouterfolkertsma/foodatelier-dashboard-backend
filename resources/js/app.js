require('./bootstrap');
import UIkit from 'uikit'
import Icons from 'uikit/dist/js/uikit-icons';
import SearchBar from '../js/components/search-bar';
import DashboardDataManager from "./components/dashboard-data-manager";
import Swal from 'Sweetalert2';

import Chart from 'chart.js/dist/Chart';
window.Swal = Swal;
import jsAlerts from "../js/components/alerts";
window.jsAlerts = jsAlerts;
import FileUpload from "../js/components/file-upload";
let fileUpload = new FileUpload(UIkit);

new DashboardDataManager();
let searchBar = new SearchBar();

// loads the Icon plugin
UIkit.use(Icons);
