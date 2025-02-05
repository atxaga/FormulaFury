import 'bootstrap/dist/css/bootstrap.min.css';
import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import TaldeaAdmin from '../../Components/adminpanel/taldeak/TaldeaAdmin'
import '@/../css/merkatuaOrria/nagusia.css';

function adminTaldea(){
return(
  <>
    <TaldeaAdmin />
  </>
);
}
export default adminTaldea;
