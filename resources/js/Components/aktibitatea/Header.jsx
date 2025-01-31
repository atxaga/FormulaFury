import { useState } from 'react';
import '../../../css/klasifikazioOrria/header.css';
import '@/../css/klasifikazioOrria/kodea.css';
import plus from '../../../images/plus.png';
import Menua from '../../Components/basikoak/MenuDeplegablea';
import { usePage } from '@inertiajs/react';

function Header({ liga }) {
  const [menuOpen, setMenuOpen] = useState(false);
  const [showModal, setShowModal] = useState(false);
  const { bezeroak } = usePage().props;

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
          
        </div>
        <div className={`sidebar ${menuOpen ? 'open' : ''}`}>
          
        </div>
        
      </div>
    </>
  );
}

export default Header;
