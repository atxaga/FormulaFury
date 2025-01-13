import 'bootstrap/dist/css/bootstrap.min.css';
import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import Header from '../../Components/basikoak/Header.jsx';
import Kontaktua from '../../Components/kontaktuOrria/KontaktuaForm.jsx';
import '../../../css/kontaktuaOrria/kontaktua.css';



function kontaktuaMain(){
return(
  <>
    <Header/>
    <Kontaktua/>
  </>
)
}
export default kontaktuaMain;
