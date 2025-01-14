import { useState, useEffect } from 'react';
import '@/../css/merkatuaOrria/puja.css';
import euro from '@/../images/euro.png';
import { Inertia } from '@inertiajs/inertia';

function Puja({ pilot, pujaInicial, onPujaUpdate }) {
  const [puja, setPuja] = useState(pujaInicial || '');

  const handleSubmit = (e) => {
    e.preventDefault();

    const pujaBerria = {
      puja: puja,
      gidaria_id: pilot?.id,
    };

    Inertia.post('/pujatu', pujaBerria);

    onPujaUpdate(puja);
  };

  return (
    <div className="puja-container">
      <form onSubmit={handleSubmit}>
        <div className="balorea">
          <img src={euro} alt="" />
          <p className="puja-value">MERKATU BALOREA</p>
          <p>{pilot?.balioa}</p>
        </div>

        <div className="input-container">
          <p>Puja</p>
          <input
            type="number"
            className="input-field"
            value={puja}
            onChange={(e) => setPuja(e.target.value)}
            required
          />
        </div>

        <button type="submit" className="button">
          Pujatu
        </button>
      </form>

      <p className="saldo">Zure saldoa: -</p>
    </div>
  );
}

export default Puja;
