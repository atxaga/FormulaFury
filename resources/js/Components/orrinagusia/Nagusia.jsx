import '../../../css/orriNagusia/nagusia.css';
import Liga from './Ligak';
import LigaSortu from '../LigaSortu/LigaSortu';
import { usePage } from '@inertiajs/react';
import { useState } from 'react';
import Modal from '@/Components/Modal';
import Footer from '../basikoak/Footer';

function Nagusia() {
  const { ligak = [] } = usePage().props;
  const [isModalOpen, setIsModalOpen] = useState(false);

  const openModal = () => setIsModalOpen(true);
  const closeModal = () => setIsModalOpen(false);

  return (
    <>
      <div className="container">
        <div className="ligak-kudeatu">
          <div className="sortu">
            <p>NIRE LIGAK</p>
            <button className="sortuLiga" onClick={openModal}>Liga sortu</button>
          </div>
          <a href="klasifikazioa">
            {ligak.length > 0 ? (
              <Liga ligak={ligak} />
            ) : (
              <p className='ez'>Ez zaude ezta liga batean sartuta</p>
            )}
          </a>
          <Footer />

        </div>

      </div>

      <Modal show={isModalOpen} onClose={closeModal} closeable={true}>
        <div className="modal-content">
          <LigaSortu />
          <button className="close-modal" onClick={closeModal}>X</button>
        </div>
      </Modal>

    </>
  );
}

export default Nagusia;
