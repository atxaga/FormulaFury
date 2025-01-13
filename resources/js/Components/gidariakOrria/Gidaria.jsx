import { useState } from 'react';
import '../../../css/gidariaOrria/gidaria.css';
import dispo  from '../../../images/tick.png';
import candadoRojo  from '../../../images/candadoRojo.png';
import f1  from '../../../images/f1.png';
import verstappen  from '../../../images/verstappen.png';
import euro from '../../../images/euro.png';





function Gidaria() {
  return (
    <>
       <div className='main-gidari'>
        <div className='datuak'>
        <img src={verstappen} alt="" />
        <div className='gidariDatuak'>
        <div className='usuario'>
        <div className='mota'>
            <p>PIL</p>
        </div>
        <div className='usuarioIzena'>
        <p className='text-white'>MAX VERSTAPPEN</p>
        </div>
        </div>
        <div className='gidariEgoera'>
        <img src={dispo} alt="" />
        <p>Disponible</p>
        </div>
        <div className='gidariBalorea'>
          <img src={euro} alt="" />
          <p>70.238.410</p>
        </div>
        
        </div>
        
        </div>
        <div className='puntuDiv'>
        <div className='gidariPuntuak'>
          <p className='punto'>PRFY</p>
          <p className='prfy'>400</p>
        </div>
        <div className='media'>
          <p className='mediaP'>MEDIA</p>
          <p className='mediaValor'>0.00</p>
        </div>
        <div className='klausula'>
            <div className='candado'>
          <img src={candadoRojo} alt="" />
          </div>
          <p className='numeroPrecio'>14 egun</p>
        </div>
        </div>
        </div>
    </>
  );
}

export default Gidaria;


