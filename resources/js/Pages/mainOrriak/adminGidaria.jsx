import 'bootstrap/dist/css/bootstrap.min.css';
import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import GidariaAdmin from '../../Components/adminpanel/gidariak/GidariaAdmin'
import '@/../css/merkatuaOrria/nagusia.css';

function adminMain(){
return(
  <>
    <GidariaAdmin />
  </>
);
}
export default adminMain;
