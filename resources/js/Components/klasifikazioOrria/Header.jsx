import { useState } from 'react';
import '../../../css/klasifikazioOrria/header.css';
import '@/../css/klasifikazioOrria/kodea.css';
import plus from '../../../images/plus.png';
import Menua from '../../Components/basikoak/MenuDeplegablea';
import Modal from '@/Components/ModalKodea';
import Kodea from './Kodea';
import { usePage } from '@inertiajs/react';

function Header({ liga }) {
  const [menuOpen, setMenuOpen] = useState(false);
  const [showModal, setShowModal] = useState(false);
  const { bezeroak, bezeroa } = usePage().props;

  const toggleMenu = () => {
    setMenuOpen(!menuOpen);
  };
  const OpenModal = () => {
    setShowModal(true);
  };
  const CloseModal = () => {
    setShowModal(false);
  };

  return (
    <>
      <div className="dena">
        <div className="header-container">
          <button className="hamburger" onClick={toggleMenu}>
            ☰
          </button>
          <p className="f1">{liga.izena}</p>
          <div className="plus" onClick={OpenModal}>
            <img src={plus} alt="" />
          </div>
        </div>
        <div className={`sidebar ${menuOpen ? 'open' : ''}`}>
          <button className="close-btn" onClick={toggleMenu}>
            ×
          </button>
          <Menua bezeroa={bezeroak[0].izena} erabiltzailea={bezeroa} />
        </div>
        <Modal show={showModal} onClose={CloseModal} closeable={true}>
          <div className="modal-content" style={{backgroundColor:'black', margin:'auto'}}>
            <button onClick={CloseModal} className="close-modal text-white">
              X
            </button>
            <Kodea ligaId={liga} />
          </div>
        </Modal>
      </div>
    </>
  );
}

export default Header;
