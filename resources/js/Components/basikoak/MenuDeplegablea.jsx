import React, { useState } from 'react';
import { usePage } from '@inertiajs/react';
import Modal from '../puntuakGehitu/Modal';
import PuntuakGehitu from '../puntuakGehitu/puntuakgehitu';
import '../../../css/header.css';
import perfilImg from '../../../images/perfil.png';
import casco2Img from '../../../images/casco2.png';
import rankingImg from '../../../images/plus.png';
import lasterketaImg from '../../../images/lasterketa.png';
import megafonoImg from '../../../images/megafono.png';
import maletinImg from '../../../images/maletin.png';
import bajakImg from '../../../images/bajak.png';
import perfilaImg from '../../../images/perfila.png';
import laguntzaImg from '../../../images/laguntza.png';
import terminosImg from '../../../images/terminos.png';
import logomainblancoImg from '../../../images/logomainblanco.png';
import instagram from '../../../images/insta.png';
import x from '../../../images/twitter.png';
import tiktok from '../../../images/tiktok.png';
import globeIcon from '../../../images/globe.png';
import admin from '../../../images/admin.png';

function Menua({bezeroa, erabiltzailea}) {
  const { translations } = usePage().props;
  const [locale, setLocale] = useState(document.documentElement.lang);
  const [dynamicTranslations, setDynamicTranslations] = useState(translations);

  const [showModal, setShowModal] = useState(false);

  const logOut = async (event) => {
    event.preventDefault();
    try {
      const response = await fetch('/logout', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
      });

      if (response.ok) {
        window.location.href = '/';
      } else {
        throw new Error('Error al cerrar sesión');
      }
    } catch (error) {
      console.error('Error al hacer logout:', error);
    }
  };

  const handleLanguageChange = async (event) => {
    const selectedLanguage = event.target.value;
    console.log('sartu da hizkuntza aldatu');
    try {
      const response = await fetch(`/set-locale/${selectedLanguage}`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
      });
  
      if (response.ok) {
        const data = await response.json();
        setLocale(selectedLanguage);     
        setDynamicTranslations(data);
        window.location.reload();    
      } else {
        console.error('Error al cambiar idioma. Código de respuesta:', response.status);
      }
    } catch (error) {
      console.error('Error cambiando el idioma:', error);
    }
  };

  return (
    <>
      {/* Barra lateral */}
      <div className="sidebar-header">
        <div className="language-select-wrapper">
          <select value={locale} onChange={handleLanguageChange} className="language-select">
            <option value="eu">Euskera</option>
            <option value="es">Español</option>
          </select>
          <img src={globeIcon} alt="Language Selector" className="globe-icon" />
        </div>
      </div>

      <ul>
        <div className="perfil">
          <img src={perfilImg} alt="Perfil" />
          <p>{bezeroa}</p>
        </div>
        <hr />
        <li>
          <img src={casco2Img} alt="Nire ligak" />
          <a href="nagusia"><p>{translations.header.nireligak}</p></a>
        </li>
        
        <li>
          <img src={lasterketaImg} alt="Lasterketak" />
          <p>{translations.header.lasterketak}</p>
        </li>
        <li>
          <img src={megafonoImg} alt="Albisteak" />
          <p>{translations.header.albisteak}</p>
        </li>
        <li>
          <img src={maletinImg} alt="Merkatua" />
          <p>{translations.header.merkatua}</p>
        </li>
        <li>
          <img src={bajakImg} alt="Bajak" />
          <p>{translations.header.bajak}</p>
        </li>
        <a href="/profile">
          <li>
            <img src={perfilaImg} alt="Profila" />
            <p>{translations.header.profila}</p>
          </li>
        </a>

        <li>
          <img src={laguntzaImg} alt="Laguntza" />
          <p>{translations.header.laguntza}</p>
        </li>
        <li>
          <img src={terminosImg} alt="Termino eta Kondizioak" />
          <p>{translations.header.terminoak}</p>
        </li>

          {erabiltzailea.mota === "admin" ? (
            <>
              <li>
              <img src={rankingImg} alt="Ranking" />
              <a href="#" onClick={() => setShowModal(true)}>
                <p>{translations.header.gehitu}</p>
              </a>
              </li>
              <li>
              <img src={admin} alt="Ranking" />
              <a href="/adminpanel">
                <p>Admin panela</p>
              </a>
              </li>

            </>
          ) : (
            <>
              null
            </>
          )}
        <div className="logout-section">
          <form onSubmit={logOut}>
            <button type="submit" className="logout-button">
              {translations.header.sesioaitxi}
            </button>
          </form>
        </div>
        <li className="redes">
          <img src={instagram} alt="Instagram" />
          <img src={x} alt="x" />
          <img src={tiktok} alt="tiktok" />
        </li> 
        <li className="copyright">
          <p>© FormulaFury</p>  
        </li>   
      </ul>

      <Modal show={showModal} onClose={() => setShowModal(false)}>
        <h2>{translations.header.gehitu} Puntuak</h2>
          <PuntuakGehitu/>
      </Modal>
    </>
  );
}

export default Menua;
