import { useState } from 'react';
import '../../../css/merkatuaOrria/header.css';
import '../../../css/header.css';
import Menua from '../../Components/basikoak/MenuDeplegablea';
import 'bootstrap-icons/font/bootstrap-icons.css';

function Header() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [showSearch, setShowSearch] = useState(false);

  const toggleMenu = () => {
    setMenuOpen(!menuOpen);
  };

  const toggleSearch = () => {
    setShowSearch(!showSearch);
  };

  return (
    <div className="cont">
      <div className={`dena ${showSearch ? 'search-mode' : ''}`}>
        {showSearch ? (
          <div className="search-bar">
            <input
              type="text"
              placeholder="Bilatu..."
              className="search-input"
            />
            <button className="close-search" onClick={toggleSearch}>
              ×
            </button>
          </div>
        ) : (
          <>
            <div className="header">
              <p>FURY</p>
              <p className="f1">F1 team</p>
            </div>

            <button className="hamburger" onClick={toggleMenu}>
              ☰
            </button>
            <div className={`sidebar ${menuOpen ? 'open' : ''}`}>
              <button className="close-btn" onClick={toggleMenu}>
                ×
              </button>
              <Menua />
            </div>
            <div className="lupa" onClick={toggleSearch}>
              <i className="bi bi-search"></i>
            </div>
          </>
        )}
      </div>
      {!showSearch && (
        <div className="sekzioak">
          <div className="merkatuOr">
            <a href="merkatua">Merkatua</a>
          </div>
          <div className="nire-op">
            <a href='/nireoperazioak'>Nire Op.</a>
          </div>
          <div className="historikoa">
            <a>Historikoa</a>
          </div>
        </div>
      )}
    </div>
  );
}

export default Header;
