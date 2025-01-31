import 'bootstrap/dist/css/bootstrap.min.css';
import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import Operazioak from '../../Components/merkatua/nireop/Operazioak'
import '@/../css/merkatuaOrria/nagusia.css';
import Ofertak from '@/Components/merkatua/nireop/Ofertak';

function ofertakMain(){
return(
  <>
    <Ofertak />
  </>
);
}
export default ofertakMain;
