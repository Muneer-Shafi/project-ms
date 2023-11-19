
// start the Stimulus application
import './bootstrap';
import './styles/styles/main.css'
import  './styles/font/font-icon.css'
// assets/app.js
import { registerReactControllerComponents } from '@symfony/ux-react';
import "@material/web/icon/icon.js";
import "@material/web/chips/chip-set";
import "@material/web/chips/filter-chip";
import "@material/web/button/elevated-button.js";
import "@material/web/button/filled-button.js";
import "@material/web/button/outlined-button.js";
import "@material/web/button/text-button.js";
import "@material/web/button/filled-tonal-button.js";



import "@material/web/menu/menu-item.js";
import "@material/web/menu/sub-menu.js";
import "@material/web/menu/menu.js";
import "@material/web/divider/divider.js";


import '@material/web/iconbutton/icon-button.js';
import '@material/web/tabs/tabs.js';
import '@material/web/tabs/primary-tab.js';
import '@material/web/tabs/secondary-tab.js';


import '@material/web/textfield/filled-text-field.js';
import '@material/web/textfield/outlined-text-field.js';



registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));