require('./bootstrap');
import UIkit from 'uikit'
import Icons from 'uikit/dist/js/uikit-icons';
import SearchBar from '../js/components/search-bar';
import TrendsValueChart from '../js/components/trends-charts';
import DashboardDataManager from "./components/dashboard-data-manager";
import Messenger from "./components/messenger";
import Swal from 'sweetalert2';

new Messenger();
import Chart from 'chart.js/dist/Chart';
window.Swal = Swal;
import jsAlerts from "../js/components/alerts";
window.jsAlerts = jsAlerts;
import FileUpload from "../js/components/file-upload";

new DashboardDataManager();
let searchBar = new SearchBar();
let fileUpload = new FileUpload(UIkit);
let trendsValueChart = new TrendsValueChart(Chart);

// loads the Icon plugin
UIkit.use(Icons);
