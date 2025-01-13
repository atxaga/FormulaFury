import 'bootstrap/dist/css/bootstrap.min.css';
import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import Header from '../../Components/klasifikazioOrria/Header.jsx';
import Total from "../../Components/klasifikazioOrria/Total.jsx";
import Jokalaria from "../../Components/klasifikazioOrria/Jokalaria.jsx";


import '../../../css/klasifikazioOrria/header.css';
import '../../../css/klasifikazioOrria/jokalaria.css';
import '../../../css/orriNagusia/nagusia.css';

import Footer from '../../Components/klasifikazioOrria/Footer.jsx';




function klasifikazioaMain(){
return(
  <>
    <Header />
    <Total />
    <Jokalaria/>
    <Footer />
  </>
);
}
export default klasifikazioaMain;
