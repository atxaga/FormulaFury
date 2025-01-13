
import '../../../css/taldeaOrria/taldea.css';
import F2gidaria from './F2gidaria';
import F2gidaria2 from './F2gidaria2';
import F1gidaria from './F1gidaria';
import F1gidaria2 from './F1gidaria2';
import F1taldea from './F1Ttaldea';
import Footer from './Footer';
import Header from './Header';
import tick from '../../../images/tick.png';
import fernando from '../../../images/fernando.png';
import euroTaldeaImg from '../../../images/euroTaldea.png';
import f1Img from '../../../images/f1.png';
import f2Img from '../../../images/f2.png';
import { useState } from 'react';
import { usePage } from '@inertiajs/react';

function Taldea() {
  const { translations } = usePage().props;
  return (
    <>
      <div className="main-container">
        <Header />
        <div className="talde">
          <div className="plantilla">
            <div className="plantillaLetra">
              <p>{ translations.taldea.plantilla }</p>
            </div>
            <div className="totala">
              <p className="text-white">5/5</p>
            </div>
          </div>
          <div className="lasterketa">
            <div className="lasterketaLetra">
              <p>{ translations.taldea.lasterketa }</p>
            </div>
            <div className="eguna">
              <p className="text-white">IGA 5 , 20:00 </p>
            </div>
          </div>
          <div className="balorea">
            <div className="baloreaLetra">
              <p>{ translations.taldea.balioa }</p>
            </div>
            <div className="totalaBalorea">
              <p className="text-white">560.000.000</p>
              <img src={euroTaldeaImg} alt="Euro Taldea" />
            </div>
          </div>
        </div>
        <div className="logoak">
          <div className="f1Class">
            <img className="f1" src={f1Img} alt="F1" />
            <div className="f1gidariak">
              <F1gidaria />
              <F1gidaria2 />
            </div>
          </div>
          <div className="f2Class">
            <img className="f2" src={f2Img} alt="F2" />
            <div className="f2gidariak">
              <F2gidaria />
              <F2gidaria2 />
            </div>
          </div>
          <div className="f1taldea">
            <F1taldea />
          </div>
        </div>
      </div>
      <Footer /> 
    </>
  );
}

export default Taldea;
