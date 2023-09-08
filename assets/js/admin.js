require('../scss/admin.scss');

const $ = require('jquery');
global.$ = global.jQuery = $;
require('@coreui/coreui');
require('jquery');
require('jquery-ui');
require('jquery.iframe-transport');
require('bootstrap-datepicker');
require('bootstrap-datepicker/dist/locales/bootstrap-datepicker.hu.min');
require('symfony-collection/jquery.collection');
$('.sticky-notify').first().delay(6000).fadeOut();
require('../../public/bundles/fosckeditor/ckeditor');
import "../css/calendar.css";

$('.datepicker').datepicker({
    format: 'yyyy.mm.dd',
    weekStart: 1,
    language: 'hu'
});

