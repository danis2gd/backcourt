// module requires
const $ = require('jquery');
require('jquery-ui/ui/widgets/sortable');
require('jquery-ui/ui/widgets/draggable');
require('jquery-ui/ui/widgets/droppable');

import Routing from '../base/router';

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