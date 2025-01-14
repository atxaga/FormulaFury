import '@/../css/merkatuaOrria/footer.css';
import casco from '../../../images/casco.png.png';
import klasifikazioa  from '../../../images/klasifikazioa.png.png';
import taldea  from '../../../images/taldea.png.png';
import merkatuaSelected  from '../../../images/merkatuaSelected.png.png';
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
          <img src={taldea}  />
          {translations.footer.taldea}
        </a>
        </div>
        <div className='merkatua'>
          <a href="merkatua">
          <div className='img'>
          <img src={merkatuaSelected}  />
          </div>
            {translations.footer.merkatua}
          </a>
        </div>
        <div className='aktibitatea'>
          <div className='img'>
          <img src={aktibitatea}  />
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
