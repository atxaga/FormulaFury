import { useState } from 'react';
import '@/../css/gidariaOrria/gidaria.css';
import dispo  from '@/../images/tick.png';
import candadoRojo  from '@/../images/candadoRojo.png';
import f1  from '@/../images/f1.png';
import f2  from '@/../images/f2.png';
import 'bootstrap-icons/font/bootstrap-icons.css';

  import verstappen  from '@/../images/verstappen.png';
import euro from '@/../images/euro.png';
import { usePage } from '@inertiajs/react';
import { Inertia } from '@inertiajs/inertia';
import GidariaEditatu from './GidariaEditatu';
import Modal from '@/Components/Modal';




function Gidaria({gidaria}) {
  console.log(gidaria);
  const { bezeroa } = usePage().props;
  const [showModal, setShowModal] = useState(false);
  const [showModalKlausula, setShowModalKlausula] = useState(false);
const [isModalOpen, setIsModalOpen] = useState(false);
  const [modalContent, setModalContent] = useState(null);

  
  const openModal = () => setIsModalOpen(true);
  const closeModal = () => {
    setIsModalOpen(false);
    setModalContent(null); 
  };

  const handleOptionClick = (option) => {
    setModalContent(option);
  };
  const handledelete = (id) => {
        Inertia.post(`/deletegidaria/${id}`);
        window.location.reload();
    }

  return (
    <>
       <div className='main-gidari'>
        <div className='datuak'>
        <img src={gidaria.foto} alt="" />
        <div className='gidariDatuak'>
        <div className='usuario'>
        <div className='mota'>
            <p>PIL</p>
        </div>
        <div className='usuarioIzena'>
        <p className='text-white'>{gidaria.izena}</p>
        </div>
        </div>
        <div className='gidariEgoera'>
        <img src={dispo} alt="" />
        <p>{gidaria.disponibilitatea}</p>
        </div>
        <div className='gidariBalorea'>
          <img src={euro} alt="" />
          <p>{gidaria.balioa}€</p>
        </div>
        <div className='kategoria'>
          {gidaria.kategoria == 'f1' ? (
            <img src={f1} alt="" />
          ):(
            <img className='f2' src={f2} alt="" />
          )}
        </div>
        
        </div>
        
        </div>
        <div className='puntuDiv'>
       
        
        <div className='buttons'>
        <i onClick={()=>handledelete(gidaria.id)} class="basura bi bi-trash"></i>
        <i onClick={openModal}  class="lapiz bi bi-pencil"></i>
        </div>
        </div>
       
        </div>
        <Modal show={isModalOpen} onClose={closeModal}  maxWidth="wider" closeable={true}>
        <div className="modal-content">
          
            <div className="create-content">
              <GidariaEditatu gidariaId= {gidaria.id} izena = {gidaria.izena} balioa = {gidaria.balioa}/>
              <button className="close-modal" onClick={closeModal}>X</button>
            </div>
          
        </div>
      </Modal>
       
        
    </>
  );
}

export default Gidaria;


