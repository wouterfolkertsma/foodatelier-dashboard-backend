require('./bootstrap');
import UIkit from 'uikit'
import Icons from 'uikit/dist/js/uikit-icons';
import SearchBar from '../js/components/search-bar';
import TrendsValueChart from '../js/components/trends-charts';
import DashboardDataManager from "./components/dashboard-data-manager";
import Swal from 'sweetalert2';
import Chart from 'chart.js/dist/Chart';
import jsAlerts from "../js/components/alerts";
import FileUpload from "../js/components/file-upload";
import RssFeedUploader from '../js/components/rss-feed-manager'

window.Swal = Swal;
window.jsAlerts = jsAlerts;

new RssFeedUploader();
new DashboardDataManager();
let searchBar = new SearchBar();
let fileUpload = new FileUpload(UIkit);
let trendsValueChart = new TrendsValueChart(Chart);

// loads the Icon plugin
UIkit.use(Icons);
