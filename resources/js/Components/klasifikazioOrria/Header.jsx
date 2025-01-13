import { useState } from 'react';
import '../../../css/klasifikazioOrria/header.css';
import '../../../css/header.css';

import plus from '../../../images/plus.png';
import Menua from '../../Components/basikoak/MenuDeplegablea';

function Header() {
  const [menuOpen, setMenuOpen] = useState(false);

  const toggleMenu = () => {
    setMenuOpen(!menuOpen);
  };

  return (
    <>
    <div className='dena'>
    
      <div className='header'>
        <p>FURY</p>
        <p className='f1'>F1 team </p>
      </div>
      <div className='plus'>
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
      </div>
    </>
  );
}

export default Header;