import React, { useState, useEffect } from 'react';
import '../../../css/puntuakOrria/taldea.css';
import F2gidaria from './F2gidaria';
import F2gidaria2 from './F2gidaria2';
import Footer from './Footer';
import Header from './Header';
import f1Img from '../../../images/f1.png';
import f2Img from '../../../images/f2.png';
import euroTaldeaImg from '../../../images/euroTaldea.png';
import { usePage } from '@inertiajs/react';

const Taldea = () => {
  const { translations, bezeroa, ligaIzena, taldeaOsoa, gidariaF1 = [], gidariaF2 = [], taldeaIzena, ligaId, ekipoBalorea} = usePage().props;
  console.log( bezeroa, ligaIzena, taldeaOsoa, gidariaF1, gidariaF2, taldeaIzena, ligaId, ekipoBalorea);
  return (
    <>
      <div className="main-container">
        <Header bezeroa={bezeroa} liga={ligaIzena} />
        <div className="talde">
          <div className="plantilla">
            <div className="plantillaLetra">
              <p>{translations.taldea.plantilla}</p>
            </div>
            <div className="totala">
              <p className="text-white">{gidariaF1.length + gidariaF2.length + 1}/10</p>
            </div>
          </div>
          <div className="lasterketa">
            <div className="lasterketaLetra">
              <p>{translations.taldea.lasterketa}</p>
            </div>
            <div className="eguna">
              <p className="text-white">IGA 5 , 20:00</p>
            </div>
          </div>
          <div className="balorea">
            <div className="baloreaLetra">
              <p>{translations.taldea.balioa}</p>
            </div>
            <div className="totalaBalorea">
              <p className="text-white">{ekipoBalorea}</p>
              <img src={euroTaldeaImg} alt="Euro Taldea" />
            </div>
          </div>
        </div>

        <div className="logoak">
          <div className="f1Class" >
            <img className="f1" src={f1Img} alt="F1" />
            {gidariaF1.map((gidaria, index) => (
              <div className="gidariaDiv" key={index}>
                <div className='puntuakGidari'>
                  <p>-</p>
                </div>
                <div className="foto">
                  <img style={{ width: '80%', margin: 'auto' }} src={gidaria.foto} alt={`F1 gidaria ${index + 1}`} />
                </div>
                <div className="datof1">
                  <div className="izena">{gidaria.izena}</div>
                </div>
              </div>
            ))}
          </div>

          <div className="f2Class" >
            <img className="f2" src={f2Img} alt="F2" />
            {gidariaF2.map((gidaria, index) => (
              <div className="gidariaDiv" key={index}>
                <div className='puntuakGidari'>
                  <p>-</p>
                </div>
                <div className="foto">
                  <img style={{ width: '80%', margin: 'auto' }} src={gidaria.foto} alt={`F2 gidaria ${index + 1}`} />
                </div>
                <div className="datof1">
                  <div className="izena">{gidaria.izena}</div>
                </div>
              </div>
            ))}
          </div>

          <div>
            {taldeaIzena ? (
              <div className="gidariaDiv" style={{ width: '20%' }}>
                <div className="escuderia" style={{ padding: '5%' }}>
                  <img src={taldeaOsoa.foto} alt="Escuderia" />
                </div>
                <div className="datof1">
                  <div className="izena">
                    <p>{taldeaIzena}</p>
                  </div>
                </div>
              </div>
            ) : (
              <p>Ez duzu talderik</p>
            )}
          </div>
        </div>
      </div>
      <Footer />
    </>
  );
}

export default Taldea;





