import { useState } from 'react';
import '@/../css/merkatuaOrria/puja.css';
import '@/../css/klausula/klausula.css'
import euro from '@/../images/euro.png';
import { Inertia } from '@inertiajs/inertia';

function Klausula({ gidaria, taldea, bezeroDirua }) {
  const finalGidaria = gidaria ?? taldea;
  const [kantitatea, setKlausula] = useState('');


  const handleSubmit = (e) => {
    e.preventDefault();
  
    const kantitateaNum = parseFloat(kantitatea);
  
    if (isNaN(kantitateaNum) || kantitateaNum <= 0) {
      alert('Sartu balio egokia.');
      return;
    }
  
    if (kantitateaNum > bezeroDirua) {
      alert('Ez daukazu nahikoa diru.');
      return;
    }
  
    const tipo = gidaria ? 'gidaria' : 'taldea'; 
  
    Inertia.post(`/klausulaigo/${finalGidaria.id}`, { 
      kantitatea: kantitateaNum,
      tipo: tipo 
    });
  };
  

  return (
    <div className="puja-container">
      <form onSubmit={handleSubmit}>
        <div className="balorea">
          <img src={euro} alt="" />
          <p className="puja-value">KLAUSULA</p>
          {finalGidaria.gidaria_clausula ? (
            <p>{finalGidaria.gidaria_clausula}</p> 
          ):(
            <p>{finalGidaria.taldea_clausula}</p> 

          )}
        </div>

        <div className="input-container">
          <p>Igoera</p>
          <input
            type="number"
            className="input-field"
            value={kantitatea}
            onChange={(e) => setKlausula(e.target.value)}
            min="1"
            required
          />
        </div>

        <button type="submit" className="button">
          Klausula igo
        </button>
      </form>
    </div>
  );
}

export default Klausula;
