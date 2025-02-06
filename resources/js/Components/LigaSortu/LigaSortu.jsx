import React, { useState } from "react";
import '../../../css/ligasortu/ligasortu.css';
import { Inertia } from '@inertiajs/inertia'; 


function LigaSortu({closeModal}) {
  const [ligaIzena, setLigaIzena] = useState('');
  const [deskribapena, setDeskribapena] = useState('');
  const [klasulazo, setKlasulazo] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();

    const newLiga = {
      izena: ligaIzena,
      deskribapena,
      klasulazo, 
    };

    Inertia.post('/ligas', newLiga, {
      onSuccess: () => {
        closeModal(); 
      },
    });

    setLigaIzena('');
    setDeskribapena('');
    setKlasulazo(false);
  };

  return (
    <div className="liga-sortu-container">
      <form onSubmit={handleSubmit}>
        <h1 className="liga-sortu-title">Liga Sortu</h1>

        <input
          type="text"
          className="liga-input"
          placeholder="Ligaren izena"
          value={ligaIzena}
          onChange={(e) => setLigaIzena(e.target.value)}
        />
        <small className="liga-input-help-text">Minimo 5 karaktere. Maximo 30 karaktere</small>

        <textarea
          className="liga-textarea"
          placeholder="Deskribapena"
          value={deskribapena}
          onChange={(e) => setDeskribapena(e.target.value)}
        />
        <small className="liga-textarea-help-text">
          Deskribapena ez da beharrezkoa eta edozein momentuan editatzen ahal duzu.
        </small>

        {/* Sección de Klasulazo */}
        <div className="klasulazo-container">
          <div className="klasulazo-header">
            <p>Klasulazo</p>
            <label className="switch">
              <input 
                type="checkbox" 
                checked={klasulazo} 
                onChange={() => setKlasulazo(!klasulazo)} 
              />
              <span className="slider round"></span>
            </label>
          </div>
          <p className="klasulazo-description">
            Jokalarien artean gidariak edo taldeak fitxatzeko ahalbidea eman liga dibertigarroagoa ahal izateko.
          </p>
        </div>

        <div className="botoia">
          <button type="submit" className="sortu"><p>Sortu</p></button>
        </div>
      </form>
    </div>
  );
}

export default LigaSortu;
