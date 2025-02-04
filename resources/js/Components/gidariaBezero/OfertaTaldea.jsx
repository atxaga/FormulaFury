import { useState, useEffect } from 'react';
import '@/../css/merkatuaOrria/puja.css';
import euro from '@/../images/euro.png';
import { Inertia } from '@inertiajs/inertia';

function OfertaTaldea({ pilot, bezeroDirua }) {
  const [puja, setPuja] = useState( '');
  const [error, setError] = useState('');
  console.log(pilot);


    const handleSubmit = (e) => {
    e.preventDefault();

    setError('');
    const ofertaBerria = {
      oferta: puja,
      taldea_id: pilot.id,
    };
    console.log(bezeroDirua);

    if (puja < pilot?.balioa || puja > bezeroDirua) {
      setError('Puja ezin da izan.');
      return;
    }else{
      Inertia.post('/ofertataldea', ofertaBerria);

    }

    

    
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
          <p>Oferta</p>
          <input
            type="number"
            className="input-field"
            value={puja}
            onChange={(e) => setPuja(e.target.value)}
            required
          />
        </div>

        <button type="submit" className="button">
          Oferta
        </button>
      </form>

      <p className="saldo">Zure saldoa: {bezeroDirua}</p>
    </div>
  );
}

export default OfertaTaldea;
