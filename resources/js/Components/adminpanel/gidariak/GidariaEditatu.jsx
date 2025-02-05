import React, { useState } from "react";
import '@/../css/ligasortu/ligasortu.css';
import { Inertia } from '@inertiajs/inertia'; 

function GidariaEditatu({ gidariaId, izena, balioa }) {
  const [gidariIzena, setGidariIzena] = useState(izena);
  const [gidariBalioa, setGidariBalioa] = useState(balioa);
  const [gidariDisponibilitatea, setGidariDisponibilitatea] = useState(true);
  const [kategoria, setKategoria] = useState('f1');

  const handleSubmit = (e) => {
    e.preventDefault();

    const newLiga = {
      id: gidariaId,
      izena: gidariIzena,
      balioa: gidariBalioa,
      disponibilitatea: gidariDisponibilitatea,
      kategoria: kategoria
    };

    console.log(newLiga);

    Inertia.post('/gidariaeditatu', newLiga);
    window.location.reload();

    setGidariIzena('');
    setGidariBalioa('');
  };

  return (
    <div className="liga-sortu-container">
      <form onSubmit={handleSubmit}>
        <h1 className="liga-sortu-title">Gidaria Editatu</h1>

        <input
          type="text"
          className="liga-input"
          placeholder="Gidariaren izena"
          value={gidariIzena}
          onChange={(e) => setGidariIzena(e.target.value)} 
        />

        <input
          type="number"
          className="liga-textarea"
          placeholder="Balioa"
          value={gidariBalioa}
          onChange={(e) => setGidariBalioa(e.target.value)}
        />

        <div className="klasulazo-container">
          <div className="klasulazo-header">
            <p>Disponibilitatea</p>
            <label className="switch">
              <input 
                type="checkbox" 
                checked={gidariDisponibilitatea} 
                onChange={() => setGidariDisponibilitatea(!gidariDisponibilitatea)} 
              />
              <span className="slider round"></span>
            </label>
          </div>
        </div>

        <select className="mt-3 form-select bg-black text-white border-secondary" name="kategoria" onChange={(e) => setKategoria(e.target.value)} value={kategoria}>
          <option value="f1">F1</option>
          <option value="f2">F2</option>
        </select>

        <div className="botoia">
          <button type="submit" className="sortu"><p>Editatu</p></button>
        </div>
      </form>
    </div>
  );
}

export default GidariaEditatu;
