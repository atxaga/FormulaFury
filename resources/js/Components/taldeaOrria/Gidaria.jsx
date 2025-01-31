import { useState } from 'react';
import '../../../css/taldeaOrria/gidariModal.css';
import dispo  from '../../../images/tick.png';
import candadoRojo  from '../../../images/candadoRojo.png';
import f1  from '../../../images/f1.png';
import f2  from '../../../images/f2.png';

import verstappen  from '../../../images/verstappen.png';
import euro from '../../../images/euro.png';
import { usePage } from '@inertiajs/react';


function Gidaria({gidaria}) {
  const { bezeroa } = usePage().props;
  return (
    <>
       <div className='main-gidari'>
        <div className='datuak'>
        <img src={gidaria.foto} alt="" />
        <div className='gidariDatuak'>
        <div className='usuario'>
        <div className='mota'>
            <p>PIL</p>
        </div>
        <div className='usuarioIzena'>
        <p className='text-white'>{gidaria.izena}</p>
        </div>
        </div>
        <div className='gidariEgoera'>
        <img src={dispo} alt="" />
        <p>{gidaria.disponibilitatea}</p>
        </div>
        <div className='gidariBalorea'>
          <img src={euro} alt="" />
          <p>{gidaria.balioa}</p>
        </div>
        <div className='kategoria'>
          {gidaria.kategoria == 'f1' ? (
            <img style={{textAlign: 'left'}} src={f1} alt="" />
          ):(
            <img className='f2' src={f2} alt="" />
          )}
        </div>
        
        </div>
        
        </div>
        <div className='puntuDiv'>
        <div className='gidariPuntuak'>
          <p className='punto'>PRFY</p>
          <p className='prfy'>{gidaria.puntuak}</p>
        </div>
        <div className='media'>
          <p className='mediaP'>MEDIA</p>
          <p className='mediaValor'>0.00</p>
        </div>
        
        </div>
        
        </div>
    </>
  );
}

export default Gidaria;


