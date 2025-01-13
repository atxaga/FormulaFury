import { useState } from 'react';
import '../../../css/merkatuaOrria/header.css';
import '../../../css/header.css';
import Menua from '../../Components/basikoak/MenuDeplegablea';
import 'bootstrap-icons/font/bootstrap-icons.css';
import { usePage } from '@inertiajs/react';
import Gidaria from './nireop/Gidaria';

function Header() {
  const { pilots = [] } = usePage().props;
  const [searchTerm, setSearchTerm] = useState('');
  const [showSearchModal, setShowSearchModal] = useState(false);

  // Filtra los pilotos por nombre basado en el término de búsqueda
  const filteredPilots = pilots.filter(pilot =>
    pilot.izena.toLowerCase().includes(searchTerm.toLowerCase())
  );

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

        {/* Modal de búsqueda */}
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
              {filteredPilots.length > 0 ? (
                filteredPilots.map((pilot) => (
                  <Gidaria key={pilot.id} pilot={pilot} />
                ))
              ) : (
                <p>No hay pilotos que coincidan con la búsqueda.</p>
              )}
            </div>
          </div>
        )}
      </div>

      {/* Las otras secciones del Header */}
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
