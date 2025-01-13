import { useState, useEffect } from 'react';
import dispo from '../../../images/tick.png';
import f1 from '../../../images/f1.png';
import f2 from '../../../images/f2.png';
import verstappen from '../../../images/verstappen.png';
import { Inertia } from '@inertiajs/inertia';


function Gidaria({ pilot }) {

  return (
    <>
      <div className="main-gidari">
        <div className="datuak">
          <img src={verstappen} alt="" />
          <div className="gidariDatuak">
            <div className="usuario">
              <div className="mota">
                <p>PIL</p>
              </div>
              <div className="usuarioIzena">
                <p className="text-white">{pilot.izena}</p>
              </div>
            </div>
            <div className="gidariEgoera">
              <img src={dispo} alt="" />
              <p>{pilot.disponibilitatea}</p>
            </div>
            <div className="gidariBalorea">
              {pilot.kategoria === 'f1' ? (
                <img className="kategoria" src={f1} alt="" />
              ) : (
                <img className="kategoria" src={f2} alt="" />
              )}
            </div>
          </div>
        </div>
        <div className="puntuDiv">
          <div className="gidariPuntuak">
            <p className="punto">PRFY</p>
            <p className="prfy">{pilot.puntuak}</p>
          </div>
          <div className="media">
            <p className="mediaP">Prezioa</p>
            <p className="mediaValor">
              {pilot.balioa}
            </p>
          </div>
        </div>
      </div>
    </>
  );
}

export default Gidaria;
