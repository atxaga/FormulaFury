import { use, useState } from 'react';
import '../../../css/gidariaOrria/contenedor.css';

import Footer from '@/Components/taldeaOrria/Footer';
import Header from '../../Components/gidariakOrria/Header';
import Gidaria from './Gidaria';
import Taldea from './Taldea'; 
import signoEuro from '../../../images/euroTaldea.png';
import { usePage } from '@inertiajs/react';

function Contenedor() {
  const { gidariak = [] } = usePage().props;
  const { taldea = [] } = usePage().props; 
  const { ekipoBalorea } = usePage().props;
  const { liga } = usePage().props;
  const { bezeroa, erabiltzailea } = usePage().props;
  console.log(taldea);


  return (
    <>
      <div className="main-gidaria">
        <Header liga={liga} bezeroa={bezeroa} erabiltzailea={erabiltzailea}/>
        <div className='info'>
          <div className="plantilla">
            <div className="plantillaLetra">
              <p>PLANTILLA</p>
            </div>
            <div className="totala">
              <p className="text-white">{gidariak.length+taldea.length}/10</p>
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
          <div className="balor">
            <div className="baloreaLetra">
              <p>BALIOA</p>
            </div>
            <div className="totalaBalorea">
              <p className="text-white">{ekipoBalorea}</p>
              <img src={signoEuro} alt="" />
            </div>
          </div>
        </div>

        {gidariak.length > 0 ? (
          gidariak.map((gidaria) => (
            <Gidaria gidaria={gidaria} />
          ))
        ) : (
          null
        )}
      {taldea ? (
        taldea.map((talde) => (
          <Taldea talde={talde} />
        ))
      ) : (
      null
          )}

        
      </div>
      <Footer />
    </>
  );
}

export default Contenedor;
