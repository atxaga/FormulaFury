import { useState } from 'react';
import '../../../css/gidariaOrria/header.css';
import '../../../css/header.css';
import Menua from '../../Components/basikoak/MenuDeplegablea';


function Header({liga, bezeroa, erabiltzailea}) {
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
      
      <button className="hamburger" onClick={toggleMenu}>
            ☰
          </button>
          <div className={`sidebar ${menuOpen ? 'open' : ''}`}>
          <button className="close-btn" onClick={toggleMenu}>
            ×
          </button>
          <Menua bezeroa={bezeroa} erabiltzailea={erabiltzailea}/>
        </div>
        </div>
        <div className='sekzioak'>
        <div className='talde'>
          <a href='taldea' style={{ textDecoration: 'none', color: 'gray'}}><p>Taldea</p></a>
        </div>
        <div className='gidariak'>
          <a href='taldea' style={{ textDecoration: 'none', color: 'white'}}><p>Gidariak</p></a>
        </div>
        <div className='puntuak'>
          <a href='puntuak' style={{ textDecoration: 'none' ,color: 'gray'}}><p>Puntuak</p></a>
        </div>
        </div>
        
      </div>
      
    </>
  );
}

export default Header;
