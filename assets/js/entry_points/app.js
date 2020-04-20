// module requires
const $ = require('jquery');
require('jquery-ui/ui/widgets/sortable');

// module imports
import 'bootstrap';
import 'popper.js';

// env setup
global.$ = global.jQuery = $;
window.$ = $;
window.jQuery = jQuery;

// custom modules
import '../components/depth_chart';