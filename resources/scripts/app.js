import '../styles/app.scss';
import '@ungap/custom-elements';
import './js/global/components/huttopia-masonry';
import './js/global/components/diorama-slide.js';
import './js/global/components/ob-link';
import './js/global/components/menu';
import './js/global/components/form-send';
import './js/helpers/helpers';

import VideoAutostart from './js/global/video-autostart';
document.querySelectorAll('video.autostart, .video-lame.autostart').forEach(el => new VideoAutostart(el));

/*import './js/forms/forms';
import './js/forms/contact';*/


import Maps from './js/global/maps-page';

document.querySelectorAll('.map').forEach((el) => new Maps(el));
