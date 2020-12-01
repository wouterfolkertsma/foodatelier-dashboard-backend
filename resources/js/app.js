require('./bootstrap');
import UIkit from 'uikit'
import Icons from 'uikit/dist/js/uikit-icons';
import SearchBar from '../js/components/search-bar';
import Chart from 'chart.js/dist/Chart';

let searchBar = new SearchBar();

// loads the Icon plugin
UIkit.use(Icons);