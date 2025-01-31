import React from 'react';
import { Inertia } from '@inertiajs/inertia'; 
import '../../../css/klasifikazioOrria/jokalaria.css';
import perfil from "../../../images/perfil.png";
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

function Jokalaria({ bezeroak, bezeroaCurrent }) {
  
  const handleClick = (id) => {
    Inertia.get(`/setBezero/${id}`);
  };
  

  return (
    <>
      {bezeroak.map((bezero, index) => (
        <div className='blanco2-liga' key={index} onClick={() => handleClick(bezero.id)}>
          <div className='datuak'>
            <div className='posizioa'>
              <p>{index + 1}</p> 
              <img src={perfil} alt="" />
            </div>
            <div className='usuario'>
              <p className='usuarioIzena'>{bezero.izena}</p>
              <p className='usuarioDirua'>{bezero.dirua}</p>
            </div>
          </div>
          <div className='puntuDiv'>
          <div className='puntuak'>
            <p className='punto'>{bezero.puntuak}</p><p className='prfy'>PRFY</p>
          </div>
          {bezeroaCurrent.id == bezero.id ? (
            <div className='ikusi'>
            <a>
              <img src='/images/corona.png' alt="" />
            </a>
            </div>
          ):(
          <div className='ikusi'>
          <a href="/ikusitaldea">
            <img src='/images/ojo.png' alt="" />
          </a>
          </div>
          )}
          
          </div>

        </div>
      ))}
    </>
  );
}

export default Jokalaria;
