import '../../../css/orriNagusia/nagusia.css';
import Liga from './Ligak';
import LigaSortu from '../LigaSortu/LigaSortu';
import LigaSartu from '../LigaSortu/LigaSartu';
import { usePage } from '@inertiajs/react';
import { useState } from 'react';
import Modal from '@/Components/Modal';
import Footer from '../basikoak/Footer';
import aston from '@/../images/astonLiga.png'
import ferrari from '@/../images/ferrariLiga.png';
import Header from '../basikoak/Header';
import { Inertia } from '@inertiajs/inertia'; 


function Nagusia() {
  const { ligak = [] } = usePage().props;
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

  return (
    <>
      <Header/>
      <div className="container">
        <div className="ligak-kudeatu">
          <div className="sortu">
            <p>NIRE LIGAK</p>
            <button className="sortuLiga" onClick={openModal}>Liga sortu</button>
          </div>
            {ligak.length > 0 ? (
              <Liga ligak={ligak} />
            ) : (
              <p className='ez'>Ez zaude ezta liga batean sartuta</p>
            )}
          <Footer />
        </div>
      </div>

      <Modal show={isModalOpen} onClose={closeModal}  maxWidth="wider" closeable={true}>
        <div className="modal-content">
          {!modalContent ? (
            <div className="modal-options">
              <h1>FURY ligak</h1>
              <div onClick={()=>handleOptionClick('create')} className='create bg-white'>
              <div className='createText'>
              <div className='h3'>
              <h3 className='sortu'>Sortu </h3><h3>liga bat zure lagunekin jokatzeko</h3> 
              </div>
               <p className='text-sm'>Zure lagunak gonbidatu eta zuen artean lehiatu</p>
              </div>
              <div className='aston'>
                <img src={aston} alt="" />
              </div>
              </div>
              <div onClick={()=>handleOptionClick('join')} className='join bg-white'>
              <div className='joinText'>
              <div className='h3'>
              <h3 className='sartu'>Sartu</h3><h3>lagun baten liga batean</h3> 
              </div>
               <p className='text-sm'>Sartu zure lagun baten liga batean kode baten bitartez</p>
               </div>
               <div className='ferrari'>
                <img src={ferrari} alt="" />
              </div>
              </div>
              
              <button className="close-modal" onClick={closeModal}>X</button>
            </div>
          ) : modalContent === 'create' ? (
            <div className="create-content">
              <LigaSortu />
              <button className="text-white back-button" onClick={() => setModalContent(null)}>Atzera</button>
              <button className="close-modal" onClick={closeModal}>X</button>
            </div>
          ) : (
            <div className="join-content">
              <LigaSartu />
              <button className="text-white back-button" onClick={() => setModalContent(null)}>Atzera</button>
              <button className="close-modal" onClick={closeModal}>X</button>
            </div>
          )}
        </div>
      </Modal>
    </>
  );
}

export default Nagusia;
