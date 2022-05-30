import Navbar from "../modules/navbar";
import animations from "./animations";
import performance from "./performance";

// Setup default scripts
const setupScripts = () => {
  const navbar = new Navbar();

  navbar.init();
  animations.init();
  performance.init();
}

export default setupScripts;