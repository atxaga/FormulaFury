import { useState, useEffect } from 'react';
import '@/../css/merkatuaOrria/gidaria.css';
import dispo from '@/../images/tick.png';
import f1 from '@/../images/f1.png';
import f2 from '@/../images/f2.png';
import verstappen from '@/../images/verstappen.png';
import Puja from '../Puja';
import { Inertia } from '@inertiajs/inertia';


function Gidaria({  pilot }) {
  const [showModal, setShowModal] = useState(false);
  const [pujaRealizada, setPujaRealizada] = useState(null);
  const [actionOptionsVisible, setActionOptionsVisible] = useState(false);

  useEffect(() => {
    const pujaGuardada = JSON.parse(localStorage.getItem(`puja_${pilot?.id}`));
    if (pujaGuardada) {
      setPujaRealizada(pujaGuardada.puja);
    }
  }, [pilot]);

  const handleModalOpen = () => {
    setShowModal(true);
  };

  const handleModalClose = () => {
    setShowModal(false);
  };

  const handlePujaUpdate = (nuevaPuja) => {
    setPujaRealizada(nuevaPuja);
    localStorage.setItem(
      `puja_${pilot?.id}`,
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
        localStorage.removeItem(`puja_${pilot?.id}`);
        Inertia.post("/pujaezabatu", { id: pilot.id });
        window.location.reload();

      }
};


  return (
    <>
      <div className="main-gidari">
        <div className="datuak">
          <img src={pilot.foto} alt="" />
          <div className="gidariDatuak">
            <div className="usuario">
              <div className="mota">
                <p>PIL</p>
              </div>
              <div className="usuarioIzena">
                <p className="text-white">{pilot.izena}</p>
              </div>
            </div>
            <div className="gidariEgoera">
              <img src={dispo} alt="" />
              <p>{pilot.disponibilitatea}</p>
            </div>
            <div className="gidariBalorea">
              {pilot.kategoria === 'f1' ? (
                <img className="kategoria" src={f1} alt="" />
              ) : (
                <img className="kategoria" src={f2} alt="" />
              )}
            </div>
          </div>
        </div>
        <div className="puntuDiv">
          <div className="gidariPuntuak">
            <p className="punto">PRFY</p>
            <p className="prfy">{pilot.puntuak}</p>
          </div>
          <div className="media">
            <p className="mediaP">Prezioa</p>
            <p className="mediaValor">
              {pilot.balioa}
            </p>
          </div>
          <div className='botoiak'>
            
              <button
                className="aldatu"
                onClick={() => handleActionOptionClick('aldatu')}
                >
                Aldatu
              </button>
              <button
                className="ezabatu"
                onClick={() => handleActionOptionClick('ezabatu')}
              >
                Ezabatu
              </button>
    

            
          </div>
        </div>
      </div>

      {showModal && (
        <div className="modal-overlay">
          <div className="modal-content">
            <button onClick={handleModalClose} className="close-modal">
              X
            </button>
            <h2>{pilot.izena}</h2>
            <div className="pilot-photo">
              <img src={pilot.foto} alt="pilot" />
            </div>
            <Puja
              pilot={pilot}
              pujaInicial={pujaRealizada}
              onPujaUpdate={handlePujaUpdate}
            />
          </div>
        </div>
      )}
    </>
  );
}

export default Gidaria;
