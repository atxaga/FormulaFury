import 'bootstrap/dist/css/bootstrap.min.css';
import { StrictMode, useState } from 'react'
import { createRoot } from 'react-dom/client'
import Header from '../../Components/klasifikazioOrria/Header.jsx';
import Total from "../../Components/klasifikazioOrria/Total.jsx";
import Jokalaria from "../../Components/klasifikazioOrria/Jokalaria.jsx";

import Footer from '../../Components/klasifikazioOrria/Footer.jsx';
import { usePage } from '@inertiajs/react';




function klasifikazioaMain(){

  const { liga } = usePage().props;
  const { bezeroak = [] } = usePage().props; 
  const {bezeroa} = usePage().props;
  const [aukeratutakoLiga, setAukeratutakoLiga] = useState('');
  const { taldeaRoute } = usePage().props; 
 
return(
  <>
    <Header liga={liga} />
    <Total liga={liga} />
    <Jokalaria liga={liga} bezeroak={bezeroak} bezeroaCurrent={bezeroa}/>
    <Footer taldeaRoute={taldeaRoute}/>
  </>
);
}
export default klasifikazioaMain;
