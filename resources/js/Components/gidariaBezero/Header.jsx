import { useState } from 'react';
import '../../../css/gidariaOrria/header.css';
import '../../../css/header.css';
import Menua from '../../Components/basikoak/MenuDeplegablea';


function Header({liga, erabiltzailea}) {
    const [menuOpen, setMenuOpen] = useState(false);

    const toggleMenu = () => {
      setMenuOpen(!menuOpen);
    };
  return (
    <>
    <div className='cont'>
    <div className='dena'>

      <div className='header'>
        <p className='f1'> {" " + liga.izena}</p>
      </div>
      <a href="/klasifikazioa">
      <button className="hamburger">
            Atzera
          </button>
          </a>
          <div className={`sidebar ${menuOpen ? 'open' : ''}`}>
          <button className="close-btn" onClick={toggleMenu}>
            ×
          </button>
        </div>
        </div>
        <div className='sekzioak'>
        
        <div className='gidariak'>
          <a href='taldea' style={{ textDecoration: 'none', color: 'white'}}><p>Gidariak</p></a>
        </div>
        
        </div>
        
      </div>
      
    </>
  );
}

export default Header;
