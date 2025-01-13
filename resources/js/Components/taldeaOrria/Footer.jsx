import '../../../css/taldeaOrria/footer.css';
import cascoImg from '../../../images/casco.png.png';
import klasifikazioaImg from '../../../images/klasifikazioa.png.png';
import taldeaSelectedImg from '../../../images/taldeaSelected.png.png';
import merkatuaImg from '../../../images/merkatua.png.png';
import aktibitateaImg from '../../../images/aktibitatea.png';
import { useState } from 'react';
import { usePage } from '@inertiajs/react';

function Footer() {
  const { translations } = usePage().props;
  return (
    <>
      <div className='container1 text-center fixed-bottom'>
        <div className='argazkiak'>
          <div className='ligak'>
          <a href="nagusia">

            <div className='img'>
              <img src={cascoImg} alt="Casco" />
            </div>
              <p>{translations.footer.ligak}</p>
            </a>
          </div>
          <div className='klasifikazioa'>
          <a href="klasifikazioa">

            <div className='img'>
              <img src={klasifikazioaImg} alt="Klasifikazioa" />
            </div>
            {translations.footer.klasifikazioa}
            </a>
          </div>
          <div className='taldeaInput'>
            <img src={taldeaSelectedImg} alt="Taldea Seleccionado" />
            <a href="nagusia">
              {translations.footer.taldea}
            </a>
          </div>
          <div className='merkatua'>
            <div className='img'>
              <img src={merkatuaImg} alt="Merkatua" />
            </div>
            <p>
              {translations.footer.merkatua}
            </p>
          </div>
          <div className='aktibitatea'>
            <div className='img'>
              <img src={aktibitateaImg} alt="Aktibitatea" />
            </div>
            <p>
              {translations.footer.aktibitatea}
            </p>
          </div>
        </div>
      </div>
    </>
  );
}

export default Footer;
