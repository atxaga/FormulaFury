import { useState } from 'react';
import '../../../css/merkatuaOrria/header.css';
import '../../../css/header.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import Gidaria from '../bilatzailea/Gidaria';
import Menua from '@/Components/basikoak/MenuDeplegablea'

function Header({ guztiak  }) {
  const [searchTerm, setSearchTerm] = useState('');
  const [showSearchModal, setShowSearchModal] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);


  const toggleSearchModal = () => {
    setShowSearchModal(!showSearchModal);
  };
  const toggleMenu = () => {
    setMenuOpen(!menuOpen);
  };
  const filteredPilots = searchTerm
    ? guztiak.filter((pilot) => {
        if (!pilot.izena) {
          console.warn('El piloto no tiene un campo "izena":', pilot);
          return false;
        }
        return pilot.izena.toLowerCase().startsWith(searchTerm.toLowerCase());
      })
    : guztiak;

  return (
    <div className="cont">
      <div className="dena">
        <div className="header">
          <p>FURY</p>
          <p className="f1">F1 team</p>
        </div>

        <button className="hamburger" onClick={toggleMenu}>
          ☰
        </button>
        <div className="lupa" onClick={toggleSearchModal}>
          <i className="bi bi-search"></i>
        </div>
        <div className={`sidebar ${menuOpen ? 'open' : ''}`}>
         <button className="close-btn" onClick={toggleMenu}>
            ×
          </button>
          <Menua/>
        </div>
        {showSearchModal && (
  <>
    <div className="modal-overlay" onClick={toggleSearchModal}></div>

    <div className="search-modal">
      <h2>Gidariak</h2>
      <div className="search-bar">
        <input
          type="text"
          placeholder="Bilatu..."
          className="search-input"
          value={searchTerm}
          onChange={(e) => setSearchTerm(e.target.value)} 
        />
        <button className="close-search" onClick={toggleSearchModal}>
          ×
        </button>
      </div>

      <div className="search-results">
        {filteredPilots.length > 0 ? (
          filteredPilots.map((pilot) => (
            <Gidaria key={pilot.id} pilot={pilot} />
          ))
        ) : (
          <p>Ez daude izen hori duten gidaririk.</p>
        )}
      </div>
    </div>
  </>
)}

      </div>

      <div className="sekzioak">
        <div className="merkatuOr">
          <a href="merkatua">Merkatua</a>
        </div>
        <div className="nire-op">
          <a href="/nireoperazioak">Nire Op.</a>
        </div>
        <div className="historikoa">
          <a>Historikoa</a>
        </div>
      </div>
    </div>
  );
}

export default Header;
