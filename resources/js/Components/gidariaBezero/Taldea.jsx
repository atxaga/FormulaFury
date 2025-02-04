import { useState } from 'react';
import '../../../css/gidariaBezero/gidaria.css';
import dispo  from '../../../images/tick.png';
import candadoRojo  from '../../../images/candadoRojo.png';
import f1  from '../../../images/f1.png';
import f2  from '../../../images/f2.png';

import verstappen  from '../../../images/verstappen.png';
import euro from '../../../images/euro.png';
import { usePage } from '@inertiajs/react';
import { Inertia } from '@inertiajs/inertia';
import Modal from '../Modal';
import Oferta from './Oferta'
import GidariaComponent from '@/Components/gidariaInfo/gidaria'
import Klausula from './Klausula';
import OfertaTaldea from './OfertaTaldea';




function Taldea({taldea, bezeroaDirua}) {
  
  const { bezeroa } = usePage().props;
  const [showModal, setShowModal] = useState(false);
  const [showModalKlausula, setShowModalKlausula] = useState(false);

  const klausulatu = (id) => {
    Inertia.post(`/klausulatutaldea/${id}`);
  };
  
  const modalShow = ()=>{
      setShowModal(true);
  }
  const handleModalClose = ()=>{
    setShowModal(false)
  }


  return (
    <>
       <div className='main-gidari'>
        <div className='datuak'>
        <img src={taldea.foto} alt="" />
        <div className='gidariDatuak'>
        <div className='usuario'>
        <div className='mota'>
            <p>PIL</p>
        </div>
        <div className='usuarioIzena'>
        <p className='text-white'>{taldea.izena}</p>
        </div>
        </div>
       
        <div className='gidariBalorea'>
          <img src={euro} alt="" />
          <p>{taldea.balioa}€</p>
        </div>
        
        
        </div>
        
        </div>
        <div className='puntuDiv'>
        <div className='gidariPuntuak'>
          <p className='punto'>PRFY</p>
          <p className='prfy'>{taldea.puntuak}</p>
        </div>
        <div className='media'>
          <p className='mediaP'>MEDIA</p>
          <p className='mediaValor'>0.00</p>
        </div>
        <div className='media'>
        <p className='mediaP'>KLAUSULA</p>
        <p className='mediaValor'>{taldea.taldea_clausula}€</p>        
        </div>
        <div className='buttons'>
        <input  onClick={() => modalShow()} type="button" value="Oferta" class="oferta" />
        <input  onClick={() => klausulatu(taldea.id)} type="button" value="Klausulazo" class="klausulazo" />
        </div>
        </div>
        
        
        </div>
        <Modal show={showModal} onClose={handleModalClose} closeable={true}>
        <div className="modal-content">
          <button onClick={handleModalClose} className="close-modal">
            X
          </button>
          <h2>{taldea.izena}</h2>
          <div className="pilot-photo">
            <img src={taldea.foto} alt="pilot" />
          </div>
          <OfertaTaldea
            pilot={taldea}
            bezeroDirua = {bezeroaDirua}
          />
        </div>
      </Modal>
        
    </>
  );
}

export default Taldea;


