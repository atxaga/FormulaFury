import React, { useEffect, useState } from 'react';
import '@/../css/adminpanel/ligak/nagusia.css';
import cascorojo from '@/../images/cascorojo.png';
import trespuntos from '@/../images/trespuntos.png';
import euro from '@/../images/euro.png';
import { redirect } from 'react-router-dom';
import { Inertia } from '@inertiajs/inertia'; 
import 'bootstrap-icons/font/bootstrap-icons.css';
import LigaEditatu from './LigaEditatu';
import Modal from '@/Components/Modal';



function Liga({ liga, bezeroa }) {
  const [ligas, setLigas] = useState(liga);
  const [showRemoveInput, setShowRemoveInput] = useState(null);
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
      Inertia.post(`/destroyliga/${id}`);
      window.location.reload();
  }

  return (
    <>
        <div className="blanco-liga" key={liga.id}>
          <div className="ligak-info-ezker">
            <div className="team">
              <div className="team2">
                <img src={cascorojo} alt="Cascorrojo" />
                <h3>{liga.izena}</h3>
                
              </div>
             
          
              
            </div>
            
          </div>
          <div className='i'>
              <i onClick={()=>handledelete(liga.id)} class="basura bi bi-trash"></i>
              <i onClick={openModal} class="lapiz bi bi-pencil"></i>
              </div> 
        </div>
        <Modal show={isModalOpen} onClose={closeModal}  maxWidth="wider" closeable={true}>
        <div className="modal-content">
          
            <div className="create-content">
              <LigaEditatu ligaid= {liga.id} deskribapen = {liga.deskribapena} />
              <button className="close-modal" onClick={closeModal}>X</button>
            </div>
          
        </div>
      </Modal>
    </>
  );
}

export default Liga;
