
// start the Stimulus application
import './bootstrap';
// assets/app.js
import { registerReactControllerComponents } from '@symfony/ux-react';

import "@material/web/button/filled-button.js";
import "@material/web/button/outlined-button.js";
import "@material/web/checkbox/checkbox.js";

registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));