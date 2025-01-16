import 'bootstrap/dist/css/bootstrap.min.css';
import { StrictMode, useState } from 'react'
import { createRoot } from 'react-dom/client'
import Header from '../../Components/klasifikazioOrria/Header.jsx';
import Total from "../../Components/klasifikazioOrria/Total.jsx";
import Jokalaria from "../../Components/klasifikazioOrria/Jokalaria.jsx";


import '../../../css/klasifikazioOrria/header.css';
import '../../../css/klasifikazioOrria/jokalaria.css';
import '../../../css/orriNagusia/nagusia.css';

import Footer from '../../Components/basikoak/Footer.jsx';
import { usePage } from '@inertiajs/react';




function klasifikazioaMain(){

  const { liga } = usePage().props;
  const { bezeroak = [] } = usePage().props; 
  const [aukeratutakoLiga, setAukeratutakoLiga] = useState('');
  const { taldeaRoute } = usePage().props; 
 
return(
  <>
    <Header liga={liga} />
    <Total />
    <Jokalaria liga={liga} bezeroak={bezeroak}/>
    <Footer taldeaRoute={taldeaRoute}/>
  </>
);
}
export default klasifikazioaMain;
