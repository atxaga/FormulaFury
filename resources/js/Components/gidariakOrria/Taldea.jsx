import { useState } from 'react';
import '../../../css/gidariaOrria/gidaria.css';
import dispo  from '../../../images/tick.png';
import candadoRojo  from '../../../images/candadoRojo.png';
import f1  from '../../../images/f1.png';
import verstappen  from '../../../images/verstappen.png';
import euro from '../../../images/euro.png';
import { usePage } from '@inertiajs/react';
import Modal from '../Modal'
import TaldeaComponent from '@/Components/gidariaInfo/taldea'





function Taldea({taldea}) {
  const [showModal, setShowModal] = useState(false);

  const modalShow = ()=>{
    setShowModal(true);
}
const handleModalClose = ()=>{
  setShowModal(false)
}
  return (
    <>
       <div className='main-gidari' onClick={modalShow}>
        <div className='datuak'>
        <img src={taldea.foto} alt="" />
        <div className='gidariDatuak'>
        <div className='usuario'>
        <div className='taldeamota'>
            <p>EQU</p>
        </div>
        <div className='usuarioIzena'>
        <p className='text-white'>{taldea.izena}</p>
        </div>
        </div>
        <div className='gidariBalorea'>
          <img src={euro} alt="" />
          <p>{taldea.balioa}</p>
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
        
        </div>
        {showModal ? (
          <Modal show={showModal} onClose={handleModalClose} maxWidth='0.5' closeable={true}>
          
            <TaldeaComponent
              taldea={taldea}
            />
        </Modal>
        ):(
          null
        )}
        </div>
    </>
  );
}

export default Taldea;


