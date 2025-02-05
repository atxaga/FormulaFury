import 'bootstrap/dist/css/bootstrap.min.css';
import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import LigaAdmin from '../../Components/adminpanel/ligak/LigaAdmin'
import '@/../css/merkatuaOrria/nagusia.css';

function adminMain(){
return(
  <>
    <LigaAdmin />
  </>
);
}
export default adminMain;
