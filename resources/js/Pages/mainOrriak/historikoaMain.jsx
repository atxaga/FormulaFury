import 'bootstrap/dist/css/bootstrap.min.css';
import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import Historikoa from '../../Components/merkatua/historikoa/Historikoa'
import '@/../css/merkatuaOrria/nagusia.css';

function historikoaMain(){
return(
  <>
    <Historikoa />
  </>
);
}
export default historikoaMain;
