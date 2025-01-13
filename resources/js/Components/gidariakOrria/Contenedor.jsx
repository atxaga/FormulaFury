import { useState } from 'react';
import '../../../css/gidariaOrria/gidaria.css';
import '../../../css/gidariaOrria/contenedor.css';

import Footer from '@/Components/taldeaOrria/Footer';
import Header from '../../Components/gidariakOrria/Header';
import Gidaria from './Gidaria';
import signoEuro from '../../../images/euroTaldea.png';

function Contenedor(){
    return(
        <>
      <div className="main-gidaria">
        <Header />
        <div className='info'>
        <div className="plantilla">
            <div className="plantillaLetra">
              <p>PLANTILLA</p>
            </div>
            <div className="totala">
              <p className="text-white">5/5</p>
            </div>
          </div>
          <div className="lasterketa">
            <div className="lasterketaLetra">
              <p>LATERKETA</p>
            </div>
            <div className="eguna">
              <p className="text-white">IGA 5 , 20:00 </p>
            </div>
          </div>
          <div className="balorea">
            <div className="baloreaLetra">
              <p>BALOREA</p>
            </div>
            <div className="totalaBalorea">
              <p className="text-white">550.000.000</p>
              <img src={signoEuro} alt="" />
            </div>
          </div>
        </div>
        <Gidaria />
        </div>
      <Footer /> 
    </>
    );
}
export default Contenedor;