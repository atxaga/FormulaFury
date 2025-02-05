import React, { useState } from "react";
import '@/../css/ligasortu/ligasortu.css';
import { Inertia } from '@inertiajs/inertia'; 

function TaldeaEditatu({ taldeaId, izena, balioa }) {
  const [taldeaIzena, setTaldeIzena] = useState(izena);
  const [taldeaBalioa, setTaldeaBalioa] = useState(balioa);
  

  const handleSubmit = (e) => {
    e.preventDefault();

    const newLiga = {
      id: taldeaId,
      izena: taldeaIzena,
      balioa: taldeaBalioa,
      
    };

    console.log(newLiga);

    Inertia.post('/taldeaeditatu', newLiga);
    window.location.reload();

    setGidariIzena('');
    setGidariBalioa('');
  };

  return (
    <div className="liga-sortu-container">
      <form onSubmit={handleSubmit}>
        <h1 className="liga-sortu-title">Taldea Editatu</h1>

        <input
          type="text"
          className="liga-input"
          placeholder="Gidariaren izena"
          value={taldeaIzena}
          onChange={(e) => setTaldeIzena(e.target.value)} 
        />

        <input
          type="number"
          className="liga-textarea"
          placeholder="Balioa"
          value={taldeaBalioa}
          onChange={(e) => setTaldeaBalioa(e.target.value)}
        />

       

        <div className="botoia">
          <button type="submit" className="sortu"><p>Editatu</p></button>
        </div>
      </form>
    </div>
  );
}

export default TaldeaEditatu;
