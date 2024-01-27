import "./main.css";
import 'bootstrap'
import '../node_modules/bootstrap/dist/css/bootstrap.min.css'


registerReactControllerComponents(
  require.context("./react/controllers", true, /\.(j|t)sx?$/)
);
