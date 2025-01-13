import { useState } from 'react';
import '../../../css/gidariaOrria/header.css';
import '../../../css/header.css';
import Menua from '../../Components/basikoak/MenuDeplegablea';


function Header() {
    const [menuOpen, setMenuOpen] = useState(false);

    const toggleMenu = () => {
      setMenuOpen(!menuOpen);
    };
  return (
    <>
    <div className='cont'>
    <div className='dena'>

      <div className='header'>
        <p>FURY</p>
        <p className='f1'>F1 team </p>
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
        <div className='sekzioak'>
        <div className='talde'>
            <a href='taldea'>Taldea</a>
        </div>
        <div className='gidariak'>
            <p>Gidariak</p>
        </div>
        <div className='puntuak'>
            <p>Puntuak</p>
        </div>
        </div>
        
      </div>
      
    </>
  );
}

export default Header;
