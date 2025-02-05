import { useState, useEffect } from 'react';
import '@/../css/merkatuaOrria/puja.css';
import euro from '@/../images/euro.png';
import { Inertia } from '@inertiajs/inertia';

function Puja({ pilot, pujaInicial, bezeroDirua, onPujaUpdate }) {
  const [puja, setPuja] = useState(pujaInicial || '');
  const [error, setError] = useState('');


    const handleSubmit = (e) => {
    e.preventDefault();

    setError('');
    const pujaBerria = {
      puja: puja,
      gidaria_id: pilot?.id,
    };
    console.log(bezeroDirua);

    if (puja < pilot?.balioa || puja > bezeroDirua) {
      setError('Puja ezin da izan.');
      return;
    }else{
      Inertia.post('/pujatu', pujaBerria);
      onPujaUpdate(puja);

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

      <p className="saldo">Zure saldoa: {bezeroDirua}</p>
    </div>
  );
}

export default Puja;
