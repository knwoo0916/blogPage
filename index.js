import $ from 'jquery';

import './style.css';
import './node_modules/bootstrap/dist/css/bootstrap.min.css'
import './node_modules/@fortawesome/fontawesome-free/js/all'
import App from './jsmodule/App';


$(function(){
    let app = new App();

    if(typeof msg !== "undefined"){
        app.makeToast(msg);
    }
});