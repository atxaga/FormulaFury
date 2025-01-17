import React, { useState } from 'react';
import '../../../css/orriNagusia/nagusia.css';
import cascorojo from '../../../images/cascorojo.png';
import trespuntos from '../../../images/trespuntos.png';
import euro from '../../../images/euro.png';
import { redirect } from 'react-router-dom';
import { Inertia } from '@inertiajs/inertia'; 

function Ligak({ ligak, bezeroa }) {
  const [ligas, setLigas] = useState(ligak);
  const [showRemoveInput, setShowRemoveInput] = useState(null);

  const removeLiga = (id) => {
    setLigas(ligas.filter(liga => liga.id !== id));
    setShowRemoveInput(null); 
  };

  const handleThreeDotsClick = (id) => {
    setShowRemoveInput(showRemoveInput === id ? null : id); 
  };

  const redirectKlasifikazioa = (id) => {

    Inertia.get(`/setLiga/${id}`);
    
  }

  return (
    <>
      {ligas.map((liga) => (
        <div className="blanco-liga" key={liga.id} onClick={() => redirectKlasifikazioa(liga.id)}>
          <div className="ligak-info-ezker">
            <div className="team">
              <div className="team2">
                <img src={cascorojo} alt="Cascorrojo" />
                <h3>{liga.izena}</h3> 
              </div>
            </div>
            <div className="puntuak">
              <p>{bezeroa.puntuak} PFRY</p> 
            </div>
          </div>
          <div className="ligak-info-eskubi">
            <div className="dirua">
              <div className="diruaDena">
                
                <img 
                  className="tres" 
                  src={trespuntos} 
                  alt="Tres Puntos" 
                  onClick={() => handleThreeDotsClick(liga.id)} 
                />
                <div className="dirua">
                  <h3>{bezeroa.dirua}</h3>
                  <img src={euro} alt="Euro" />
                </div>
              </div>
            </div>

            {showRemoveInput === liga.id && (
              <div style={{ marginTop: '10px' }}>
                <input 
                  type="text"
                  placeholder="Utzi Liga"
                  className="remove-input"
                  readOnly
                />
                <button
                  onClick={() => removeLiga(liga.id)}
                  className="remove-button"
                >
                  Utzi Liga
                </button>
              </div>
            )}
          </div>
        </div>
      ))}
    </>
  );
}

export default Ligak;
