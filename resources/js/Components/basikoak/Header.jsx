import { useState } from 'react';
import { usePage } from '@inertiajs/react';
import '../../../css/header.css';
import logomainblancoImg from '../../../images/logomainblanco.png';
import Menua from './MenuDeplegablea';



function Header() {
  
  const { translations } = usePage().props;
  const [menuOpen, setMenuOpen] = useState(false);
  const toggleMenu = () => {
    setMenuOpen(!menuOpen);
  };
  const { bezeroa } = usePage().props;
  return (
    <>

      <div className="container text-center">
        <div className="header">
          <button className="hamburger" onClick={toggleMenu}>
            ☰
          </button>
          <div className="logo">
            <a href="/nagusia">
              <img src={logomainblancoImg} alt="Logo" />
            </a>
          </div>
        </div>

        {/* Barra lateral */}
        <div className={`sidebar ${menuOpen ? 'open' : ''}`}>
         <button className="close-btn" onClick={toggleMenu}>
            ×
          </button>
          <Menua bezeroa={bezeroa}/>
        </div>
        
      </div>
    </>
  );
}

export default Header;
