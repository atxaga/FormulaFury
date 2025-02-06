import React, { useState } from "react";
import '../../../css/ligasortu/ligasortu.css';
import { Inertia } from '@inertiajs/inertia'; 


function LigaSartu() {
  const [ligaKodea, setLigaKodea] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();

    const newLiga = {
      kodea: ligaKodea,
    };

    Inertia.post('/ligaSartu', newLiga, {
      onSuccess: () => {
        closeModal(); 
      },
    });

    setLigaKodea('');
  };

  return (
    <div className="liga-sortu-container">
      <form onSubmit={handleSubmit}>
        <h1 className="liga-sortu-title">Liga batean sartu</h1>

        <input
          type="text"
          className="liga-input"
          placeholder="Ligaren kodea"
          value={ligaKodea}
          onChange={(e) => setLigaKodea(e.target.value)}
        />
        <small className="liga-input-help-text">Sartu nahi dezun ligaren kodea. </small>

        <div className="botoia">
          <button type="submit" className="sortu"><p>Sartu</p></button>
        </div>
      </form>
    </div>
  );
}

export default LigaSartu;
