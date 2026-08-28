import Alpine from 'alpinejs';
import { downloadMessageImage, shareMessageImage } from './message-share';

window.Alpine = Alpine;
window.downloadMessageImage = downloadMessageImage;
window.shareMessageImage = shareMessageImage;

Alpine.start();
