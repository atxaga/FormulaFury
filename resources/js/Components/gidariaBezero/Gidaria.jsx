import { useState } from 'react';
import '../../../css/gidariaOrria/gidaria.css';
import dispo  from '../../../images/tick.png';
import candadoRojo  from '../../../images/candadoRojo.png';
import f1  from '../../../images/f1.png';
import f2  from '../../../images/f2.png';

import verstappen  from '../../../images/verstappen.png';
import euro from '../../../images/euro.png';
import { usePage } from '@inertiajs/react';
import { Inertia } from '@inertiajs/inertia';
import Modal from '../Modal';
import GidariaComponent from '@/Components/gidariaInfo/gidaria'
import Klausula from './Klausula';




function Gidaria({gidaria}) {
  const { bezeroa } = usePage().props;
  const [showModal, setShowModal] = useState(false);
  const [showModalKlausula, setShowModalKlausula] = useState(false);

  const salduGidaria = (id) => {
    Inertia.post(`/saldu/${id}`);
  };
  
  const modalShow = ()=>{
      setShowModal(true);
  }
  const handleModalClose = ()=>{
    setShowModal(false)
  }
  const modalShowKlausula = ()=>{
    setShowModalKlausula(true);
}
const handleModalCloseKlausula = ()=>{
  setShowModalKlausula(false)
}

  return (
    <>
       <div className='main-gidari'>
        <div className='datuak' onClick={modalShow}>
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
          <p>{gidaria.balioa}€</p>
        </div>
        <div className='kategoria'>
          {gidaria.kategoria == 'f1' ? (
            <img src={f1} alt="" />
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
        <div className='media'>
        <p className='mediaP'>KLAUSULA</p>
        <p className='mediaValor'>{gidaria.gidaria_clausula}€</p>        
        </div>
        <div className='buttons'>
        <input  onClick={() => salduGidaria(gidaria.id)} type="button" value="Erosi" class="saldu" />
        </div>
        </div>
        
        
        </div>
        
    </>
  );
}

export default Gidaria;


