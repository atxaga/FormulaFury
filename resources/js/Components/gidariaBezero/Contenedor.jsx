import { useState } from 'react';
import '../../../css/gidariaOrria/contenedor.css';
import Footer from '@/Components/taldeaOrria/Footer';
import Header from './Header';
import Gidaria from './Gidaria';
import Taldea from './Taldea'; 
import signoEuro from '../../../images/euroTaldea.png';
import { usePage } from '@inertiajs/react';

function Contenedor() {
  const { gidariak = [] } = usePage().props;  
  const { taldeak = [] } = usePage().props; 
  const { ekipoBalorea } = usePage().props;  
  const { bezeroaDirua } = usePage().props;  
  const { liga } = usePage().props;  
  console.log(taldeak)

  return (
    <>
      <div className="main-gidaria">
        <Header liga={liga}/>
        <div className='info'>
          <div className="plantilla">
            <div className="plantillaLetra">
              <p>PLANTILLA</p>
            </div>
            <div className="totala">
              <p className="text-white">{gidariak.length + 1}/10</p>
            </div>
          </div>
          <div className="lasterketa">
            <div className="lasterketaLetra">
              <p>LATERKETA</p>
            </div>
            <div className="eguna">
              <p className="text-white">IGA 5 , 20:00</p>
            </div>
          </div>
          <div className="balor">
            <div className="baloreaLetra">
              <p>BALIOA</p>
            </div>
            <div className="totalaBalorea">
              <p className="text-white">{ekipoBalorea}</p>
              <img src={signoEuro} alt="Euro Signo" />
            </div>
          </div>
        </div>

        {gidariak.length > 0 ? (
          gidariak.map((gidaria, index) => (
            <Gidaria key={index} gidaria={gidaria} bezeroaDirua={bezeroaDirua} />
          ))
        ) : (
          null
        )}

{taldeak.length > 0 ? (
          taldeak.map((taldea, index) => (
            <Taldea key={index} taldea={taldea} bezeroaDirua={bezeroaDirua} />
          ))
        ) : (
          <p>Ez duzu gidaririk</p>  
        )}

      </div>
      <Footer />
    </>
  );
}

export default Contenedor;
