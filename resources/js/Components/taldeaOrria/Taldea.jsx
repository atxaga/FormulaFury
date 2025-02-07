import React, { useState, useEffect } from 'react';
import '../../../css/taldeaOrria/taldea.css';
import F2gidaria from './F2gidaria';
import F2gidaria2 from './F2gidaria2';
import Footer from './Footer';
import Header from './Header';
import f1Img from '../../../images/f1.png';
import f2Img from '../../../images/f2.png';
import euroTaldeaImg from '../../../images/euroTaldea.png';
import { usePage } from '@inertiajs/react';
import Modal from './Modal';
import Gidaria from './Gidaria';
import perfil from '@/../images/perfilGidari.png';
import verstappen from '@/../images/verstappen.png';
import tick from '../../../images/tick.png';
import F1Taldea from './F1Ttaldea';
import ferrari from '../../../images/ferrari.png';
import plus from '../../../images/plusTaldea.png';
import { Inertia } from '@inertiajs/inertia'; 

const Taldea = () => {
  const { translations, bezeroa, ligaIzena, taldeaOsoa, gidariaF1 = [], gidariaF2 = [], taldeaIzena, ligaId, ekipoBalorea, erabiltzailea } = usePage().props;

  console.log(gidariaF1, gidariaF2);

  const selectedDriversF1 = gidariaF1.filter(driver => driver.aukeratuta);
  const selectedDriversF2 = gidariaF2.filter(driver => driver.aukeratuta);

  const [modalOpenF1, setModalOpenF1] = useState(false);
  const [modalOpenF2, setModalOpenF2] = useState(false);

  const [selectedDriverF1First, setSelectedDriverF1First] = useState(selectedDriversF1[0] || null);
  const [selectedDriverF1Second, setSelectedDriverF1Second] = useState(selectedDriversF1[1] || null);
  const [selectedDriverF2First, setSelectedDriverF2First] = useState(selectedDriversF2[0] || null);
  const [selectedDriverF2Second, setSelectedDriverF2Second] = useState(selectedDriversF2[1] || null);
  const [divF1, setDivF1] = useState(0);
  const [divF2, setDivF2] = useState(0);

  const openModalF1 = (aukeratuta) => {
    setModalOpenF1(true);
    setDivF1(aukeratuta);
    
  } 
  const closeModalF1 = () => setModalOpenF1(false);

  const openModalF2 = (aukeratuta) => {
    setModalOpenF2(true);
    setDivF2(aukeratuta)
  }
  const closeModalF2 = () => setModalOpenF2(false);

  const selectDriver = (driver, f1 = true) => {
    if (f1) {
      console.log(divF1);
      if (divF1 === 1) {
        
        if (!selectedDriverF1First || selectedDriverF1First.izena !== driver.izena) {
          setSelectedDriverF1First(driver);
        }
      } else {
        
        if (!selectedDriverF1Second || selectedDriverF1Second.izena !== driver.izena) {
          setSelectedDriverF1Second(driver);
        }
      }
    } else {
      if (divF2 === 1) {
       
        if (!selectedDriverF2First || selectedDriverF2First.izena !== driver.izena) {
          setSelectedDriverF2First(driver);
        }
      } else {
      
        if (!selectedDriverF2Second || selectedDriverF2Second.izena !== driver.izena) {
          setSelectedDriverF2Second(driver);
        }
      }
    }
    f1 ? closeModalF1() : closeModalF2();
  };

  function gordeGidariak() {
    const taldea = {
      gidaria1F1: selectedDriverF1First,
      gidaria2F1: selectedDriverF1Second,
      gidaria1F2: selectedDriverF2First,
      gidaria2F2: selectedDriverF2Second,
      ligaId: ligaId
    };
    console.log(taldea);
    Inertia.post('/plantilla', taldea);
  }

  return (
    <>
      <div className="main-container">
        <Header bezeroa={bezeroa} liga={ligaIzena} erabiltzailea={erabiltzailea}/>
        <div className="talde">
          <div className="plantilla">
            <div className="plantillaLetra">
              <p>{translations.taldea.plantilla}</p>
            </div>
            <div className="totala">
              <p className="text-white">{gidariaF1.length + gidariaF2.length + 1}/10</p>
            </div>
          </div>
          <div className="lasterketa">
            <div className="lasterketaLetra">
              <p>{translations.taldea.lasterketa}</p>
            </div>
            <div className="eguna">
              <p className="text-white">IGA 5 , 20:00</p>
            </div>
          </div>
          <div className="balorea">
            <div className="baloreaLetra">
              <p>{translations.taldea.balioa}</p>
            </div>
            <div className="totalaBalorea">
              <p className="text-white">{ekipoBalorea}</p>
              <img src={euroTaldeaImg} alt="Euro Taldea" />
            </div>
          </div>
          <button className='gorde' onClick={gordeGidariak}>Gorde</button>

        </div>

        <div className="logoak">
          <div className="f1Class" >
            <img className="f1" src={f1Img} alt="F1" />
            <div className="gidariaDiv" onClick={() => openModalF1(1)}>
              {selectedDriverF1First ? (
                <div className="foto">
                  <img style={{ width: '80%', margin: 'auto' }} src={selectedDriverF1First.foto} />
                </div>
              ) : (
                <div className="foto" style={{ padding: '50px' }}>
                  <img style={{ width: '30%', height: 'auto', margin: 'auto' }} src={plus} />
                </div>
              )}

              <div className="datof1">
                <div className="izena">{selectedDriverF1First ? selectedDriverF1First.izena : ''}</div>
                <div className="egoera">
                  {selectedDriverF1First ? <img src={tick} alt="" /> : ''}
                </div>
              </div>
            </div>
            <div className="gidariaDiv" onClick={() => openModalF1(2)}>
              {selectedDriverF1Second ? (
                <div className="foto">
                  <img style={{ width: '80%', margin: 'auto' }} src={selectedDriverF1Second.foto} />
                </div>
              ) : (
                <div className="foto" style={{ padding: '50px' }}>
                  <img style={{ width: '30%', height: 'auto', margin: 'auto' }} src={plus} />
                </div>
              )}
              <div className="datof1">
                <div className="izena">{selectedDriverF1Second ? selectedDriverF1Second.izena : ''}</div>
                <div className="egoera">
                  {selectedDriverF1Second ? <img src={tick} alt="" /> : ''}
                </div>
              </div>
            </div>
          </div>

          <Modal show={modalOpenF1} onClose={closeModalF1} maxWidth="wider" closeable={true}>
            <button style={{ marginLeft: '10%' }} className="text-white close-modal" onClick={closeModalF1}>X</button>
            {gidariaF1.length > 0 ? (
  gidariaF1
    .filter(gidari => !gidari.aukeratuta) 
    .map((gidari, index) => (
      <div
        key={gidari.izena}
        onClick={() => selectDriver(gidari, true)} 
        className="driver-option"
      >
        <Gidaria gidaria={gidari} />
      </div>
    ))
) : (
  <p>Ez duzu gidaririk</p>
)}

          </Modal>

          <div className="f2Class" >
            <img className="f2" src={f2Img} alt="F2" />
            <div className="gidariaDiv" onClick={() => openModalF2(1)}>
              {selectedDriverF2First ? (
                <div className="foto">
                  <img style={{ width: '80%', margin: 'auto' }} src={selectedDriverF2First.foto} />
                </div>
              ) : (
                <div className="foto" style={{ padding: '50px' }}>
                  <img style={{ width: '30%', height: 'auto', margin: 'auto' }} src={plus} />
                </div>
              )}
              <div className="datof1">
                <div className="izena">{selectedDriverF2First ? selectedDriverF2First.izena : ''}</div>
                <div className="egoera">
                  {selectedDriverF2First ? <img src={tick} alt="" /> : ''}
                </div>
              </div>
            </div>
            <div className="gidariaDiv" onClick={() => openModalF2(2)}>
              {selectedDriverF2Second ? (
                <div className="foto">
                  <img style={{ width: '80%', margin: 'auto' }} src={selectedDriverF2Second.foto} />
                </div>
              ) : (
                <div className="foto" style={{ padding: '50px' }}>
                  <img style={{ width: '30%', height: 'auto', margin: 'auto' }} src={plus} />
                </div>
              )}
              <div className="datof1">
                <div className="izena">{selectedDriverF2Second ? selectedDriverF2Second.izena : ''}</div>
                <div className="egoera">
                  {selectedDriverF2Second ? <img src={tick} alt="" /> : ''}
                </div>
              </div>
            </div>
          </div>

          <Modal show={modalOpenF2} onClose={closeModalF2} maxWidth="wider" closeable={true}>
            <button style={{ marginLeft: '10%' }} className="text-white close-modal" onClick={closeModalF2}>X</button>
            {gidariaF2.length > 0 ? (
              gidariaF2
                .filter(gidari => !gidari.aukeratuta) 
                .map((gidari, index) => (
                  <div
                    key={gidari.izena}
                    onClick={() => selectDriver(gidari, false)} 
                    className="driver-option"
                  >
                    <Gidaria gidaria={gidari} />
                  </div>
                ))
            ) : (
              <p>Ez duzu gidaririk</p>
            )}
          </Modal>

          <div className='f1taldea'>
            {taldeaIzena ? (
              <div className="gidariaDiv" style={{ width: '20%' }}>
                <div className="escuderia" style={{ padding: '5%' }}>
                  <img src={taldeaOsoa.foto} alt="" />
                </div>
                <div className="datof1">
                  <div className="izena">
                    <p>{taldeaIzena}</p>
                  </div>
                </div>
              </div>
            ) : (
              <p>Ez duzu talderik</p>
            )}
          </div>
        </div>
      </div>
      <Footer />
    </>
  );
}

export default Taldea;



