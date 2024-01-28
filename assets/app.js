import { registerVueControllerComponents } from '@symfony/ux-vue';
import { registerSvelteControllerComponents } from '@symfony/ux-svelte';
import "./main.css";
import 'bootstrap'
import '../node_modules/bootstrap/dist/css/bootstrap.min.css'
import { registerReactControllerComponents } from '@symfony/ux-react';


registerReactControllerComponents(
  require.context("./react/controllers", true, /\.(j|t)sx?$/)
);

registerSvelteControllerComponents();
// registerVueControllerComponents();