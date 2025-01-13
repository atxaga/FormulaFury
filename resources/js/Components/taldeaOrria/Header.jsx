import '../../../css/taldeaOrria/header.css';
import '../../../css/header.css';
import Menua from '../../Components/basikoak/MenuDeplegablea';
import { useState } from 'react';
import { usePage } from '@inertiajs/react';

function Header() {
  const [menuOpen, setMenuOpen] = useState(false);

  const [locale, setLocale] = useState(document.documentElement.lang);
  const { translations } = usePage().props;
  const [dynamicTranslations, setDynamicTranslations] = useState(translations);
 
  console.log(translations);
 
  const toggleMenu = () => {
     setMenuOpen(!menuOpen);
  };
 
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
      <div className='cont'>
        <div className='dena'>
          <div className='header'>
            <p>FURY</p>
            <p className='f1'>F1 team </p>
          </div>

          <button className="hamburger" onClick={toggleMenu}>
            ☰
          </button>
          <div className={`sidebar ${menuOpen ? 'open' : ''}`}>
          <button className="close-btn" onClick={toggleMenu}>
            ×
          </button>
          
          <Menua/>
        </div>
        </div>
        <div className='sekzioak'>
          <div className='taldea'>
            <a href='taldea' style={{ textDecoration: 'none', color: 'white' }}><p>Taldea</p></a>
          </div>
          <div className='gidariak'>
            <a href='gidariak' style={{ textDecoration: 'none' }}><p>Gidariak</p></a>
          </div>
          <div className='puntuak'>
            <p>Puntuak</p>
          </div>
        </div>

      </div>

    </>
  );
}

export default Header;
