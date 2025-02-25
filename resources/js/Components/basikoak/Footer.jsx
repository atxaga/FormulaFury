import '../../../css/footer.css';
import casco from '../../../images/ligakSelected.png.png';
import klasifikazioa  from '../../../images/klasifikazioa.png.png';
import taldeaSelect  from '../../../images/taldea.png';
import merkatua  from '../../../images/merkatua.png.png';
import aktibitatea  from '../../../images/aktibitatea.png';
import { useState } from 'react';
import { usePage } from '@inertiajs/react';

function Footer() {
  const { translations } = usePage().props;
  return (
    <>
      <div className='container1 text-center fixed-bottom'>
        <div className='argazkiak'>
        <div className='ligak'>
        <a href='nagusia'>

          <div className='img'>
          <img src={casco}  />
          </div>
          {translations.footer.ligak}
        </a>
        </div>
        <div className='klasifikazioa'>
        <a href="klasifikazioa">

          <div className='img'>
          <img src={klasifikazioa}  />
          </div>
          {translations.footer.klasifikazioa}
          </a>
        </div>
        
        <div className='taldeaInput'>
        <a href="taldea">
          <img src={taldeaSelect}  />
          {translations.footer.taldea}
        </a>
        </div>
        <div className='merkatua'>
          <a href="merkatua">
          <div className='img'>
          <img src={merkatua}  />
          </div>
          </a>
          <p>
            {translations.footer.merkatua}
          </p>
        </div>
        <div className='aktibitatea'>
        <a href='aktibitatea'>
          <div className='img'>
          <img src={aktibitatea}  />
          </div>
          
            {translations.footer.aktibitatea}
          </a>
        </div>
        </div>
        
      </div>
    </>
  );
}

export default Footer;
