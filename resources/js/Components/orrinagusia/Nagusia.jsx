import '../../../css/orriNagusia/nagusia.css';
import Liga from './Ligak';
import LigaSortu from '../LigaSortu/LigaSortu';
import { usePage } from '@inertiajs/react';
import { useState } from 'react'; 

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
        </div>
      </div>

      {isModalOpen && (
        <div className="modal-overlay">
          <div className="modal-content">
            <LigaSortu />
            <button className="close-modal" onClick={closeModal}>X</button>
          </div>
        </div>
      )}
    </>
  );
}

export default Nagusia;
