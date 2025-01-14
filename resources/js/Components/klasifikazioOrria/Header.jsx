import { useState } from 'react';
import '../../../css/klasifikazioOrria/header.css';
import '../../../css/header.css';
import '@/../css/klasifikazioOrria/kodea.css'
import plus from '../../../images/plus.png';
import Menua from '../../Components/basikoak/MenuDeplegablea';
import Modal from '@/Components/ModalKodea';
import Kodea from './Kodea';

function Header( { liga }) {
  const [menuOpen, setMenuOpen] = useState(false);
  const [showModal, setShowModal] = useState(false);

  const toggleMenu = () => {
    setMenuOpen(!menuOpen);
  };
  const OpenModal = () =>{
      setShowModal(true);
  }
  const CloseModal = () =>{
    setShowModal(false);
  }

  return (
    <>

    <div className='dena'>
    
      <div className='header'>
        <p>FURY</p>
        <p className='f1'>{liga.izena}</p>
      </div>
      <div className='plus' onClick={OpenModal}>
        <img src={plus} alt="" />
      </div>
      <button className="hamburger" onClick={toggleMenu}>
            ☰
          </button>
      <div className={`sidebar ${menuOpen ? 'open' : ''}`}>
          <button className="close-btn" onClick={toggleMenu}>
            ×
          </button>
          
          <Menua/>
        </div>
           <Modal show={showModal} onClose={CloseModal} closeable={true}>
           <div className="modal-content">
             <button onClick={CloseModal} className="close-modal">
               X
             </button>
             <Kodea ligaId = {liga} />
           </div>
         </Modal>
      </div>
    </>
  );
}

export default Header;