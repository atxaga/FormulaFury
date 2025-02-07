import { useState } from 'react';
import '@/../css/gidariaOrria/gidaria.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import { Inertia } from '@inertiajs/inertia';
import BezeroaEditatu from './BezeroaEditatu';
import Modal from '@/Components/Modal';
import usuario from '@/../images/perfil.png';

function Bezeroa({ bezeroa }) {
  
  const [isModalOpen, setIsModalOpen] = useState(false);

  const openModal = () => setIsModalOpen(true);
  const closeModal = () => setIsModalOpen(false);

  const handleDelete = (id) => {
    Inertia.post(`/deletebezeroa/${id}`);
    window.location.reload();
  };

  return (
    <>
      <div className="bezeroa-container">
        <div className="bezeroa-card">
          {/* Imagen y nombre */}
          <div className="bezeroa-header">
            <img src={usuario} alt="Usuario" className="bezeroa-avatar" />
            <p className="bezeroa-name">{bezeroa.izena}</p>
          </div>

          <div className="bezeroa-info">
            <p className="bezeroa-email"><i className="bi bi-envelope"></i> {bezeroa.email}</p>
            <p className="bezeroa-mota"><i className="bi bi-person-badge"></i> {bezeroa.mota}</p>
          </div>

          <div className="bezeroa-actions">
            <i onClick={() => handleDelete(bezeroa.id)} className="bi bi-trash delete-icon"></i>
            <i onClick={openModal} className="bi bi-pencil edit-icon"></i>
          </div>
        </div>
      </div>

      <Modal show={isModalOpen} onClose={closeModal} maxWidth="wider" closeable={true}>
        <div className="modal-content">
          <div className="create-content">
            <BezeroaEditatu bezeroaId={bezeroa.id} izena={bezeroa.izena} email={bezeroa.email} />
            <button className="close-modal" onClick={closeModal}>X</button>
          </div>
        </div>
      </Modal>
    </>
  );
}

export default Bezeroa;
