// module requires
const $ = require('jquery');
require('jquery-ui/ui/widgets/sortable');
require('jquery-ui/ui/widgets/draggable');
require('jquery-ui/ui/widgets/droppable');

const routes = require('../../../public/js/fos_js_routes.json');
import Routing from '../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

Routing.setRoutingData(routes);

// module imports
import 'bootstrap';
import 'popper.js';

// env setup
window.Routing = Routing;
global.$ = global.jQuery = $;
window.$ = $;
window.jQuery = jQuery;

// custom modules
import '../components/depth_chart';