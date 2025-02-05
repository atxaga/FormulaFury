import React, { useState } from "react";
import '@/../css/ligasortu/ligasortu.css';
import { Inertia } from '@inertiajs/inertia'; 


function LigaEditatu({ ligaid, deskribapen}) {
  const [ligaIzena, setLigaIzena] = useState('');
  const [deskribapena, setDeskribapena] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();

    const newLiga = {
      id: ligaid,
      izena: ligaIzena,
      deskribapena,
    };

    Inertia.post('/ligaeditatu', newLiga);

    setLigaIzena('');
    setDeskribapena('');
  };

  return (
    <div className="liga-sortu-container">
      <form onSubmit={handleSubmit}>
        <h1 className="liga-sortu-title">Liga Editatu</h1>

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

        

        <div className="botoia">
          <button type="submit" className="sortu"><p>Editatu</p></button>
        </div>
      </form>
    </div>
  );
}

export default LigaEditatu;
