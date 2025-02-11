import { useState, useEffect } from 'react';
import '../../../css/merkatuaOrria/gidaria.css';
import '@/../css/gidariaOrria/gidaria.css';

import dispo from '../../../images/tick.png';
import f1 from '../../../images/f1.png';
import f2 from '../../../images/f2.png';
import verstappen from '@/../images/verstappen.png';
import Puja from './Puja';
import { Inertia } from '@inertiajs/inertia';
import Modal from '@/Components/Modal';
import PujaTaldea from './PujaTaldea';

function Taldea({ pujaGuztiak, taldea, bezeroaDirua }) {
  const [showModal, setShowModal] = useState(false);
  const [pujaRealizada, setPujaRealizada] = useState(null);
  const [actionOptionsVisible, setActionOptionsVisible] = useState(false);

  useEffect(() => {
    const pujaGuardada = JSON.parse(localStorage.getItem(`puja_${taldea?.id}`));
    if (pujaGuardada) {
      setPujaRealizada(pujaGuardada.puja);
    }
  }, [taldea]);

  const handleModalOpen = () => {
    setShowModal(true);
  };

  const handleModalClose = () => {
    setShowModal(false);
  };

  const handlePujaUpdate = (nuevaPuja) => {
    setPujaRealizada(nuevaPuja);
    localStorage.setItem(
      `puja_${taldea?.id}`,
      JSON.stringify({ puja: nuevaPuja })
    );
  };

  const handleActionOptionClick = (action) => {
    if (action === 'aldatu') {
      handleModalOpen();
      setActionOptionsVisible(false);
    } else if (action === 'ezabatu') {
      setActionOptionsVisible(false);
      setPujaRealizada(null);
      localStorage.removeItem(`puja_${taldea?.id}`);
      Inertia.post("/pujaezabatutaldea", { id: taldea.id });
      window.location.reload();
    }
  };

  const pujasDelPilot = pujaGuztiak.filter(puja => puja.taldea_id === taldea.id);

  return (
    <>
      <div className="main-gidari">
        <div className="datuak">
          <img src={taldea.foto} alt="" />
          <div className="gidariDatuak">
            <div className="usuario">
              <div className="taldeamota">
                <p>EQU</p>
              </div>
              <div className="usuarioIzena">
                <p className="text-white">{taldea.izena}</p>
              </div>
            </div>
            
          </div>
        </div>
        <div className="puntuDiv">
          <div className="gidariPuntuak">
            <p className="punto">PRFY</p>
            <p className="prfy">{taldea.puntuak}</p>
          </div>
          <div className="media">
            <p className="mediaP">Prezioa</p>
            <p className="mediaValor">{taldea.balioa}</p>
          </div>
          <div>
            {pujasDelPilot.length > 0 ? (
            <p style={{color: 'gray'}}>Pujak {pujasDelPilot.length}</p>

            ):(
              null
            )}

            {!pujaRealizada ? (
              <>
              <button className="fitxatu" onClick={handleModalOpen}>
                Fitxatu
              </button>
              </>
            ) : (
              <button
                className="fitxatu"
                onClick={() => setActionOptionsVisible(!actionOptionsVisible)}
              >
                Kudeatu
              </button>
            )}

            {actionOptionsVisible && (
              <div className="action-options">
                <button
                  className="option-button"
                  onClick={() => handleActionOptionClick('aldatu')}
                >
                  Puja aldatu
                </button>
                <button
                  className="option-button"
                  onClick={() => handleActionOptionClick('ezabatu')}
                >
                  Puja ezabatu
                </button>
              </div>
            )}
          </div>
        </div>
      </div>

      <Modal show={showModal} onClose={handleModalClose} closeable={true}>
        <div className="modal-content">
          <button onClick={handleModalClose} className="close-modal">
            X
          </button>
          <h2>{taldea.izena}</h2>
          <div className="pilot-photo">
            <img src={taldea.foto} alt="pilot" />
          </div>
          <PujaTaldea
            taldea={taldea}
            pujaInicial={pujaRealizada}
            bezeroDirua={bezeroaDirua}
            onPujaUpdate={handlePujaUpdate}
          />
        </div>
      </Modal>
    </>
  );
}

export default Taldea;
