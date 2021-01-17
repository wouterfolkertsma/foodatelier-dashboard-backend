require('./bootstrap');
import UIkit from 'uikit'
import Icons from 'uikit/dist/js/uikit-icons';
import SearchBar from '../js/components/search-bar';
import TrendsValueChart from '../js/components/trends-charts';
import DashboardDataManager from "./components/dashboard-data-manager";
import Messenger from "./components/messenger";
import Swal from 'sweetalert2';
import Chart from 'chart.js/dist/Chart';
import jsAlerts from "../js/components/alerts";
import FileUpload from "../js/components/file-upload";
import RssFeedUploader from '../js/components/rss-feed-manager'
import AddToDashboard from "./components/add-to-dashboard";

window.Swal = Swal;
window.jsAlerts = jsAlerts;

new Messenger();
new AddToDashboard();
new RssFeedUploader();
new DashboardDataManager();
new SearchBar();
new FileUpload(UIkit);
new TrendsValueChart(Chart);

// loads the Icon plugin
UIkit.use(Icons);
