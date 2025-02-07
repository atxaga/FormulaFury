import { useState } from 'react';
import '../../../css/merkatuaOrria/header.css';
import '../../../css/header.css';
import Menua from '../../Components/basikoak/MenuDeplegablea';
import 'bootstrap-icons/font/bootstrap-icons.css';
import { usePage } from '@inertiajs/react';
import Gidaria from '../merkatua/nireop/Gidaria';

function Header() {
  const { pilots = [] } = usePage().props;
  const [searchTerm, setSearchTerm] = useState('');
  const [showSearchModal, setShowSearchModal] = useState(false);


  const toggleSearchModal = () => {
    setShowSearchModal(!showSearchModal);
  };

  return (
    <div className="cont">
      <div className="dena">
        <div className="header">
          <p>FURY</p>
          <p className="f1">F1 team</p>
        </div>

        <button className="hamburger" onClick={toggleSearchModal}>
          ☰
        </button>

        {showSearchModal && (
          <div className="search-modal">
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
              {pilots.length > 0 ? (
                pilots.map((pilot) => (
                  <Gidaria key={pilot.id} pilot={pilot} />
                ))
              ) : (
                <p>No hay pilotos que coincidan con la búsqueda.</p>
              )}
            </div>
          </div>
        )}
      </div>

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
    </div>
  );
}

export default Header;
