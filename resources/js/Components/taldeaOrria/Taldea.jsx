import { useState, useEffect } from 'react';
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

function Taldea() {
  const { translations, bezeroa, ligaIzena, gidariaF1 = [], gidariaF2 = [], taldeaIzena } = usePage().props;
  console.log(ligaIzena); 
  const [modalOpenF1, setModalOpenF1] = useState(false);
  const [modalOpenF2, setModalOpenF2] = useState(false);
  const [selectedDriverF1First, setSelectedDriverF1First] = useState(null); 
  const [selectedDriverF1Second, setSelectedDriverF1Second] = useState(null); 
  const [selectedDriverF2First, setSelectedDriverF2First] = useState(null); 
  const [selectedDriverF2Second, setSelectedDriverF2Second] = useState(null); 

  const storedPreviousLigaIzena = localStorage.getItem('previousLigaIzena');
  console.log('Lenoko liga izena: ' + ligaIzena);
  const [previousLigaIzena, setPreviousLigaIzena] = useState(storedPreviousLigaIzena || ligaIzena);

  useEffect(() => {
    const savedDriverF1First = JSON.parse(localStorage.getItem('selectedDriverF1First'));
    const savedDriverF1Second = JSON.parse(localStorage.getItem('selectedDriverF1Second'));
    const savedDriverF2First = JSON.parse(localStorage.getItem('selectedDriverF2First'));
    const savedDriverF2Second = JSON.parse(localStorage.getItem('selectedDriverF2Second'));

    if (savedDriverF1First) setSelectedDriverF1First(savedDriverF1First);
    if (savedDriverF1Second) setSelectedDriverF1Second(savedDriverF1Second);
    if (savedDriverF2First) setSelectedDriverF2First(savedDriverF2First);
    if (savedDriverF2Second) setSelectedDriverF2Second(savedDriverF2Second);
  }, []);

  useEffect(() => {
    if (ligaIzena !== previousLigaIzena) {
      localStorage.removeItem('selectedDriverF1First');
      localStorage.removeItem('selectedDriverF1Second');
      localStorage.removeItem('selectedDriverF2First');
      localStorage.removeItem('selectedDriverF2Second');

      setSelectedDriverF1First(null);
      setSelectedDriverF1Second(null);
      setSelectedDriverF2First(null);
      setSelectedDriverF2Second(null);

      setPreviousLigaIzena(ligaIzena);
    }
  }, [ligaIzena, previousLigaIzena]);

  const openModalF1 = () => setModalOpenF1(true);
  const closeModalF1 = () => setModalOpenF1(false);

  const openModalF2 = () => setModalOpenF2(true);
  const closeModalF2 = () => setModalOpenF2(false);

  const selectDriverF1First = (driver) => {
    setSelectedDriverF1First(driver);
    localStorage.setItem('selectedDriverF1First', JSON.stringify(driver));  // Guardar en localStorage
    closeModalF1();
  };

  const selectDriverF1Second = (driver) => {
    setSelectedDriverF1Second(driver);
    localStorage.setItem('selectedDriverF1Second', JSON.stringify(driver));  // Guardar en localStorage
    closeModalF1();
  };

  const selectDriverF2First = (driver) => {
    setSelectedDriverF2First(driver);
    localStorage.setItem('selectedDriverF2First', JSON.stringify(driver));  // Guardar en localStorage
    closeModalF2();
  };

  const selectDriverF2Second = (driver) => {
    setSelectedDriverF2Second(driver);
    localStorage.setItem('selectedDriverF2Second', JSON.stringify(driver));  // Guardar en localStorage
    closeModalF2();
  };
  localStorage.setItem('previousLigaIzena', ligaIzena);


  return (
    <>
      <div className="main-container">
        <Header bezeroa={bezeroa} liga={ligaIzena} />
        <div className="talde">
          <div className="plantilla">
            <div className="plantillaLetra">
              <p>{translations.taldea.plantilla}</p>
            </div>
            <div className="totala">
              <p className="text-white">4/5</p>
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
              <p className="text-white">560.000.000</p>
              <img src={euroTaldeaImg} alt="Euro Taldea" />
            </div>
          </div>
        </div>

        <div className="logoak">
          <div className="f1Class" onClick={openModalF1}>
            <img className="f1" src={f1Img} alt="F1" />
            <div className="gidariaDiv">
              <div className="foto">
                {selectedDriverF1First ? <img style={{ width: '80%', margin: 'auto' }} src={verstappen} /> : <img src={perfil} />}
              </div>
              <div className="datof1">
                <div className="izena">{selectedDriverF1First ? selectedDriverF1First.izena : ''}</div>
                <div className="egoera">
                  {selectedDriverF1First ? <img src={tick} alt="" /> : ''}
                </div>
              </div>
            </div>
            <div className="gidariaDiv">
              <div className="foto">
                {selectedDriverF1Second ? <img style={{ width: '80%', margin: 'auto' }} src={verstappen} /> : <img src={perfil} />}
              </div>
              <div className="datof1">
                <div className="izena">{selectedDriverF1Second ? selectedDriverF1Second.izena : ''}</div>
                <div className="egoera">
                  {selectedDriverF1Second ? <img src={tick} alt="" /> : ''}
                </div>
              </div>
            </div>
          </div>

          <Modal show={modalOpenF1} onClose={closeModalF1} maxWidth="wider" closeable={true}>
            <button style={{marginLeft: '10%'}} className="text-white close-modal" onClick={closeModalF1}>
              X
            </button>
            {gidariaF1.length > 0 ? (
              gidariaF1.map((gidari, index) => (
                <div
                  key={gidari.izena}
                  onClick={() => (index === 0 ? selectDriverF1First(gidari) : selectDriverF1Second(gidari))}
                  className="driver-option"
                >
                  <Gidaria gidaria={gidari} />
                </div>
              ))
            ) : (
              <p>Ez duzu gidaririk</p>
            )}
          </Modal>

          <div className="f2Class" onClick={openModalF2}>
            <img className="f2" src={f2Img} alt="F2" />
            <div className="gidariaDiv">
              <div className="foto">
                {selectedDriverF2First ? <img style={{ width: '80%', margin: 'auto' }} src={verstappen} /> : <img src={perfil} />}
              </div>
              <div className="datof1">
                <div className="izena">{selectedDriverF2First ? selectedDriverF2First.izena : ''}</div>
                <div className="egoera">
                  {selectedDriverF2First ? <img src={tick} alt="" /> : ''}
                </div>
              </div>
            </div>
            <div className="gidariaDiv">
              <div className="foto">
                {selectedDriverF2Second ? <img style={{ width: '80%', margin: 'auto' }} src={verstappen} /> : <img src={perfil} />}
              </div>
              <div className="datof1">
                <div className="izena">{selectedDriverF2Second ? selectedDriverF2Second.izena : ''}</div>
                <div className="egoera">
                  {selectedDriverF2Second ? <img src={tick} alt="" /> : ''}
                </div>
              </div>
            </div>
          </div>

          <Modal show={modalOpenF2} onClose={closeModalF2} maxWidth="wider" closeable={true}>
            <button style={{marginLeft: '10%'}} className="text-white close-modal" onClick={closeModalF2}>
              X
            </button>
            {gidariaF2.length > 0 ? (
              gidariaF2.map((gidari, index) => (
                <div
                  key={gidari.izena}
                  onClick={() => (index === 0 ? selectDriverF2First(gidari) : selectDriverF2Second(gidari))}
                  className="driver-option"
                >
                  <Gidaria gidaria={gidari} />
                </div>
              ))
            ) : (
              <p>Ez duzu gidaririk</p>
            )}
          </Modal>

          <div>
            {taldeaIzena ? (
              <div className="gidariaDiv" style={{ width: '20%' }}>
                <div className="escuderia">
                  <img src={ferrari} alt="" />
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
