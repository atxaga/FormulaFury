import React, { useState } from "react";
import '@/../css/ligasortu/ligasortu.css';
import { Inertia } from '@inertiajs/inertia'; 

function BezeroaEditatu({ bezeroaId, izena, email }) {
  const [bezeroIzena, setBezeroIzena] = useState(izena);
  const [bezeroEmail, setBezeroEmail] = useState(email);
  
  console.log(email);
  const handleSubmit = (e) => {
    e.preventDefault();

    const newbezero = {
      id: bezeroaId,
      izena: bezeroIzena,
      email: bezeroEmail,
    };

    Inertia.post('/bezeroaeditatu', newbezero);
    window.location.reload();

    setBezeroIzena('');
    setBezeroEmail('');
  };

  return (
    <div className="liga-sortu-container">
      <form onSubmit={handleSubmit}>
        <h1 className="liga-sortu-title">Bezeroa Editatu</h1>

        <input
          type="text"
          className="liga-input"
          placeholder="bezeroaren izena"
          value={bezeroIzena}
          onChange={(e) => setBezeroIzena(e.target.value)} 
        />

        <input
          type="text"
          className="liga-textarea"
          placeholder="bezeroaren emaila"
          value={bezeroEmail}
          onChange={(e) => setBezeroEmail(e.target.value)}
        />

        <div className="botoia">
          <button type="submit" className="sortu"><p>Editatu</p></button>
        </div>
      </form>
    </div>
  );
}

export default BezeroaEditatu;
