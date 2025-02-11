import React, { useState, useEffect } from 'react';
import '../../../css/orriNagusia/nagusia.css';
import cascorojo from '../../../images/cascorojo.png';
import euro from '../../../images/euro.png';
import { Inertia } from '@inertiajs/inertia';
import 'bootstrap-icons/font/bootstrap-icons.css';
import Modal from '@/Components/Modal';
import SecondaryButton from '@/Components/SecondaryButton';
import DangerButton from '@/Components/DangerButton';

function Ligak({ ligak, bezeroa }) {
  const [ligas, setLigas] = useState(ligak);
  const [selectedLiga, setSelectedLiga] = useState(null);
  const [modalLigaId, setModalLigaId] = useState(null); // Guarda la liga que se quiere abandonar
  const [showModal, setShowModal] = useState(false); // Controla el estado del modal

  useEffect(() => {
    const savedLiga = localStorage.getItem('selectedLiga');
    if (savedLiga) {
      setSelectedLiga(savedLiga);
    }
  }, []);

  const abandonarLiga = (id) => {
    Inertia.post(`/abandonarliga/${id}`);
    setShowModal(false);
    window.location.reload();
  };

  const redirectKlasifikazioa = (id) => {
    setSelectedLiga(id);
    localStorage.setItem('selectedLiga', id);
    Inertia.get(`/setLiga/${id}`);
  };

  return (
    <>
      {ligas.map((liga) => (
        <div
          className={`blanco-liga ${selectedLiga == liga.id ? 'selected' : ''}`}
          key={liga.id}
          onClick={() => redirectKlasifikazioa(liga.id)}
        >
          <div className="ligak-info-ezker">
            <div className="team">
              <div className="team2">
                <img src={cascorojo} alt="Cascorrojo" />
                <h3>{liga.izena}</h3>
              </div>
              <p style={{ color: 'gray', marginLeft: '10%' }}>Partaideak: {liga.bezeroak_count}/10</p>
            </div>
          </div>
          <div className="ligak-info-eskubi">
            <div className="dirua">
              <div className="diruaDena">
                {/* ICONO PARA ABRIR MODAL */}
                <i
                  onClick={(e) => {
                    e.stopPropagation();
                    setModalLigaId(liga.id); // Guarda la liga seleccionada
                    setShowModal(true); // Muestra el modal
                  }}
                  className="bi bi-box-arrow-in-right"
                  style={{ cursor: 'pointer' }}
                ></i>
                <div className="dirua">
                  <h3>{liga.total_dirua}</h3>
                  <img src={euro} alt="Euro" />
                </div>
              </div>
            </div>
          </div>
        </div>
      ))}

      {/* MODAL DE CONFIRMACIÓN */}
      <Modal show={showModal} onClose={() => setShowModal(false)}>
        <form className="profilaHeader p-6">
          <h2 className="text-lg font-medium text-white">
            Zihur zaude liga utzi nahi duzula?
          </h2>
          <p className="mt-1 text-sm text-gray-600">
            Liga utzi egiten baduzu, kode bidez sartzen ahal zara.
          </p>
          <div className="mt-6 flex justify-end">
            <SecondaryButton onClick={() => setShowModal(false)}>
              Atzera
            </SecondaryButton>
            <DangerButton
              className="ms-3"
              onClick={() => abandonarLiga(modalLigaId)}
            >
              Liga utzi
            </DangerButton>
          </div>
        </form>
      </Modal>
    </>
  );
}

export default Ligak;
