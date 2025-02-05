import { useState } from 'react';
import '@/../css/gidariaOrria/gidaria.css';
import dispo  from '@/../images/tick.png';
import candadoRojo  from '@/../images/candadoRojo.png';
import f1  from '@/../images/f1.png';
import f2  from '@/../images/f2.png';
import 'bootstrap-icons/font/bootstrap-icons.css';

import verstappen  from '@/../images/verstappen.png';
import euro from '@/../images/euro.png';
import { usePage } from '@inertiajs/react';
import { Inertia } from '@inertiajs/inertia';
import GidariaComponent from '@/Components/gidariaInfo/gidaria'
import Modal from '@/Components/Modal';
import TaldeaEditatu from './TaldeaEditatu';




function Taldea({taldea}) {
  
  const { bezeroa } = usePage().props;
  const [showModal, setShowModal] = useState(false);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [modalContent, setModalContent] = useState(null);

  
  const openModal = () => setIsModalOpen(true);
  const closeModal = () => {
    setIsModalOpen(false);
    setModalContent(null); 
  };

  const handleOptionClick = (option) => {
    setModalContent(option);
  };
  const handledelete = (id) => {
        Inertia.post(`/deletetaldea/${id}`);
        window.location.reload();
    }
 

  return (
    <>
       <div className='main-gidari'>
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
          <p>{taldea.balioa}€</p>
        </div>
        
        
        </div>
        
        </div>
        <div className='puntuDiv'>
        <div className='buttons'>
        <i onClick={()=>handledelete(taldea.id)} class="basura bi bi-trash"></i>
        <i onClick={openModal}  class="lapiz bi bi-pencil"></i>
        </div>
        <div className='buttons'>
        
        </div>
        </div>
        
        
        </div>
        <Modal show={isModalOpen} onClose={closeModal}  maxWidth="wider" closeable={true}>
        <div className="modal-content">
          
            <div className="create-content">
              <TaldeaEditatu taldeaId= {taldea.id} izena = {taldea.izena} balioa = {taldea.balioa}/>
              <button className="close-modal" onClick={closeModal}>X</button>
            </div>
          
        </div>
      </Modal>
         
        
    </>
  );
}

export default Taldea;


